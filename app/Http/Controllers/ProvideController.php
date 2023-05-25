<?php

namespace App\Http\Controllers;

use App\Models\Provides;
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
         $class='';
         $name = '';
        if (!empty($request->name)) {
            $name = $request->name;
            $nameArr = explode(' ', $name);
            array_push($string, ['label' => 'Đơn vị:', 'values' => $nameArr, 'class' => 'name']);
        }
        $represent = '';
        if (!empty($request->represent)) {
            $represent = $request->represent;
            $nameArr = explode(' ', $represent);
            array_push($string, ['label' => 'Đại diện:', 'values' => $nameArr, 'class' => 'represent']);
        }
        $phonenumber = '';
        if (!empty($request->phonenumber)) {
            $phonenumber = $request->phonenumber;
            $nameArr = explode(' ', $phonenumber);
            array_push($string, ['label' => 'Số điện thoại:', 'values' => $nameArr, 'class' => 'phonenumber']);
        }
        $email = '';
        if (!empty($request->email)) {
            $email = $request->email;
            $nameArr = explode(' ', $email);
            array_push($string, ['label' => 'Email:', 'values' => $nameArr, 'class' => 'email']);
        }
 
         if (!empty($request->status)) {
             $statusValues = [1 => 'Active', 0 => 'Disable'];
             $status = $request->input('status', []);
             $statusLabels = array_map(function ($value) use ($statusValues) {
                 return $statusValues[$value];
             }, $status);
             array_push($string, ['label' => 'Trạng thái:', 'values' => $statusLabels,'class' => 'status']);
         }
         
 
         $keywords = null;
 
         if (!empty($request->keywords)) {
             $keywords = $request->keywords;
         }
         $provides = $this->provides->getAllProvides($filters,$name, $represent, $phonenumber, $email, $status, $keywords, $sortByArr);
         return view('tables.provide.provides', compact('provides', 'sortType', 'string'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tables.provide.addProvide');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Provides::create([
            'provide_name' => $request->provide_name,
            'provide_represent' => $request->provide_represent,
            'provide_phone' => $request->provide_phone,
            'provide_email' => $request->provide_email,
            'provide_address' => $request->provide_address,
            'provide_code' => $request->provide_code,
            'provide_status' => $request->provide_status,
        ]);
        return redirect()->route('provides.index')->with('msg', 'Thêm nhà cung cấp thành công!');
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
        return view('tables.provide.editProvide', compact('provides'));
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
        $provides = Provides::find($id);
        $provides->update($request->all());
        return redirect()->route('provides.index')->with('msg', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provides = Provides::destroy($id);
        return redirect()->route('provides.index')->with('msg', 'Xóa thành công!');
    }
    public function updateStatus(Request $request)
    {
        $data = $request->all();
        $provide = Provides::findOrFail($data['idProvide']);
        $provide->provide_status = $data['newStatus'];
        $provide->save();
    }
}
