<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    protected $fillable = ['project_id', 'client_name', 'phone', 'address', 'floor', 'apartment', 'amount'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function clientPayments()
    {
        return $this->hasMany(ClientPayment::class);
    }
    public static function getclient() {
        $records = DB::table('clients')
            ->select("clients.id", "projects.project_name", 'clients.client_name','clients.phone', "clients.address", 'clients.floor','clients.apartment','clients.amount')
            ->join('projects','projects.id','clients.project_id')
            ->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
