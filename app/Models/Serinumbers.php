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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    function getProductIdsByKeywords($keywords)
    {
        $productIds = [];

        if (!empty($keywords)) {
            $product_order = Product::all();

            foreach ($product_order as $value) {
                array_push($productIds, $value->id);
            }

            $serialnumber = DB::table('serinumbers')
                ->join('product', 'serinumbers.product_id', '=', 'product.id')
                ->whereIn('product.id', $productIds)
                ->where('seri_status', '!=', 3)
                ->where('serinumber', 'like', '%' . $keywords . '%')
                ->select('serinumbers.product_id')
                ->get();

            $product_id = [];

            foreach ($serialnumber as $value) {
                array_push($product_id, $value->product_id);
            }
        }

        return $product_id;
    }

    function getProductIdsHistory($keywords)
    {
        $productIds = [];

        if (!empty($keywords)) {
            $product_order = Product::all();

            foreach ($product_order as $value) {
                array_push($productIds, $value->id);
            }

            $serialnumber = DB::table('serinumbers')
                ->join('product', 'serinumbers.product_id', '=', 'product.id')
                ->whereIn('product.id', $productIds)
                ->where('seri_status', '=', 3)
                ->where('export_seri', '!=', 0)
                ->where('serinumber', 'like', '%' . $keywords . '%')
                ->select('serinumbers.product_id')
                ->get();

            $product_id = [];

            foreach ($serialnumber as $value) {
                array_push($product_id, $value->product_id);
            }
        }

        return $product_id;
    }


    public function checkSNS($request)
    {
        $SerialNumbers = $request;
        foreach ($SerialNumbers as $product => $seri) {
            foreach ($seri as $product_name => $SN) {
                $price =  str_replace(',', '', $SN['price']);
                $product_order = ProductOrders::where('product_name', $SN['name'])
                    ->where('product_unit', $SN['dvt'])
                    ->where('product_price', $price)
                    ->where('product_tax', $SN['tax'])
                    ->get();
                if ($product_order) {
                    foreach ($product_order as $order) {
                        $getSN = Serinumbers::where('product_orderid', $order->id)->get();
                        if ($getSN) {
                            foreach ($getSN as $seri) {
                                if (isset($SN['Seri'])) {
                                    foreach ($SN['Seri'] as $Seri) {
                                        if ($seri->serinumber == $Seri && $seri->provide_id == $SN['provide_id']) {
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
