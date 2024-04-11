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

//update role using role id
Route::get('update/{id}', function($id){
    $role = Role::findOrFail($id);
//    return $role;
    $role->name = 'editor';
    $role->save();
});

//update role using user id
Route::get('updateRole/{id}', function($id){
    $user = User::findOrFail($id);
    if($user->roles){
        foreach($user->roles as $role){
            if($role->name = 'subscriber'){
                $role->name = 'author';
                $role->save();
            }
        }
    } else {
        return 'this user has no role';
    }
});

//delete single record
Route::get('deleteRole/{id}', function($id){
    $user = User::findOrFail($id);
    foreach($user->roles as $role){
        $role->whereId(4)->delete();
    }
});

//attaching a role to a user without adding to role table
Route::get('attachRole/{userId}/{roleId}', function($userId, $roleId){
    $user = User::findOrFail($userId);
    $user->roles()->attach($roleId);
});

//detaching a role from a user
Route::get('detachRole/{userId}/{roleId}', function($userId, $roleId){
    $user = User::findOrFail($userId);
    $user->roles()->detach($roleId);
});

//sync user and roles. Mass assignment roles to an user
Route::get('sync/{userId}', function($userId){
    $user = User::findOrFail($userId);

    $user->roles()->sync([1,2,3]);
});

