<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Serinumbers extends Model
{
    use HasFactory;
    protected $table = 'serinumbers';
    protected $fillable = [
        'serinumber', 'product_orderid', 'product_id', 'seri_status'
    ];
    public function addSN($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateSN($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }
    public function deleteSN($length, $request, $newSN, $id)
    {
        $array = DB::table($this->table)->where('order_id', $id)->get();
        $product_id_SN = [];
        $listSN1 = [];
        $delete_id = [];
        foreach ($array as $arSN) {
            $SN_id = $arSN->id;
            array_push($product_id_SN, $SN_id);
        }
        for ($j = 0; $j < count($length); $j++) {
            $listSN = $request->{'productSN' . $j};
            if ($listSN) {
                for ($k = 0; $k < count($listSN); $k++) {
                    array_push($listSN1, $listSN[$k]);
                }
            }
        }
        $delete_id = array_diff($product_id_SN, $newSN);
        $delete_id = array_diff($delete_id, $listSN1);
        return $delete_id;
    }


    public function checkSNS($request)
    {
        $SerialNumbers = $request;
        foreach ($SerialNumbers as $product => $seri) {
            foreach ($seri as $product_name => $SN) {
                $product_order = ProductOrders::where('product_name', $SN['name'])
                    ->where('product_unit', $SN['dvt'])
                    ->where('product_price', $SN['price'])
                    ->where('product_tax', $SN['tax'])
                    ->get();
                if ($product_order) {
                    foreach ($product_order as $order) {
                        $getSN = Serinumbers::where('product_orderid', $order->id)->get();
                        if ($getSN) {
                            foreach ($getSN as $seri) {
                                if (isset($SN['Seri'])) {
                                    foreach ($SN['Seri'] as $Seri) {
                                        if ($seri->serinumber == $Seri) {
                                            return response()->json(['success' => false, 'msg' => $order->product_name, 'data' => $Seri]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return response()->json(['success' => true]);
    }
}
