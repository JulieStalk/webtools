<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash; //for password hashing
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // get current logged in user
        $loggedInUser = Auth::user();

        //get all users
        $users = DB::table('users')->paginate(15);

        return view('users.index', compact('users','loggedInUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //open new users view
        //return the create.blade.php template resources/views/users
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creates a new user
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|unique:users|max:255',
            'password'=>'required',
            'role'=>'required',
        ]);
        
        $userName = $request->get('name'); //save username for message

        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),  // we need to hash the password using Laravel's built in hash
            'role' => $request->get('role'),
        ]);
        $user->save();
        return redirect('/users')->with('success', "User $userName saved!");
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
        $user = User::find($id);
        return view('users.edit', compact('user'));   
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
        // get current logged in user
        $loggedInUser = Auth::user();

        // load user to be updated
        $user = User::find($id);

        // use policy to determine if the user can be updated
        if (!$loggedInUser->can('update', $user)) {
            return  redirect('/users')->with('error', 'You can not update another admin user!');
        } 

        $request->validate([
            'name'=>'required|max:255',
            'email'=> 'required|unique:users,email,'.$id, // doesnt check the current user's email so they can update 
            //'password'=>'required'  if empty then we dont update
            'role'=> 'required',
        ]);
        
        $userName = $request->get('name'); //save username for message
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');

        //if they leave password empty then don't update it
        if ($request->get('password') != "" || !empty($request->get('password')) )
        {  //if they entered something in password then update it
            $user->password = Hash::make($request->get('password')); // we need to hash the password using Laravel's built in hash
        }        
        $user->save();

        return redirect('/users')->with('success', "user $userName updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // get current logged in user
        $loggedInUser = Auth::user();

        // load user to be deleted
        $user = User::find($id);

        // use policy to determine if the user can be deleted
        if ($loggedInUser->can('delete', $user)) {
            //delete user
            $user->delete();
            return redirect('/users')->with('success', 'User deleted!');
        } else 
        {
            return  redirect('/users')->with('error', 'You can not delete an admin user!');        
        }
    }
}
