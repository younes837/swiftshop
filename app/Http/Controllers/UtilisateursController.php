<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ville;
use Hash;
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
            'mainLayoutType' => 'horizontal',
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
        return redirect('Users');

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
        // return $request;
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'role'=>'required',
            'ville'=>'required',
        ]);
        $old_file=$user_idited->avatar;
        if ($request->avatar == '') {
            if($request->password =='' ){
                $user_idited->name =$request->name;
                $user_idited->phone =$request->phone;
                $user_idited->adress =$request->address;
                $user_idited->avatar =$old_file;
                $user_idited->email =$request->email;
                $user_idited->password =$user_idited->password;
                $user_idited->role_id =$request->role;
                $user_idited->ville_id =$request->ville;
            }else{
                $user_idited->name =$request->name;
                $user_idited->phone =$request->phone;
                $user_idited->adress =$request->address;
                $user_idited->avatar =$old_file;
                $user_idited->email =$request->email;
                $user_idited->password =$request->password;
                $user_idited->role_id =$user_idited->role;
                $user_idited->ville_id =$user_idited->ville;  
            }
        }else{
            $user_idited->name =$request->name;
            $user_idited->phone =$request->phone;
            $user_idited->adress =$request->address;
            $user_idited->avatar =$request->avatar;
            $user_idited->email =$request->email;
            $user_idited->password =$request->password;
            $user_idited->role_id =$user_idited->role;
            $user_idited->ville_id =$user_idited->ville;
        }
        $user_idited->save();
        return redirect('Users'); 
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
      return redirect('Users');
    }
}
