<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestMoney extends Model
{
    protected $fillable = ['purpose_name', 'date', 'amount'];

    public function investadds()
    {
        return $this->hasMany(InvestAdd::class);
    }
}
