<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role_show', ['only' => 'index']);
        $this->middleware('permission:role_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role_detail', ['only' => 'show']);
        $this->middleware('permission:role_delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = [];
        if ($request->has('keyword')) {
            $roles = Role::where('name', 'LIKE', "%{$request->keyword}%")
                ->get();
        } else {
            $roles = Role::all();
        }
        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    public function select(Request $request)
    {
        $roles = Role::select('id', 'name')->limit(7);
        if ($request->has('q')) {
            $roles->where('name', 'LIKE', "%{$request->q}%");
        }

        return response()->json($roles->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create', [
            'authorities' => config('permission.authorities')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50|unique:roles,name',
                'permissions' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->name
            ]);
            $role->givePermissionTo($request->permissions);
            Alert::success('Tambah Role', 'Berhasil');
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Tambah Role', 'Gagal');
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles.detail', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'rolePermissions' => $role->permissions->pluck('name')->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'permissionChecked' => $role->permissions->pluck('name')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
                'permissions' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $role->name = $request->name;
            $role->syncPermissions($request->permissions);
            $role->save();
            Alert::success('Edit Role', 'Berhasil');
            return redirect()->route('roles.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Edit Role', 'Gagal');
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

        if (User::role($role->name)->count()) {
            Alert::warning('Delete Role ', 'Role ' . $role->name . ' masih digunakan');

            return redirect()->route('roles.index');
        }

        // Proses delete
        DB::beginTransaction();
        try {
            $role->revokePermissionTo($role->permissions->pluck('name')->toArray());
            $role->delete();
            Alert::success('Delete Role', 'Berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Delete Role', 'Gagal');
        } finally {
            DB::commit();
        }

        return redirect()->route('roles.index');
    }
}
