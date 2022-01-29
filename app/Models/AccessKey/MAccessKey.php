<?php

namespace App\Models\AccessKey;

use Illuminate\Database\Eloquent\Model;

class MAccessKey extends Model
{
    protected $table = 'm_access_key';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
	}
}