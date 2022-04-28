<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Valida los campos de la petición
        $input = $request->validate([
            'name'                      => 'required',
            'email'                     => 'required',
            'password'                  => 'nullable',
            'phone_number'              => 'nullable',
            'address'                   => 'nullable',
            'official_identification'   => 'nullable|mimes:pdf,jpeg',
            'image'                     => 'nullable|image',
        ]);


        // Si la petición contiene un archivo
        if( $request->hasFile('image')){
            // Si tenia una imagen, borra la imagen anterior
            if($user->image){
                Storage::delete($user->image);
            }

            // Actualiza la nueva imagen del usuario
            $input['image'] = $request->file('image')->store('UserImages');

        } else {
            
            //Si no contiene un archivo, no incluye el campo
            $input = Arr::except($input, array('image'));
        }

        if( $request->hasFile('official_identification')){
            if($user->official_identification){
                Storage::delete($user->official_identification);
            }
            $input['official_identification'] = $request->file('official_identification')->store('UserIdentifications');
        } else {
            $input = Arr::except($input, array('official_identification'));
        }

        // Si la petición contiene una contraseña
        if( !empty($input['password'])){

            // Guarda una nueva contraseña encriptada
            $input['password'] = Hash::make($input['password']);

        } else {

            // Si no contiene una contraseña, no incluye el campo
            $input = Arr::except($input, array('password'));
        }


        // Actualiza el usuario
        $user->update($input);

        // Encuentra el Usuario en la tabla de roles y lo elimina para posteriormente actualizarlo
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        // Asignación de rol
        $user->assignRole($request->roles);

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if($user->image){
            Storage::delete($user->image);
        }

        if($user->official_identification){
            Storage::delete($user->official_identification);
        }

        $user->delete();
        
        
        return redirect('admin/users');
    }

    public function getProfile(){
        
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    public function getAgents(){

        $agents = User::role('Cliente')->get();
        return view('agents.index', compact('agents'));
    }

    public function getAgent(User $user){

        return view('agents.show', compact('user'));
    }
}
