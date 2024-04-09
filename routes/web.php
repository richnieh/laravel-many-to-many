<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insertUser', function(){
    User::create(['name'=>'rach', 'email'=>'rach@mail.com','password'=>'123']);
});

//insert role
Route::get('/insertRole/{id}', function($id){
    $user = User::findOrFail($id);
    $role = new Role(['name'=>'author']);
//    $role = new Role(['name'=>'editor']);
//    $role = new Role(['name'=>'Subscriber']);
    $user->roles()->save($role);
});

//read role
Route::get('/readRole/{id}', function($id){
    $user = User::findOrFail($id);
    foreach($user->roles as $role){
        echo $role->name. '<br />';
    }
});
