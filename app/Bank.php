<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bank extends Model
{
    protected $fillable = ['bank_name','ac_no','branch_name','amount'];

    public function widraws()
    {
        return $this->hasMany(Widraw::class);
    }
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
    public function openbanks()
    {
        return $this->hasMany(Deposit::class);
    }
    public function projectPayments(){
        return $this->hasMany(ProjectPayment::class);
    }
    public function clientPayments(){
        return $this->hasMany(ClientPayment::class);
    }
    public static function getBank() {
        $records = DB::table('banks')->select("id", "bank_name","ac_no","branch_name","Amount")->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
