<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Region;
use DataTables;
use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Get all users
    public function index()
    {
        //Fetching all the users
        $users = User::all();

        return view('users/index', [
            'users' => $users,
        ]);
    }

    //Datatable for all users
    public function get(Request $request)
    {
        if ($request->ajax()) {

        $users = User::with('role')->orderBy('created_at', 'DESC')->get();

            return Datatables::of($users)
                    ->addIndexColumn()
                    ->make(true);
        }
    }


    //Datatable for users with regions
    public function getregions(Request $request)
    {
        $region_id = Session::get('region_id');
        if ($request->ajax()) {

        $users = User::with('role', 'region')->where('region_id', $region_id)->where('role_id', 1)->orderBy('created_at', 'DESC')->get();

            return Datatables::of($users)
                    ->addIndexColumn()
                    ->make(true);
        }
    }


    //returns view for viewing users per region
    public function regions()
    {   
        $region_id = request('region_id');
        Session::put('region_id', $region_id);

        //Getting region name
        $regions = Region::find($region_id);
        $region_name = $regions->name;

        return view('users/regions', [
            'region_name' => $region_name,
        ]);
    }



}
