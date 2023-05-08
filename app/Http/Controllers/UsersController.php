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


    public function show(Request $request)
    {
        $title = "Danh sách người dùng";


        //Xử lí sắp xếp 
        $sortType = $request->input('sort-type');

        $sortBy = $request->input('sort-by');

        $allowSort = ['asc', 'desc'];

        if (!empty($sortType) && in_array($sortType, $allowSort)) {


            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }

        $sortByArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        $allRoles = new Roles;
        $allRoles = $allRoles->getAll();

        $filters = [];
        $status = [];
        $roles = [];
        $string = array();
        $class='';

        if (!empty($request->status)) {
            $statusValues = [0 => 'Active', 1 => 'Disable'];
            $status = $request->input('status', []);
            $statusLabels = array_map(function ($value) use ($statusValues) {
                return $statusValues[$value];
            }, $status);
            array_push($string, ['label' => 'Trạng thái', 'values' => $statusLabels,'class' => 'status']);
        }
        
        if (!empty($request->roles)) {
            $roles = $request->input('roles', []);
            if (!empty($roles)) {
                $selectedRoles = Roles::whereIn('id', $roles)->get();
                $selectedRoleNames = $selectedRoles->pluck('name')->toArray();
            }
            array_push($string, ['label' => 'Vai trò', 'values' => $selectedRoleNames,'class' => 'roles']);
        }

        $keywords = null;

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }
        $usersList = $this->users->getAllUsers($filters, $status, $roles, $keywords, $sortByArr);
        return view('admin/userslist', compact('title', 'usersList', 'sortType', 'allRoles', 'string'));
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
            'email' => $request->email,
            'password' => $request->password,
            'roleid' => $request->role,
            'phonenumber' => $request->phonenumber,
            'status' => $request->status,
        ];
        $this->users->addUser($data);

        return redirect()->route('admin.userslist')->with('msg', 'Thêm người dùng thành công');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        // $id = session('id');
        // $request->session()->put('id', $id);
        $user = User::where('id', $id)->get();
        // $userDetail = $userDetail[0];
        $userDetail = User::find($id);
        $roles = new Roles;
        return view('admin/edituser', ['useredit' => $user], compact('userDetail'))->with('roles', $roles->getAll());
    }
    public function editUser(UserRequest $request)
    {
        $id = $request->id;
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'roleid' => $request->role,
            'phonenumber' => $request->phonenumber,
            'status' => $request->status,
        ];
        $this->users->updateUser($data, $id);
        return back();
    }
    public function deleteUser(Request $request)
    {
        $user = $request->id;
        $user = User::where('id', $user)->first();
        $user->delete();
        return back()->with('msg', 'Xóa người dùng thành công');
    }
    public function updateStatus(Request $request)
    {
        $data = $request->all();
        // var_dump($data);
        $user = User::findOrFail($data['idStatus']);
        $user->status = $data['newStatus'];
        $user->save();
    }
}
