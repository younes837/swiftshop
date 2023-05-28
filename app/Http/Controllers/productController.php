<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Propriete;
use App\Models\Brand;
use IlluminateSupportFacadesURL;


class productController extends Controller
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
        $products=Produit::paginate(10);
        $categories=Categorie::all();
        $proprietes=Propriete::all();
        $brands=Brand::all();
        return view('content/ecommerce/produit/index',[
            'pageConfigs' => $pageConfigs,
            'products'=>$products,
            'categories'=>$categories,
            'proprietes'=>$proprietes,
            'brands'=>$brands,
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
            'libelle' => 'required',
            'photo' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'rating' => 'required',
            'price' => 'required',
            'categorie' => 'required',
            'propriete' => 'required',
            'brand' => 'required',
        ]);

        $file = $request->file('photo');
        $name = $request->file('photo')->getClientOriginalName();
        $file->move(public_path('/images/pages/eCommerce/'), $name);

        $data = [
            'libelle' => $request->libelle,
            'photo' => "/images/pages/eCommerce/".$name,
            'description' => $request->description,
            'stock' => $request->stock,
            'rating' => $request->rating,
            'price' => $request->price,
            'categorie_id' => $request->categorie,
            'brand_id' => $request->brand,
            'propriete_id' => $request->propriete,
        ];
        Produit::create($data);

        return redirect('product')->with('succes',"Product added Succefully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            
        ];
        $produit=Produit::find($id);
        $categories=Categorie::all();
        $proprietes=Propriete::all();
        $brands=Brand::all();
        return view('content/ecommerce/produit/edit',[
            'pageConfigs' => $pageConfigs,
            'produit'=>$produit,
            'categories'=>$categories,
            'proprietes'=>$proprietes,
            'brands'=>$brands,
        ]);
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
        $request->validate([
            'libelle' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'rating' => 'required',
            'price' => 'required',
            'categorie' => 'required',
            'propriete' => 'required',
            'brand' => 'required',
        ]);
        if($request->photo === null){
            $prod =Produit::find($id);
            $oldpicture=$prod->photo;

            $prod->libelle = $request->libelle;
            $prod->photo = $oldpicture;
            $prod->description = $request->description;
            $prod->stock = $request->stock;
            $prod->rating = $request->rating;
            $prod->price = $request->price;
            $prod->categorie_id = $request->categorie;
            $prod->propriete_id = $request->propriete;
            $prod->brand_id = $request->brand;
            $prod->save();

        }else{
        $file = $request->file('photo');
        $name = $request->file('photo')->getClientOriginalName();
        $file->move(public_path('/images/pages/eCommerce/'), $name);

        $prod =Produit::find($id);
        $prod->libelle = $request->libelle;
        $prod->photo = "/images/pages/eCommerce/".$name;
        $prod->description = $request->description;
        $prod->stock = $request->stock;
        $prod->rating = $request->rating;
        $prod->price = $request->price;
        $prod->categorie_id = $request->categorie;
        $prod->propriete_id = $request->propriete;
        $prod->brand_id = $request->brand;
        $prod->save();

        }


        // $data = [
        //     'libelle' => $request->libelle,
        //     'photo' => "/images/pages/eCommerce/".$name,
        //     'description' => $request->description,
        //     'stock' => $request->stock,
        //     'rating' => $request->rating,
        //     'price' => $request->price,
        //     'categorie_id' => $request->categorie,
        //     'brand_id' => $request->brand,
        //     'propriete_id' => $request->propriete,
        // ];
        // Produit::update($data);

        return redirect('product')->with('update',"Product updated Succefully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produit::destroy($id);
        return redirect('product')->with('delete',"Product deleted Succefully");


    }
    public function filter_categorie(Request $request){
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            
        ];
        if ($request->filter_categorie=="all") {
            $products=Produit::paginate(10);
        }else{

            $products=Produit::where('categorie_id',$request->filter_categorie)->paginate(10);
        }
        $categories=Categorie::all();
        $proprietes=Propriete::all();
        $brands=Brand::all();
        return view('content/ecommerce/produit/index',[
            'pageConfigs' => $pageConfigs,
            'products'=>$products,
            'categories'=>$categories,
            'proprietes'=>$proprietes,
            'brands'=>$brands,
            'id'=>$request->filter_categorie
        ]);

    }
}
