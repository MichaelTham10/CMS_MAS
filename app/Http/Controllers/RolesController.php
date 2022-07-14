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



    public function list()
    {
        $query = User::all();
        $roles = Role::all();
        
        return datatables($query)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            
            $actionBtn = 
            '<td>
                <div class="btn-group">
                <a href=""  class="btn btn-primary btn-sm" id="submit" data-toggle="modal" data-target="#modalDetail">Change Role</a>
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                <form action="/roles/update/'.$row->id.'" method="post">
                '.csrf_field().'
                '.method_field('put').'

                </form>
                    
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
