<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\etat;


class etatController extends Controller
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
        $etats=etat::paginate(10);
        return view('content/ecommerce/etat/index',[
            'pageConfigs' => $pageConfigs,
            'etats'=>$etats,
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
            'description' => 'required',
        ]);


        $data = [
            'libelle' => $request->libelle,
            'description' => $request->description,
        ];
        etat::create($data);

        return redirect('etat');
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
        $etat=etat::find($id);
        return view('content/ecommerce/etat/edit',[
            'pageConfigs' => $pageConfigs,
            'etat'=>$etat,
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
        ]);

        $et =etat::find($id);

        $et->libelle = $request->libelle;
        $et->description = $request->description;
        $et->save();

        return redirect('etat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        etat::destroy($id);
        return redirect('etat');
    }
}
