<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//        $this->middleware('permission:permissions-list', ['only' => ['index']]);
//        $this->middleware('permission:permissions-create', ['only' => ['create','store']]);
//        $this->middleware('permission:permissions-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
//        dd(Permission::get());
        if(!auth()->user()->hasPermissionTo('role-list')){
            return abort(401);
        }
        $roles = Permission::orderBy('id','DESC')->get();
        return view('management.permissions.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('management.permissions.create',compact('permission'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
        ]);

        $role = Permission::create($request->all());
//        $role->syncPermissions($request->input('permission'));

        return redirect()->route('permissions.index')
            ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
//        $permission = Permission::get();
//        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
//            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
//            ->all();

        return view('management.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
        ]);

        $role = Permission::find($id);
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard_name');
        $role->save();


        return redirect()->route('permissions.index')
            ->with('success','Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Permission::where('id',$id)->delete();
        return redirect()->route('permissions.index')
            ->with('success','Permission deleted successfully');
    }
}
