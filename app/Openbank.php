<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Openbank extends Model
{
    protected $fillable = ['bank_id', 'ac_no', 'branch_name', 'amount'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
