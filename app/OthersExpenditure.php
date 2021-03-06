<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OthersExpenditure extends Model
{
    protected $fillable = ['purpose_name', 'date', 'amount'];
}
