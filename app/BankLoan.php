<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankLoan extends Model
{
    protected $fillable = ['investor_name', 'date'];
}
