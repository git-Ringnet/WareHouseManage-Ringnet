<?php

namespace App\Http\Controllers;

use App\Models\Exports;
use App\Models\Guests;
use App\Models\Products;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $export = Exports::leftjoin('guests', 'exports.guest_id', '=', 'guests.id')
            ->leftjoin('users', 'exports.user_id', '=', 'users.id')
            ->paginate(10);
        return view('tables.export.exports', compact('export'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::all();
        $customer = Guests::all();
        return view('tables.export.addExport', compact('customer', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function searchExport(Request $request)
    {
        $data = $request->all();
        $customer = Guests::findOrFail($data['idCustomer']);
        return $customer;
    }
    public function updateCustomer(Request $request)
    {
        $data = $request->all();
        $update_guest = Guests::findOrFail($data['id']);
        $update_guest->guest_name = $data['guest_name'];
        $update_guest->guest_addressInvoice = $data['guest_addressInvoice'];
        $update_guest->guest_code = $data['guest_code'];
        $update_guest->guest_addressDeliver = $data['guest_addressDeliver'];
        $update_guest->guest_receiver = $data['guest_receiver'];
        $update_guest->guest_represent = $data['guest_represent'];
        $update_guest->guest_email = $data['guest_email'];
        $update_guest->guest_phone = $data['guest_phone'];
        $update_guest->guest_pay = $data['guest_pay'];
        $update_guest->guest_payTerm = $data['guest_payTerm'];
        $update_guest->guest_note = $data['guest_note'];
        $update_guest->save();
    }
    public function addCustomer(Request $request)
    {
        
    }
}
