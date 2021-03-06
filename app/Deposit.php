<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deposit extends Model
{
    protected $fillable = ['bank_id', 'checkno', 'date', 'branch_name', 'check_image', 'depositers_name', 'amount'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public static function getDeposit() {
        $records = DB::table('deposits')->select("id", "bank_id", 'checkno','date', "branch_name", 'check_image','depositers_name','amount')->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
