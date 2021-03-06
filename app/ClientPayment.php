<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientPayment extends Model
{
    protected $fillable = ['client_id','bank_id', 'check_no','date', 'amount', 'payment_method', 'check_file', 'note'];

    public function Bank(){
        return $this->belongsTo(ClientPayment::class);
    }
    public static function getClientPayment() {
        $records = DB::table('client_payments')
            ->select("client_payments.id", "clients.client_name","banks.bank_name","client_payments.date","client_payments.amount","client_payments.payment_method","client_payments.note")
            ->join('clients','clients.id','=','client_payments.client_id')
            ->join('banks','banks.id','=','client_payments.bank_id')
            ->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
