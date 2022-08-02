<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //returns the view for roles
    public function index()
    {
        //Fetching all the roles
        $roles = Role::all();

        return view('roles/index', [
            'roles' => $roles,
        ]);
        //return view('roles/index');
    }

    //Stores a roles in the system
    public function store()
    {   
        try {
        $role_name= request('name');
        $description= request('description');

        // Instantiating the Role class
        $role_model = new Role();
        $role_model->storeRole($role_name, $description);

        if(\Session::get('role_added')){
            return redirect()->back()->with('message', 'You have successfully Created a Role');

        }elseif (\Session::get('error')) {
            return back()->withError("There was an error adding the Role")->withInput();
        }  

        } catch (Exception $e) {
            return back()->withError("There was an error adding the Role")->withInput();
        } 
    }


    //Updating the role
    public function update(Role $role)
    {
        try {
        //Insert into Audit Table
        $audit_user =  Auth::user()->id;
        $user_au = User::select(
            "users.email",
            "users.id")
            ->where("users.id", "=", $audit_user)
            ->get();

            foreach($user_au as $user){
                $audit_email = $user->email;
            }

        $resource = "Roles"; //Models
        $action = "Update"; //CRUD
        $previous_state = $role;
        $description = "A role was updated with an ID of ".request('role_id');
        $action_taken_by = $audit_email;

        //Instantiating the audit class
        Audit::storeAudit($resource, $action, $previous_state, $description, $action_taken_by);

        $data = request()->validate([
            'name' => 'required',
            'description' => '',
        ]);

        $role->updated_at = Carbon::now();
        $role->update($data);

        return redirect()->back()->with('message', 'You have successfully Updated a Role');

        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to Update a Role');
        }
    }


    //deleting a role via a form
    public function destroy(Role $role)
    {   
        try {

        //Insert into Audit Table
        $audit_user =  Auth::user()->id;
        $user_au = User::select(
            "users.email",
            "users.id")
            ->where("users.id", "=", $audit_user)
            ->get();

            foreach($user_au as $user){
                $audit_email = $user->email;
            }

        $deleted  = 1; //Deleted Status
        $resource = "Roles"; //Models
        $action = "Delete"; //CRUD
        $previous_state = $role;
        $description = "A Role was Deleted with a name of ".request('role_name');
        $action_taken_by = $audit_email;

        //Instantiating the audit class
        Audit::storeAudit($resource, $action, $previous_state, $description, $action_taken_by);

        $role->where('id', $role->id)->update(array('deleted' => $deleted));

        return redirect()->back()->with('message', 'You have successfully Deleted a Role');

        } catch (\Exception $e) {
            return redirect()->back()->withError('error', 'Failed to Delete a Role');
        }
    }
    
}
