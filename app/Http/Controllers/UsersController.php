<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use \Illuminate\Support\Facades\DB;

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
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:8',
            'role' => ['required','integer',function($attribute,$value,$fail){
                if($value ==0){
                    $fail('Bắt buộc phải chọn chức vụ');
                }
            }],
            'phonenumber' => ['required', 'numeric', 'digits_between:1,11'],
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'role.required' => 'Vui lòng chọn quyền',
            'phonenumber.required' => 'Vui lòng nhập số điện thoại',
            'phonenumber.numeric' => 'Số điện thoại chỉ được nhập số',
            'phonenumber.digits_between' => 'Số điện thoại không được dài quá 11 số'
        ]);

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

    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->get();
        $roles = new Roles;
        return view('admin/edituser', ['useredit' => $user])->with('roles', $roles->getAll());
    }
    public function editUser(Request $request)
    {
        $id = $request->id;

        $user = User::where('id', $id)->get();
        $user[0]->name =  $request->name;
        $user[0]->email = $request->email;
        $user[0]->password = $request->password;
        $user[0]->role = $request->role;
        $user[0]->save();
        return redirect()->route('show.user');
    }
    public function deleteUser(Request $request)
    {
        $user = $request->id;
        $user = User::where('id', $user)->first();
        $user->delete();
        return redirect()->route('show.user')->with('status', 'Delete Successfully');
    }
}
