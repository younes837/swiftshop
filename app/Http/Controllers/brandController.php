<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;


class brandController extends Controller
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
        $brands=Brand::paginate(10);
        return view('content/ecommerce/brand/index',[
            'pageConfigs' => $pageConfigs,
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
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $file = $request->file('image');
        $name = $request->file('image')->getClientOriginalName();
        $file->move(public_path('/images/pages/eCommerce/'), $name);

        $data = [
            'name' => $request->name,
            'image' => "/images/pages/eCommerce/".$name,
            'description' => $request->description,
        ];
        brand::create($data);

        return redirect('brand');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $brand=Brand::find($id);
        return view('content/ecommerce/brand/edit',[
            'pageConfigs' => $pageConfigs,
            'brand'=>$brand,
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
            'name' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        if($request->image === null){
            $brd =brand::find($id);
            $oldpicture=$brd->image;

            $brd->name = $request->name;
            $brd->image = $oldpicture;
            $brd->description = $request->description;
            $brd->save();

        }else{
        $file = $request->file('image');
        $name = $request->file('image')->getClientOriginalName();
        $file->move(public_path('/images/pages/eCommerce/'), $name);

        $prod =brand::find($id);
        $prod->name = $request->name;
        $prod->image = "/images/pages/eCommerce/".$name;
        $prod->description = $request->description;
        $prod->save();

        }

        return redirect('brand');

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        brand::destroy($id);
        return redirect('brand');
    }
}
