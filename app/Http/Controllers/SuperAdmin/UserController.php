<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        if($request->rol && $request->rol != 'todos')
        {
            $users = User::role($request->rol)->paginate(15);
        } else
        {
            $users = User::paginate(15);
        }
        return view('backoffice.users.index', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Province::all();
        $province_id = old('province_id') ? old('province_id') : $provincias->first()->id;
        $localidades = City::where('province_id', $province_id)->orderBy('name')->get();
        $roles = Role::all();

        return view('backoffice.users.create', [
            'provincias' => $provincias,
            'localidades' => $localidades,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =  [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'telefono' => 'nullable',
            'cuit' => 'nullable|unique:users',
            'codigo_postal' => 'nullable',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'roles' => 'required|array',
            'role.*' => 'required|exists:roles,name',
        ];
        Validator::make($request->all(),$rules)->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'cuit' => $request->cuit,
            'codigo_postal' => $request->codigo_postal,
            'province_id' => $request->province_id ? $request->province_id : null,
            'city_id' => $request->city_id ? $request->city_id : null,
        ]);

        foreach ($request->roles as $role)
        {
            $user->assignRole($role);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $provincias = Province::all();
        $province_id = old('province_id') ? old('province_id') : $user->province_id;
        $localidades = $user->city_id ? City::where('province_id', $province_id)->orderBy('name')->get() : collect();
        $roles = Role::all();

        return view('backoffice.users.edit', [
            'provincias' => $provincias,
            'localidades' => $localidades,
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules =  [
            'name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user)],
            'password' => 'nullable',
            'telefono' => 'nullable',
            'cuit' => ['nullable',Rule::unique('users')->ignore($user)],
            'codigo_postal' => 'nullable',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'roles' => 'required|array',
            'role.*' => 'required|exists:roles,name',
        ];
        Validator::make($request->all(),$rules)->validate();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->cuit = $request->cuit;
        $user->codigo_postal = $request->codigo_postal;
        $user->province_id = $request->province_id;
        $user->city_id = $request->city_id;
        if($request->password)
        {
           $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function permisosShow(User $user)
    {
        return view('backoffice.users.permisos', ['user' => $user]);
    }

    public function permisosStore(Request $request, User $user)
    {
        $permissions = $request->permissions;
        $user->syncPermissions($permissions);
        return redirect()->route('admin.users.index');
    }



}
