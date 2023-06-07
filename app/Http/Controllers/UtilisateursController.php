<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ville;
use App\Models\Commande;
use Hash;
use Alert;
use Auth;
use DB;
use App\Models\Roles;
class UtilisateursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            
        ];
        $users=User::paginate(10);
        $villes=Ville::all();
        $roles=Roles::all();
        return view('content/ecommerce/Users/index',[
            'pageConfigs' => $pageConfigs,
            'users'=>$users,
            'villes'=>$villes,
            'roles'=>$roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'avatar' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $file = $request->file('avatar');
        $name = $request->file('avatar')->getClientOriginalName();
        $file->move(public_path('/images/'), $name);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $name,
            'adress' => $request->address,
            'phone' => $request->phone,
            'role_id' => $request->role,
            'ville_id' => $request->ville,
        ]);
        
        return redirect('Users')->with('succes',"User added Succefully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        $villes=Ville::all();
        $roles=Roles::all();
        $commandes = Commande::select('commande.*')
            ->join('produit_commande', 'produit_commande.commande_id', '=', 'commande.id')
            ->join('produit', 'produit.id', '=', 'produit_commande.produit_id')
            ->where('commande.user_id', $id)
            ->select('produit.photo','produit.libelle',"commande.total","commande.date","produit_commande.quantite","produit.id")
            ->get();
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
           
        ];
        return view('content/ecommerce/Users/show',[
            'pageConfigs' => $pageConfigs,
            "user"=>$user,
            "commandes"=>$commandes,
            'villes'=>$villes,
            'roles'=>$roles,
        ]);
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
        $user_idited=User::find($id);
       
       if ($request->profil) {

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'ville'=>'required',
        ]);


        $old_file=$user_idited->avatar;
    
        if ($request->avatar == '') {  
                $user_idited->name =$request->name;
                $user_idited->phone =$request->phone;
                $user_idited->adress =$request->address;
                $user_idited->avatar =$old_file;
                $user_idited->email =$request->email;
                $user_idited->ville_id =$request->ville;
            }else{           
                // dd($request);
            $file = $request->file('avatar');
            $name = $request->file('avatar')->getClientOriginalName();
            $file->move(public_path('/images/'), $name);
            $user_idited->name =$request->name;
            $user_idited->phone =$request->phone;
            $user_idited->adress =$request->address;
            $user_idited->avatar =$name;
            $user_idited->email =$request->email;
            $user_idited->ville_id =$request->ville;  
            }
        
        $user_idited->save();
        return redirect()->back()->with('update',"User updated Succefully"); 
        }else{
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'role'=>'required',
            'ville'=>'required',
        ]);
        
        $old_file=$user_idited->avatar;
        $old_password=$user_idited->password;
        if ($request->avatar == '') {
            if($request->password =='' ){
                $user_idited->name =$request->name;
                $user_idited->phone =$request->phone;
                $user_idited->adress =$request->address;
                $user_idited->avatar =$old_file;
                $user_idited->email =$request->email;
                $user_idited->password =$old_password;
                $user_idited->role_id =$request->role;
                $user_idited->ville_id =$request->ville;
            }else{
                $user_idited->name =$request->name;
                $user_idited->phone =$request->phone;
                $user_idited->adress =$request->address;
                $user_idited->avatar =$old_file;
                $user_idited->email =$request->email;
                $user_idited->password =Hash::make($request->password);
                $user_idited->role_id =$user_idited->role;
                $user_idited->ville_id =$user_idited->ville;  
            }
        }else{
            if($request->password =='' ){
                $file = $request->file('avatar');
                $name = $request->file('avatar')->getClientOriginalName();
                $file->move(public_path('/images/'), $name);
                $user_idited->name =$request->name;
                $user_idited->phone =$request->phone;
                $user_idited->adress =$request->address;
                $user_idited->avatar =$name;
                $user_idited->email =$request->email;
                $user_idited->password =$old_password;
                $user_idited->role_id =$request->role;
                $user_idited->ville_id =$request->ville;
            }else{
                $file = $request->file('avatar');
                $name = $request->file('avatar')->getClientOriginalName();
                $file->move(public_path('/images/'), $name);
                $user_idited->name =$request->name;
                $user_idited->phone =$request->phone;
                $user_idited->adress =$request->address;
                $user_idited->avatar =$name;
                $user_idited->email =$request->email;
                $user_idited->password =Hash::make($request->password);
                $user_idited->role_id =$user_idited->role;
                $user_idited->ville_id =$user_idited->ville;  
            }
        }
        $user_idited->save();
        return redirect()->back()->with('update',"User updated Succefully"); 
       
    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // delete task
      $task=User::find($id);
      $task->delete();
      return redirect('Users')->with('delete',"User deleted Succefully");
    }
   public function search_user(Request $request){
    if ($request->ajax()) {
        $query = $request->get('query');
        $villes=Ville::all();
        $roles=Roles::all();
        if ($query=="") {
            $users=User::paginate(10);
        }else{
        $users=User::join('ville', 'ville.id', 'users.ville_id')
        ->join('roles', 'roles.id', 'users.role_id')
        ->where('users.name', 'like', '%' . $query . '%')
        ->orWhere('users.email', 'like', '%' . $query . '%')
        ->orWhere('users.adress', 'like', '%' . $query . '%')
        ->orWhere('ville.name', 'like', '%' . $query . '%')
        ->orWhere('roles.libelle', 'like', '%' . $query . '%')
        ->select("users.name","users.email","users.adress","users.avatar","users.id","users.ville_id","users.role_id","users.phone")
        ->paginate(10);}
        return view('content.ecommerce.Users.users-content',[
            "users"=>$users,
            'villes'=>$villes,
            'roles'=>$roles,
        ]);

    }
   }
   public function profile(){
    $pageConfigs = [
   
        'showMenu' => true,
        'pageClass' => 'ecommerce-application',
        'mainLayoutType' => 'horizontal',
    ];
    $commandes = Commande::select('commande.*')
    ->join('produit_commande', 'produit_commande.commande_id', '=', 'commande.id')
    ->join('produit', 'produit.id', '=', 'produit_commande.produit_id')
    ->where('commande.user_id', Auth::user()->id)
    ->select('produit.photo','produit.brand_id','produit.price','produit.libelle',"commande.total","commande.date","produit_commande.quantite","produit.id")
    ->get();
    $produits = DB::table('user_produit')
    ->join('users', 'user_produit.user_id', 'users.id')
    ->join('produit', 'user_produit.produit_id', 'produit.id')
    ->select(
        'produit.id',
        'produit.libelle',
        'produit.photo',
        'produit.description',
       
        'produit.stock',
        'produit.brand_id',
        'produit.categorie_id',
        'produit.rating',
        'produit.price'
        )
        ->where('users.id',Auth::user()->id)->get();
    $user=Auth::user();
    return view('content/profile',['pageConfigs' => $pageConfigs,'user'=>$user,'commandes'=>$commandes,'produits'=>$produits]);
   }
   public function profile_security(){
    $pageConfigs = [
   
        'showMenu' => true,
        'pageClass' => 'ecommerce-application',
        'mainLayoutType' => 'horizontal',
    ];

    $user=Auth::user();
    return view('content/profile-security',['pageConfigs' => $pageConfigs,'user'=>$user]);
   }
   public function password(Request $request)
   {
    $user=Auth::user();
    // return $request;
    $user->password=Hash::make($request->password);
    $user->save();
    return redirect()->back();
   }
}
