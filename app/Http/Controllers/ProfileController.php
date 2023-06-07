<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
    }
}
