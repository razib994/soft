<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Widraw extends Model
{
    protected $fillable = ['bank_id', 'checkno', 'date', 'branch_name', 'check_image', 'widraw_name', 'amount'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public static function getWidraw() {
        $records = DB::table('widraws')->select("id", "bank_id", 'checkno','date', "branch_name", 'check_image','widraw_name','amount')->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
