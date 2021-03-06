<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherLoanExpense extends Model
{
    protected $fillable = ['investor_id', 'bank_id', 'check_no', 'date', 'amount', 'payment_method', 'note'];
}
