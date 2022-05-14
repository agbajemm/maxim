<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
    'name'=>'required|string',
    'phone_no'=>'required|numeric',
    'email'=>'required|email',
    'budget'=>'required|numeric',
    'message'=>'string',
];
}
