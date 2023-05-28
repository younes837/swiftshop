<?php

namespace App\Http\Controllers;
use App\Models\Commande;
use App\Models\User;
use App\Models\ligneCommande;
use App\Models\Produit;
use App\Mail\SignUp;
use Mail;
use Illuminate\Http\Request;
use Auth;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = DB::table('commande')
    ->join('users', 'users.id', '=', 'commande.user_id')
    ->select('users.name', 'users.email', 'users.avatar', 'commande.date', 'commande.total', 'commande.etat_id', 'commande.adress',"users.id","commande.id as commande_id" )
    ->paginate(10);
    $products=Produit::all();
    $userCounts = DB::table('commande')
            ->select('user_id')
            ->distinct()
            ->get()
            ->pluck('user_id');
        $ligne_commande=ligneCommande::join("produit","produit.id","produit_commande.produit_id")->get();
        return view('content.ecommerce.commande.index',["commandes"=>$commandes,"ligne_commande"=>$ligne_commande,"userCounts"=>count($userCounts),'products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $total = 0;
        foreach(session('cart') as $id => $details){
        $total += $details['price'] * $details['quantity'];
        }
        
        $data=Commande::create([
            'date'=>now()->format('Y-m-d'),
            'total'=>$total,
            'etat_id'=>1,
            "user_id"=>Auth::user()->id,
            "ville"=>$request->ville,
            "adress"=>$request->address,
        ]);
        foreach(session('cart') as $id => $details){
            ligneCommande::create([
                'produit_id'=>$details['id'],
                'commande_id'=>$data->id,
                'quantite'=>$details['quantity'],

            ]) ;       
        }
        session()->forget('cart');
         return redirect()->back();
        
        
        

    }
    public function confirm_commande($id){
        $commande=Commande::find($id);
        $commande->etat_id=2;
        $commande->save();
        $data=['commande'=>$commande];
        $user=User::find($commande->user_id);
        Mail::to($user->email)->send(new SignUp($data));
        
        return redirect()->back()->with('confirm','message');

    } 
    public function reject_commande($id){
        $commande=Commande::find($id);
        $commande->etat_id=3;
        $commande->save();
        return redirect()->back()->with('reject','message');
    } 

    public function invoice($id){
        $commande=Commande::find($id);
        return view('content/ecommerce/commande/invoice',["commande"=>$commande]);
    }

    public function download_invoice($id){

            $commande=Commande::find($id);
       


        $pdf = Pdf::loadView('content/ecommerce/commande/facture',['commande'=> $commande]);
    return $pdf->download('invoice.pdf');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
        $ligne_commande=ligneCommande::join('produit','produit.id',"produit_commande.produit_id")
  
        ->where('commande_id',$id)
        ->select('produit.photo','produit.libelle','produit.brand_id','produit.price','produit_commande.quantite')
        ->get();
        $commande=Commande::find($id);
        $user=User::find($commande->user_id);
        return view('content.ecommerce.commande.show',["ligne_commande"=>$ligne_commande,"commande"=>$commande,"user"=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function search_commande(Request $request){
        if ($request->ajax()) {
            $query=$request->get('query');
            $status=$request->get('status');
            if ($request->query!="") {
                if ($status!="all") {
                    # code...
                
                $commandes = DB::table('commande')
                ->join('users', 'users.id', '=', 'commande.user_id')
                ->where(function ($q) use ($query, $status) {
                    $q
                    ->where('commande.etat_id',$status);
                })
                ->where(function ($q) use ($query, $status){
                    $q
                ->where('users.name', 'like', '%' . $query . '%')
                ->orWhere('commande.adress', 'like', '%' . $query . '%')
                ->orWhere('users.email', 'like', '%' . $query . '%')
                ->orWhere('commande.date', 'like', '%' . $query . '%')
                ->orWhere('commande.total', 'like', '%' . $query . '%');
            })
                ->select('users.name', 'users.email', 'users.avatar', 'commande.date', 'commande.total', 'commande.etat_id', 'commande.adress',"users.id","commande.id as commande_id" )
                
                ->paginate(10);
                   
                 
                    return view("content.ecommerce.commande.commande-content",compact('commandes'));
                
            }
            else{
                $commandes = DB::table('commande')
                ->join('users', 'users.id', '=', 'commande.user_id')
             
                ->where(function ($q) use ($query, $status){
                    $q
                ->where('users.name', 'like', '%' . $query . '%')
                ->orWhere('commande.adress', 'like', '%' . $query . '%')
                ->orWhere('users.email', 'like', '%' . $query . '%')
                ->orWhere('commande.date', 'like', '%' . $query . '%')
                ->orWhere('commande.total', 'like', '%' . $query . '%');
            })
                ->select('users.name', 'users.email', 'users.avatar', 'commande.date', 'commande.total', 'commande.etat_id', 'commande.adress',"users.id","commande.id as commande_id" )
                
                ->paginate(10);
                   
                 
                    return view("content.ecommerce.commande.commande-content",compact('commandes'));
            }
        }
        }
    }
}


