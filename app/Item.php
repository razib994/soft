<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $fillable = ['category_id', 'items_name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getitem() {
        $records = DB::table('items')
            ->select("items.id", "categories.category_name", 'items.items_name')
            ->join('categories','items.category_id', 'categories.id')
            ->orderBy('id', 'asc')->get()->toArray();
        return $records;
    }
}
