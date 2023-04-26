<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use \Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
class UsersController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new User();
    }

    public function show()
    {
        $title = "Danh sách người dùng";
        $usersList = $this->users->getAllUsers();
        return view('admin/userslist', compact('title', 'usersList'));
    }
    public function add()
    {   
        $roles = new Roles;

        return view('admin/adduser')->with('roles', $roles->getAll());
    }
    public function addUser(UserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password,
            'roleid' =>$request->role,
            'phonenumber' =>$request->phonenumber,
        ];
        $this->users->addUser($data);

        return redirect()->route('admin.userslist')->with('status', ' Added Successfully');
    }

    public function edit(Request $request,$id=0)
    {

        $request->session()->put('id', $id);
        $user = User::where('id', $id)->get();
        $roles = new Roles;
        return view('admin/edituser', ['useredit' => $user])->with('roles', $roles->getAll());
    }
    public function editUser(UserRequest $request)
    {
        $id = session('id');
        $data = [
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password,
            'roleid' =>$request->role,
            'phonenumber' =>$request->phonenumber,
        ];
        $this->users->updateUser($data,$id);
        return back();
    }
    public function deleteUser(Request $request)
    {
        $user = $request->id;
        $user = User::where('id', $user)->first();
        $user->delete();
        return back()->with('status', 'Delete Successfully');
    }
}
