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
        $allRoles = new Roles;
        $allRoles = $allRoles->getAll();

        $filters = [];
        $status = [];
        $roles = [];
        $string = array();
        $class = '';
        $name = '';
        if (!empty($request->name)) {
            $name = $request->name;
            $nameArr = explode(',.@', $name);
            array_push($string, ['label' => 'Tên nhân viên:', 'values' => $nameArr, 'class' => 'name']);
        }
        $phonenumber = '';
        if (!empty($request->phonenumber)) {
            $phonenumber = $request->phonenumber;
            $nameArr = explode(',.@', $phonenumber);
            array_push($string, ['label' => 'Số điện thoại:', 'values' => $nameArr, 'class' => 'phonenumber']);
        }
        $email = '';
        if (!empty($request->email)) {
            $email = $request->email;
            $nameArr = explode(',.@', $email);
            array_push($string, ['label' => 'Email:', 'values' => $nameArr, 'class' => 'email']);
        }

        if (!empty($request->status)) {
            $statusValues = [1 => 'Active', 0 => 'Disable'];
            $status = $request->input('status', []);
            $statusLabels = array_map(function ($value) use ($statusValues) {
                return $statusValues[$value];
            }, $status);
            array_push($string, ['label' => 'Trạng thái:', 'values' => $statusLabels, 'class' => 'status']);
        }

        if (!empty($request->roles)) {
            $roles = $request->input('roles', []);
            if (!empty($roles)) {
                $selectedRoles = Roles::whereIn('id', $roles)->get();
                $selectedRoleNames = $selectedRoles->pluck('name')->toArray();
            }
            array_push($string, ['label' => 'Vai trò:', 'values' => $selectedRoleNames, 'class' => 'roles']);
        }

        $keywords = null;

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }
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
            $sortType = 'desc';
        }

        $usersList = $this->users->getAllUsers($filters, $name, $phonenumber, $email, $status, $roles, $keywords, $sortBy, $sortType);
        $title = 'Nhân viên';
        return view('admin.userslist', compact('title', 'usersList', 'sortType', 'allRoles', 'string', 'title'));
    }


    public function add()
    {
        $roles = new Roles;
        $title = 'Thêm nhân viên';
        return view('admin/adduser', compact('title'))->with('roles', $roles->getAll());
    }
    public function addUser(UserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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
        $request->session()->put('id', $id);
        $user = User::where('id', $id)->get();
        // $userDetail = $userDetail[0];
        $userDetail = User::find($id);
        $roles = new Roles;
        // dd($id);
        $title = 'Chỉnh sửa nhân viên';
        return view('admin/edituser', ['useredit' => $user], compact('userDetail', 'title'))->with('roles', $roles->getAll());
    }
    public function editUser(UserRequest $request)
    {
        $id = session('id');
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'roleid' => $request->role,
            'phonenumber' => $request->phonenumber,
            'status' => $request->status,
        ];
        // dd($id);

        $this->users->updateUser($data, $id);
        return redirect(route('admin.userslist'))->with('msg', 'Sửa người dùng thành công');
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

    public function deleteListUser(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            User::whereIn('id', $list)->delete();
            return response()->json(['success' => true, 'msg' => 'Xóa người dùng thành công', 'ids' => $list]);
        }
        return response()->json(['success' => false, 'msg' => 'Xóa người dùng thất bại']);
    }
    public function activeStatusUser(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = User::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                    $value->status = 1;
                    $value->save();
                }
            return response()->json(['success' => true, 'msg' => 'Thay đổi trạng thái người dùng thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
    public function disableStatusUser(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = User::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                    $value->status = 0;
                    $value->save();
                }
            return response()->json(['success' => true, 'msg' => 'Thay đổi trạng thái người dùng thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
}
