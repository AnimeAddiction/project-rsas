<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show all users
    public function index() {
        return view('users.index');
    }

    // show create user form
    function create(){
        return view('users.create');
    }

    public function store(Request $request) {
        // $formFields = $request->validate([
        //     'id' => 'required',
        //     'password' => 'required',
        //     'role' => 'required',
        //     'first' => 'required',
        //     'middle' => 'required',
        //     'last' => 'required',
        //     'gender' => 'required',
        // ]);

        // // Hash Password
        // // $formFields['password'] = bcrypt($formFields['password']);

        // // create user
        // // User::create($formFields);
        // User::insert($formFields);

        // return redirect('/')->with('message', 'User created successfully!');

        $id = $request->input('id');
        $password = $request->input('password');
        $role = $request->input('role');
        $first = $request->input('first');
        $middle = $request->input('middle');
        $last = $request->input('last');
        $gender = $request->input('gender');

        $isInsertSuccess = User::insert(['id'=>$id,
                                            'password'=>$password,
                                            'role'=>$role,
                                            'first'=>$first,
                                            'middle'=>$middle,
                                            'last'=>$last,
                                            'gender'=>$gender
                                        ]);

        return redirect('/')->with('message', "User created successfully!");
    }

    // function DataInsert(Request $request){
    //     $id = $request->input('user_id');
    //     $password = $request->input('user_pswrd');
    //     $role = $request->input('role');
    //     $first = $request->input('first');
    //     $middle = $request->input('middle');
    //     $last = $request->input('last');
    //     $gender = $request->input('gender');

    //     $isInsertSuccess = User_table::insert(['id'=>$id,
    //                                         'password'=>$password,
    //                                         'role'=>$role,
    //                                         'first'=>$first,
    //                                         'middle'=>$middle,
    //                                         'last'=>$last,
    //                                         'gender'=>$gender
    //                                     ]);

    //     if($isInsertSuccess) echo '<h1>Create User Success</h1>';
    //     else echo '<h1>Create User Failed </h1>';

    // }
}
