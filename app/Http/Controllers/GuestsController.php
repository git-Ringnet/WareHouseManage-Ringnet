<?php

namespace App\Http\Controllers;

use App\Models\Exports;
use App\Models\Guests;
use Illuminate\Http\Request;

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
            $sortType = 'asc';
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
        $guests = $this->guests->getAllguests($filters, $name, $represent, $phonenumber, $email, $status, $keywords, $sortByArr);
        $title = 'Khách hàng';
        return view('tables.guest.guests', compact('guests', 'sortType', 'string', 'title'));
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
        Guests::create([
            'guest_name' => $request->guest_name,
            'guest_represent' => $request->guest_represent,
            'guest_phone' => $request->guest_phone,
            'guest_email' => $request->guest_email,
            'guest_status' => $request->guest_status,
            'guest_addressInvoice' => $request->guest_addressInvoice,
            'guest_code' => $request->guest_code,
            'guest_addressDeliver' => $request->uest_addressDeliver,
            'guest_receiver' => $request->guest_receiver,
            'guest_phoneReceiver' => $request->guest_phoneReceiver,
            'guest_note' => $request->guest_note,
        ]);
        return redirect()->route('guests.index')->with('msg', 'Thêm khách hàng thành công!');
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
        return view('tables.guest.editGuest', compact('guests', 'title'));
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
            return redirect()->route('guests.index')->with('danger', 'Không thể xóa, do có thông tin khách hàng trong đơn xuất hàng!');
        }
    }
    public function updateStatus(Request $request)
    {
        $data = $request->all();
        $guests = Guests::findOrFail($data['idGuest']);
        $guests->guest_status = $data['newStatus'];
        $guests->save();
    }
}
