<?php

namespace App\Http\Controllers\api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',request()->user()->id)->with('role')->get();
        return response(['users'=> $users]);
    }

    //get user status
    public function getStatus( $email){
        $found = User::where('email',$email)->get();
        return response()->json($found);
    }

    //disable User
    public function disableUser(User $user){
        $user->status = 0;
        $user->save();
        return response()->json(['message'=>'user disabled']);
    }

    //enable User
    public function enableUser(User $user){
        $user->status = 1;
        $user->save();
        return response()->json(['message'=>'user enabled']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        //get the id of user role
        $userRole_id = Role::where('label','User')->first()->id;

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $userRole_id;
        // status = 1 active user
        $user->status = 1;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message'=>'user added'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id',$id)->get();
        return response(['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'user deleted'],200);
    }
}
