<?php

namespace App\Http\Controllers;

use App\Models\Provides;
use App\Models\Orders;
use Illuminate\Http\Request;

class ProvideController extends Controller
{
    private $provides;
    public function __construct()
    {
        $this->provides = new Provides();
    }
    public function index(Request $request)
    {
        // $provides = Provides::orderBy('id', 'ASC')->paginate(10);
        // return view('tables.provide.provides', compact('provides'));
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
        $perPage = $request->input('perPageinput',25); 
        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }
        $provides = $this->provides->getAllProvides($filters, $perPage,$name, $represent, $phonenumber, $email, $status, $keywords, $sortByArr);
        $title = 'Nhà cung cấp';
        return view('tables.provide.provides', compact('provides', 'perPage','sortType', 'string', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tạo nhà cung cấp';
        return view('tables.provide.addProvide', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingprovide = Provides::where('provide_name', $request->provide_name)
            ->where('provide_phone', $request->provide_phone)
            ->where('provide_email', $request->provide_email)
            ->where('provide_code', $request->provide_code)
            ->first();
        if ($existingprovide) {
            return redirect()->route('provides.index')->with('warning', 'Thêm thất bại, Do thông tin nhà cung cấp đã có trong hệ thống!');
        } else {
            Provides::create([
                'provide_name' => $request->provide_name,
                'provide_represent' => $request->provide_represent,
                'provide_phone' => $request->provide_phone,
                'provide_email' => $request->provide_email,
                'provide_address' => $request->provide_address,
                'provide_code' => $request->provide_code,
                'provide_status' => $request->provide_status,
                'debt' => $request->debt == null ? 0 : $request->debt
            ]);
            return redirect()->route('provides.index')->with('msg', 'Thêm nhà cung cấp thành công!');
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
        $provides = Provides::find($id);
        $title = 'Chỉnh sửa nhà cung cấp';
        return view('tables.provide.editProvide', compact('provides', 'title'));
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
        $existingprovide = Provides::find($id)->where('provide_name', $request->provide_name)
            ->where('provide_phone', $request->provide_phone)
            ->where('provide_email', $request->provide_email)
            ->where('provide_code', $request->provide_code)
            ->first();
        if ($existingprovide) {
            return redirect()->route('provides.index')->with('warning', 'Cập nhật thất bại, do trùng thông tin nhà cung cấp đã có trong hệ thống!');
        } else {
            $provides = Provides::find($id);
            $provides->update($request->all());
            return redirect()->route('provides.index')->with('msg', 'Cập nhật thành công!');
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
        $delOrder = Orders::where('provide_id', $id)->first();
        if ($delOrder) {
            return redirect()->route('provides.index')->with('warning', 'Nhà cung cấp đang tồn tại trong đơn hàng');
        } else {
            $provides = Provides::destroy($id);
            return redirect()->route('provides.index')->with('msg', 'Xóa thành công!');
        }
    }
    public function updateStatus(Request $request)
    {
        $data = $request->all();
        $provide = Provides::findOrFail($data['idProvide']);
        $provide->provide_status = $data['newStatus'];
        $provide->save();
    }

    public function deleteListProvides(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $provide_exist = Orders::whereIn('provide_id', $list)->first();
            if (!$provide_exist) {
                Provides::whereIn('id', $list)->delete();
                session()->flash('msg', 'Xóa nhà cung cấp thành công!');
                return response()->json(['success' => true, 'msg' => 'Xóa nhà cung cấp thành công', 'ids' => $list]);
            } else {
                session()->flash('warning', 'Không thể xóa, do có nhà cung cấp trong đơn nhập hàng!');
                return response()->json(['success' => true, 'warning' => 'Không thể xóa, do có nhà cung cấp trong đơn nhập hàng!', 'ids' => $list]);
            }
        }
        session()->flash('warning', 'Xóa nhà cung cấp thất bại!');
        return response()->json(['success' => false, 'msg' => 'Xóa nhà cung cấp thất bại']);
    }
    public function activeStatusProvide(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Provides::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                $value->provide_status = 1;
                $value->save();
            }
            session()->flash('warning', 'Thay đổi trạng thái nhà cung cấp thành công!');
            return response()->json(['success' => true, 'msg' => 'Thay đổi trạng thái nhà cung cấp thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
    public function disableStatusProvide(Request $request)
    {
        if (isset($request->list_id)) {
            $list = $request->list_id;
            $listOrder = Provides::whereIn('id', $list)->get();
            foreach ($listOrder as $value) {
                $value->provide_status = 0;
                $value->save();
            }
            session()->flash('warning', 'Thay đổi trạng thái nhà cung cấp thành công!');
            return response()->json(['success' => true, 'msg' => 'Thay đổi trạng thái nhà cung cấp thành công']);
        }
        return response()->json(['success' => false, 'msg' => 'Not fount']);
    }
}
