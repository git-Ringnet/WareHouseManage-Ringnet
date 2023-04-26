<?php

namespace App\Http\Controllers;

use App\Models\Provides;
use Illuminate\Http\Request;

class provideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provides = Provides::orderBy('id', 'ASC')->paginate(10);
        return view('tables.provide.provides', compact('provides'));
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
            'provide_status' => $request->provide_status,
        ]);
        return redirect()->route('provides.index')->with('successA', 'Thêm nhà cung cấp thành công!');
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
        return redirect()->route('provides.index')->with('successU', 'Cập nhật thành công!');
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
        return redirect()->route('provides.index')->with('successD', 'Xóa thành công!');
    }
}
