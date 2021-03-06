<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $fillable = ['project_name', 'project_address', 'date'];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function projectPayments()
    {
        return $this->hasMany(ProjectPayment::class);
    }
    public static function getProject() {
        $records = DB::table('projects')->select("id", "project_name", "project_address", "date")->orderBy('id', 'asc')->get()->toArray();
        return $records;
        }


}

