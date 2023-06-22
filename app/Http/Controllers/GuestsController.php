<?php

namespace App\Http\Controllers;

use App\Models\Exports;
use App\Models\Guests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestsController extends Controller
{
    private $guests;
    public function __construct()
    {
        $this->guests = new Guests();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $guests = Guests::orderBy('id', 'ASC')->paginate(10);
        // return view('tables.guest.guests', compact('guests'));
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

        $sortByArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];

        $filters = [];
        $status = [];
        $roles = [];
        $string = array();
        $class = '';
        $name = '';
        $users_name = [];
        if (!empty($request->users_name)) {
            $users_name = $request->input('users_name', []);
            array_push($string, ['label' => 'Người phụ trách:', 'values' => $users_name, 'class' => 'users_name']);
        }
        if (!empty($request->name)) {
            $name = $request->name;
            $nameArr = explode(',.@', $name);
            array_push($string, ['label' => 'Đơn vị:', 'values' => $nameArr, 'class' => 'name']);
        }
        $represent = '';
        if (!empty($request->represent)) {
            $represent = $request->represent;
            $nameArr = explode(',.@', $represent);
            array_push($string, ['label' => 'Đại diện:', 'values' => $nameArr, 'class' => 'represent']);
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

        $keywords = null;

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }
        $users = User::whereIn('roleid', [1, 3])->get();
        $guests = $this->guests->getAllguests($filters, $users_name, $name, $represent, $phonenumber, $email, $status, $keywords, $sortByArr);
        // dd($guests);
        $title = 'Khách hàng';
        return view('tables.guest.guests', compact('guests', 'users', 'sortType', 'string', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm khách hàng';
        return view('tables.guest.addGuest', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingCustomer = Guests::where('guest_name', $request->guest_name)
            ->where('guest_email', $request->guest_email)
            ->where('guest_code', $request->guest_code)
            ->where('guest_receiver', $request->guest_receiver)
            ->where('guest_phoneReceiver', $request->guest_phoneReceiver)
            ->where('guest_phone', $request->guest_phone)
            ->first();

        if ($existingCustomer) {
            return redirect()->route('guests.index')->with('warning', 'Thêm thất bại,do thông tin khách hàng đã có trong hệ thống!');
        } else {
            Guests::create([
                'guest_name' => $request->guest_name,
                'guest_phone' => $request->guest_phone,
                'guest_email' => $request->guest_email,
                'guest_status' => $request->guest_status,
                'guest_addressInvoice' => $request->guest_addressInvoice,
                'guest_code' => $request->guest_code,
                'guest_addressDeliver' => $request->guest_addressDeliver,
                'guest_receiver' => $request->guest_receiver,
                'guest_phoneReceiver' => $request->guest_phoneReceiver,
                'guest_pay' => $request->guest_pay,
                'guest_payTerm' => $request->guest_payTerm,
                'guest_note' => $request->guest_note,
                'user_id' =>  $request->user_id,
                'debt' =>  $request->debt,
            ]);
            return redirect()->route('guests.index')->with('msg', 'Thêm khách hàng thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Chỉnh sửa khách hàng';
        $guests = Guests::find($id);
        $usersSale = User::where('roleid', 3)->get();
        return view('tables.guest.editGuest', compact('guests', 'title', 'usersSale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $existingCustomer = Guests::find($id)->where('guest_name', $request->guest_name)
        //     ->where('guest_email', $request->guest_email)
        //     ->where('guest_code', $request->guest_code)
        //     ->where('guest_receiver', $request->guest_receiver)
        //     ->where('guest_phoneReceiver', $request->guest_phoneReceiver)
        //     ->where('guest_phone', $request->guest_phone)
        //     ->first();
        // if ($existingCustomer) {
        //     return redirect()->route('guests.index')->with('warning', 'Cập nhật thất bại, do trùng thông tin khách hàng đã có trong hệ thống!');
        // } else {
        //     $guests = Guests::find($id);
        //     $guests->update($request->all());
        //     return redirect()->route('guests.index')->with('msg', 'Cập nhật thành công!');
        // }
        $guests = Guests::find($id);
        $guests->update($request->all());
        return redirect()->route('guests.index')->with('msg', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guest_exist = Exports::where('guest_id', $id)->first();
        if (!$guest_exist) {
            Guests::destroy($id);
            return redirect()->route('guests.index')->with('msg', 'Xóa thành công!');
        } else {
            return redirect()->route('guests.index')->with('warning', 'Không thể xóa, do có thông tin khách hàng trong đơn xuất hàng!');
        }
    }
    public function updateStatus(Request $request)
    {
        $data = $request->all();
        $guests = Guests::findOrFail($data['idGuest']);
        $guests->guest_status = $data['newStatus'];
        $guests->save();
    }
    public function deleteListGuest(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $guest_exist = Exports::whereIn('guest_id', $list)->first();
            if (!$guest_exist) {
                Guests::whereIn('id', $list)->delete();
                session()->flash('msg', 'Xóa nhà cung cấp thành công');
                return response()->json(['success' => true, 'msg' => 'Xóa nhà cung cấp thành công', 'ids' => $list]);
            } else {
                session()->flash('warning', 'Không thể xóa, do có thông tin khách hàng trong đơn xuất hàng!');
                return response()->json(['success' => true, 'warning' => 'Không thể xóa, do có thông tin khách hàng trong đơn xuất hàng!', 'ids' => $list]);
            }
        }
        return response()->json(['success' => false, 'msg' => 'Xóa nhà cung cấp thất bại']);
    }
    public function activeStatusGuest(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Guests::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                $value->guest_status = 1;
                $value->save();
            }
            session()->flash('msg', 'Thay đổi trạng thái nhà cung cấp thành công');
            return response()->json(['success' => true, 'msg' => 'Thay đổi trạng thái nhà cung cấp thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
    public function disableStatusGuest(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Guests::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                $value->guest_status = 0;
                $value->save();
            }
            session()->flash('msg', 'Thay đổi trạng thái nhà cung cấp thành công');
            return response()->json(['success' => true, 'msg' => 'Thay đổi trạng thái nhà cung cấp thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
}
