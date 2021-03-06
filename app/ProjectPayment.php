<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectPayment extends Model
{
    protected $fillable = ['project_id','category_id', 'bank_id','item_name', 'date', 'amount', 'payment_method', 'check_file', 'note'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function Bank(){
        return $this->belongsTo(ProjectPayment::class);
    }
    public static function getProjectPayment() {
        $records = DB::table('project_payments')
            ->select("project_payments.id", "projects.project_name", "categories.category_name","banks.bank_name","items.items_name", "project_payments.date","project_payments.amount","project_payments.note")
            ->join('projects','projects.id','=','project_payments.project_id')
            ->join('categories','categories.id','=','project_payments.category_id')
            ->join('banks','banks.id','=','project_payments.bank_id')
            ->join('items','items.id','=','project_payments.item_name')
            ->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
