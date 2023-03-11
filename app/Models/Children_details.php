<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children_details extends Model
{
    use HasFactory;
    protected $table = 'children_details';
    protected $guarded = [];
    // protected $fillable = [
    //     'child_name',
    //     'date_of_birth',
    //     'class',
    //     'address',
    //     'country',
    //     'state',
    //     'city',
    //     'zip_code',
    //     'child_photo'
    // ];
}
