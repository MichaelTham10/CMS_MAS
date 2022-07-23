<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('users.user-index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create-user', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,name',
            'password' => 'required',  
            'confirmPassword' => 'required|same:password'
        ]);

        User::create([
            'email' => $request->email,
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
        ]);

        return redirect('/user')->with('success', 'User has been added');   
    }

    public function edit($id)
    {
        if(Auth::user()->role_id == 1 || Auth::id() == $id){
            $user = User::findorfail($id);
            $roles = Role::all();
            return view('users.update-user', compact('roles', 'user'));
        }
        else{
            return view('error-page.401');
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::user()->role_id == 1){
            if($request->password != null){
                $request->validate([
                    'email' => 'required|unique:users,email,' . $id,
                    'username' => 'required|unique:users,name,' . $id,
                    'confirmPassword' => 'same:password'
                ]);
    
                User::findOrFail($id)->update([
                    'email' => $request->email,
                    'name' => $request->username,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role
                ]);
            }
            else{
                $request->validate([
                    'email' => 'required|unique:users,email,' . $id,
                    'username' => 'required|unique:users,name,' . $id,
                ]);
    
                User::findOrFail($id)->update([
                    'email' => $request->email,
                    'name' => $request->username,
                    'role_id' => $request->role
                ]);
            }
        }
        else{
            if($request->password != null){
                $request->validate([
                    'email' => 'required|unique:users,email,' . $id,
                    'username' => 'required|unique:users,name,' . $id,
                    'confirmPassword' => 'same:password'
                ]);
    
                User::findOrFail($id)->update([
                    'email' => $request->email,
                    'name' => $request->username,
                    'password' => Hash::make($request->password),
                ]);
            }
            else{
                $request->validate([
                    'email' => 'required|unique:users,email,' . $id,
                    'username' => 'required|unique:users,name,' . $id,
                ]);
    
                User::findOrFail($id)->update([
                    'email' => $request->email,
                    'name' => $request->username,
                ]);
            }
        }
        
        return back()->with('success', 'User has been updated');
    }

    public function delete($id)
    {
        $user = User::findorfail($id);

        if($user->role_id == 1){
            return back()->with('failed', 'Cannot delete superadmin user');
        }
        else{
            User::destroy($id);
            return back()->with('success', 'User has been deleted');
        }
    }

    public function list()
    {
        $query = User::with('role')->where('id', '!=', Auth::id())->get();
        
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = 
            '<td>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                    Options
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/edit-user/'.$row->id.'">Edit</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
                </div>
            </div>
            
            <form action="/delete-user/'.$row->id.'" method="POST">
                '.csrf_field().'
                '.method_field('DELETE').'
                <div class="modal fade" id="ModalDelete'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="container d-flex pl-0"><img src="">
                                    <h3 class="modal-title ml-2" id="exampleModalLabel">Delete this item?</h3>
                                </div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted">If you remove this item it will be gone forever. <br>Are you sure you want to continue?</p>
                            </div>
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            </td>
            ';
            return $actionBtn;
        })
        ->escapeColumns(null)
        ->make(true);
    }
}
