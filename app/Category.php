<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['category_name'];

    public function projectPayments()
    {
        return $this->hasMany(ProjectPayment::class);
    }
    public function Items()
    {
        return $this->hasMany(Item::class);
    }
    public static function getCategory() {
        $records = DB::table('categories')->select("id", "category_name")->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
