<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherLoan extends Model
{
    protected $fillable = ['purpose_name', 'date', 'amount'];
}
