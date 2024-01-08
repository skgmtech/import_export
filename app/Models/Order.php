<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded=[]; /**The $guarded property is an array that holds a list of attributes that are not mass assignable. In this case, it's an empty array ([]), meaning that all attributes are mass assignable. */

}
