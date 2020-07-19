<?php

namespace App\Http\Controllers;
use App\Models\Organisation;
use Illuminate\Support\Facades\Hash; //for password hashing
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all organisations
         //
         $organisations = DB::table('organisations')->paginate(15);
        //dd($organisations);
         return view('organisations.index', compact('organisations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // open new organisation view
        return view('organisations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //creates a new organisation - validation should be in separate method
         $request->validate([
            'name'=>'required|max:255',
            'website'=>'max:255',
            'phone'=>'max:50',
            'address'=>'max:255',
            'country'=>'max:255',                 
        ]);
        $organisation = new Organisation([
            'name' => $request->get('name'),
            'website' => $request->get('website'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'country' => $request->get('country'),
        ]);
        $organisation->save();
        return redirect('/organisations')->with('success', 'Organisation saved!');
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
        //open edit view
        $organisation = Organisation::find($id);
        return view('organisations.edit', compact('organisation'));   
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
        //update organisation record
        $request->validate([
            'name'=>'required|max:255',
            'website'=>'max:255',
            'phone'=>'max:50',
            'address'=>'max:255',
            'country'=>'max:255',                 
        ]);

        $organisation = Organisation::find($id);
        $organisation->name =  $request->get('name');
        $organisation->website = $request->get('website');
        $organisation->phone = $request->get('phone');
        $organisation->address = $request->get('address');
        $organisation->country = $request->get('country');
        $organisation->save();

        return redirect('/organisations')->with('success', 'organisation updated!');

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
         //delete user
         $organisation = Organisation::find($id);
         $organisation->delete();
 
         return redirect('/organisations')->with('success', 'Organisation deleted!');
 
    }
}
