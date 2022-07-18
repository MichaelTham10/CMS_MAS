<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('pages.roles.roles-index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        User::findOrFail($id)->update([
            'role_id' => $request->role
        ]);

        return redirect('/roles/index');
    }



    public function list()
    {
        $query = User::with('role');
        $role = Role::all();
        
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('action', function($row) use ($role){

            $options = '';
            // here we prepare the options
            foreach ($role as $roles) {
                $options .= '<option value="'.$roles->id.'">'.$roles->name.'</option>';
            }
            
            $actionBtn = 
            '<td>
                <div class="btn-group">
                <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#contohModal">Edit Role</button>
                </div>

                <div class="modal fade" id="contohModal" role="dialog" arialabelledby="modalLabel" area-hidden="true">
                <div class="modal-dialog " role="document">
                  <div class="modal-content ">
                  
                    <div class="modal-header">

                    
                    
                    </div>
                    <form action="/update/role/'.$row->id.'" method="POST">
            
                    '.csrf_field().'
                    '.method_field('patch').'
                        <div class="d-flex justify-content-center mb-5">
                            
                        <select name="role" class="form-select form-select-sm" aria-label="">
                        '.$options.'
                        </select>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Update</button> 
                        </div>

                    </form>
                  </div>
                </div>
              </div>

            
                
            </td>
            ';
            return $actionBtn;
        })
        ->escapeColumns(null)
        ->make(true);
    }
}
