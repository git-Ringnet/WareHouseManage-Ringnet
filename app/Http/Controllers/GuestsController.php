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
        $perPage = $request->input('perPageinput', 25);
        $users = User::whereIn('roleid', [1, 3])->get();
        $guests = $this->guests->getAllguests($filters, $perPage, $users_name, $name, $represent, $phonenumber, $email, $status, $keywords, $sortByArr);
        // dd($guests);
        $title = 'Khách hàng';
        // $guestsCreator = $this->guests->guestsCreator($perPage);
        return view('tables.guest.guests', compact('guests', 'perPage', 'users', 'sortType', 'string', 'title'));
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
        $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
            ->orwhere('guest_code', $request->guest_code)
            ->first();

        if ($existingCustomer) {
            return redirect()->back()->with('warning', 'Thêm thất bại,do thông tin khách hàng đã có trong hệ thống!');
        } else {
            $guest = new Guests();
            $guest->guest_name = preg_replace('/\s+/', ' ', $request->guest_name);
            $guest->guest_phone = $request->guest_phone;
            $guest->guest_email = $request->guest_email;
            $guest->guest_status = $request->guest_status;
            $guest->guest_address = preg_replace('/\s+/', ' ', $request->guest_address);
            $guest->guest_code = $request->guest_code;
            $guest->guest_receiver = preg_replace('/\s+/', ' ', $request->guest_receiver);
            $guest->guest_phoneReceiver = $request->guest_phoneReceiver;
            $guest->guest_email_personal = $request->guest_email_personal;
            $guest->guest_note = preg_replace('/\s+/', ' ', $request->guest_note);
            $guest->user_id = $request->user_id;
            $guest->debt = $request->debt ?? 0;
            $guest->save();
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
        $id = intval($id);
        $existingCustomer = Guests::orwhere('guest_name', $request->guest_name)
            ->orwhere('guest_code', $request->guest_code)
            ->first();
        if ($existingCustomer->id !== $id) {
            return redirect()->back()->with('warning', 'Cập nhật thất bại, do thông tin khách hàng đã có trong hệ thống!');
        } else {
            $guests = Guests::findOrFail($id);
            $guests->guest_name = preg_replace('/\s+/', ' ', $request->guest_name);
            $guests->guest_phone = $request->guest_phone;
            $guests->guest_email = $request->guest_email;
            $guests->guest_status = $request->guest_status;
            $guests->guest_address = preg_replace('/\s+/', ' ', $request->guest_address);
            $guests->guest_code = $request->guest_code;
            $guests->guest_receiver = preg_replace('/\s+/', ' ', $request->guest_receiver);
            $guests->guest_phoneReceiver = $request->guest_phoneReceiver;
            $guests->guest_email_personal = $request->guest_email_personal;
            $guests->guest_note = preg_replace('/\s+/', ' ', $request->guest_note);
            $guests->user_id = $request->user_id;
            $guests->debt = $request->debt ?? 0;
            $guests->save();
            return redirect()->route('guests.index')->with('msg', 'Cập nhật thành công!');
        }
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
            $id = $request->id;
            $listOrder = Guests::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                $value->guest_status = 1;
                $value->user_id = $id;
                $value->save();
            }
            session()->flash('msg', 'Thay đổi người phụ trách thành công');
            return response()->json(['success' => true, 'msg' => 'Thay đổi người phụ trách thành công']);
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
