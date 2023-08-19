<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = [];
        if($request->get('keyword')) {
            $users = User::search($request->keyword)->get();
        } else {
            $users = User::all();
        }
        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:30',
                'role' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:12|confirmed'
            ]
        );

        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()->withInput($request->all())
                ->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]
            );

            $user->assignRole($request->role);
            Alert::success('Create User', "Berhasil");
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Create User', "Gagal");
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()->withInput($request->all())
                ->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // dd($user->roles->first());
        return view('users.edit', [
            'user' => $user,
            'roleSelected' => $user->roles->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role' => 'required'
            ]
        );

        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()->withInput($request->all())
                ->withErrors($validator);
        }

        DB::beginTransaction();

        try {

            $user->syncRoles($request->role);
            Alert::success('Edit User', "Berhasil");
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Edit User', "Gagal");
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()
                ->back()->withInput($request->all())
                ->withErrors($validator);
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();

        try {

            $user->removeRole($user->roles->first());
            $user->delete();
            Alert::success('Delete User', "Berhasil");
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Delete User', "Gagal");
        } finally {
            DB::commit();
            return redirect()->back();
        }
    }
}
