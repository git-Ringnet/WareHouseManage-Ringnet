<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class History extends Model
{
    protected $table = 'history';
    use HasFactory;
    protected $fillable = [
        'id',
        'export_id',
        'import_id',
        'product_id',
        'date_time',
        'user_id',
        'provide_id',
        'product_name',
        'product_qty',
        'product_unit',
        'price_import',
        'product_total',
        'import_code',
        'debt_import',
        'import_status',
        'guest_id',
        'export_qty',
        'export_unit',
        'price_export',
        'export_total',
        'export_code',
        'debt_export',
        'export_status',
        'debt_export_start',
        'debt_export_end',
        'debt_import_start',
        'debt_import_end',
        'total_difference',
        'tranport_fee',
        'history_note',
    ];
    public function getAllHistory($filters = [], $keywords = null, $date = [], $provide_namearr = [], $guest = [], $status = [], $unitarr = [], $status_export = [], $orderBy = null, $orderType = null)
    {   
        // $list = [3,1,1];

        // $history = History::leftJoin('debts','history.export_id','debts.export_id')
        //     ->whereIn('debts.id', $list)->get();
        //     dd($history);
        //     foreach ($history as $value) {
        //         $value->export_status = 1;
        //         $value->save();
        // };
        $history = History::leftJoin('users', 'users.id', 'history.user_id')
            ->leftJoin('provides', 'provides.id', 'history.provide_id')
            ->leftJoin('guests', 'guests.id', 'history.guest_id');

        if (!empty($filters)) {
            $history = $history->where($filters);
        }

        if (!empty($keywords)) {
            $history = $history->where(function ($query) use ($keywords) {
                $query->orWhere('product_name', 'like', '%' . $keywords . '%');
                $query->orWhere('provide_name', 'like', '%' . $keywords . '%');
                $query->orWhere('name', 'like', '%' . $keywords . '%');
                $query->orWhere('import_code', 'like', '%' . $keywords . '%');
                $query->orWhere('guest_name', 'like', '%' . $keywords . '%');
                $query->orWhere('export_code', 'like', '%' . $keywords . '%');
            });
        }
        if (!empty($guest)) {
            $history = $history->whereIn('guests.guest_name', $guest);
        }
        if (!empty($name)) {
            $history = $history->whereIn('users.name', $name);
        }
        if (!empty($provide_namearr)) {
            $history = $history->whereIn('provides.id', $provide_namearr);
        }
        if (!empty($date)) {
            $history = $history->wherebetween('history.date_time', $date);
        }
        // Đơn vị tính
        if (!empty($unitarr)) {
            $history = $history->whereIn('export_unit', $unitarr);
        }
        if (!empty($status)) {
            $history = $history->whereIn('import_status', $status);
        }
        if (!empty($status_export)) {
            $history = $history->whereIn('history.export_status', $status_export);
        }

        if (!empty($orderBy) && !empty($orderType)) {
            if ($orderBy == 'updated_at') {
                $orderBy = "history." . $orderBy;
            };
            $history = $history->orderBy($orderBy, $orderType);
        }


        $history = $history->orderBy('history.id', 'desc')->paginate(20);


        return $history;
    }

    public function addHistory($data)
    {
        return DB::table($this->table)->insertGetId($data);
    }
    public function updateHistoryImport($data, $id)
    {
        return DB::table($this->table)->where('product_id', $id)->update($data);
    }
    public function getNameProduct($id){
        return DB::table('product')->whereIn('id',$id)->get();
    }
    public function updateHistoryByImport($data, $id)
    {
        return DB::table($this->table)->where('import_id', $id)->update($data);
    }
    public function updateHistoryByExport($data, $id)
    {
        return DB::table($this->table)->where('export_id', $id)->update($data);
    }
    public function getProduct()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
