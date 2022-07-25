<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    // public function index()
    // {
    //     $users = User::all();
    //     return view('pages.roles.roles-index', compact('users'));
    // }

    // public function update(Request $request, $id)
    // {
    //     User::findOrFail($id)->update([
    //         'role_id' => $request->role
    //     ]);

    //     return redirect('/roles/index');
    // }

    // public function list()
    // {
    //     $query = User::with('role');
    //     $role = Role::all();
        
    //     return datatables($query)
    //     ->addIndexColumn()
    //     ->addColumn('action', function($row) use ($role){

    //         $options = '';
    //         // here we prepare the options
    //         foreach ($role as $roles) {
    //             $options .= '<option value="'.$roles->id.'">'.$roles->name.'</option>';
    //         }
            
    //         $actionBtn = 
    //         '<td>
    //             <div class="btn-group">
    //             <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#contohModal">Edit Role</button>
    //             </div>

    //             <div class="modal fade" id="contohModal" role="dialog" arialabelledby="modalLabel" area-hidden="true">
    //             <div class="modal-dialog " role="document">
    //                 <div class="modal-content ">
    //                     <div class="modal-header">

                        
                        
    //                     </div>
    //                     <form action="/update/role/'.$row->id.'" method="POST">
                
    //                     '.csrf_field().'
    //                     '.method_field('patch').'
    //                         <div class="d-flex justify-content-center mb-5">
                                
    //                         <select name="role" class="form-select form-select-sm" aria-label="">
    //                         '.$options.'
    //                         </select>
    //                         </div>
                            
    //                         <div class="d-flex justify-content-center">
                                
    //                             <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancel</button>
    //                             <button type="submit" class="btn btn-danger btn-sm">Update</button> 
    //                         </div>

    //                     </form>
    //                 </div>
    //             </div>
    //         </div>

            
                
    //         </td>
    //         ';
    //         '<td>
    //         <div class="btn-group">
    //             <a href="" class="btn btn-primary btn-sm" id="submit" data-toggle="modal" data-target="#modalDetail">Detail</a>
    //             <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                 <span class="sr-only">Toggle Dropdown</span>
    //             </button>
    //             <div class="dropdown-menu dropdown-menu-right">
    //                 <a class="dropdown-item" href="/editquotation/'.$row->id.'">Edit</a>
    //                 <a class="dropdown-item" data-toggle="modal" data-target="#ModalDelete'.$row->id.'" href="#">Delete</a>
    //             </div>
    //         </div>

            
    //         <form action="/delete/quotation/'.$row->id.'" method="POST">
            
    //             '.csrf_field().'
    //             '.method_field('DELETE').'
    //             <div class="modal fade" id="ModalDelete'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    //                 <div class="modal-dialog">
    //                     <div class="modal-content">
    //                         <div class="modal-header">
    //                             <div class="container d-flex pl-0"><img src="">
    //                                 <h3 class="modal-title ml-2" id="exampleModalLabel">Delete this item?</h3>
    //                             </div> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    //                         </div>
    //                         <div class="modal-body">
    //                             <p class="text-muted">If you remove this item it will be gone forever. <br>Are you sure you want to continue?</p>
    //                         </div>
    //                         <div class="modal-footer"> 
    //                             <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
    //                             <button type="submit" class="btn btn-danger">Delete</button> 
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </form>
            
    //         </td>
    //         ';
    //         return $actionBtn;
    //     })
    //     ->escapeColumns(null)
    //     ->make(true);
    // }
}
