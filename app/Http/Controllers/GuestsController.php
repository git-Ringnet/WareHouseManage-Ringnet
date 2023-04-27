<?php

namespace App\Http\Controllers;

use App\Models\Guests;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Guests::orderBy('id', 'ASC')->paginate(10);
        return view('tables.guest.guests', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tables.guest.addGuest');
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
        $guests = Guests::find($id);
        return view('tables.guest.editGuest', compact('guests'));
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
        $guests = Guests::destroy($id);
        return redirect()->route('guests.index')->with('msg', 'Xóa thành công!');
    }
    public function updateStatus(Request $request)
    {
        $data = $request->all();
        $guests = Guests::findOrFail($data['idGuest']);
        $guests->guest_status = $data['newStatus'];
        $guests->save();
    }
}
