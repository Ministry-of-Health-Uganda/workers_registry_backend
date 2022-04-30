<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataLink;

class DataSource extends Model
{
    use HasFactory;


    public function links(){
    	return $this->hasMany(DataLink::class);
    }
}
