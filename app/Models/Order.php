<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'medicine', 'name_customer', 'total_price'
    ];
    //migration tidak bisa membaca tipe data array, jadi array di migration (json.)agar nantinya bentuk medicines tetap berupa array (store/get) jd harus dipastikan dengan $casts
    protected $casts = [
        'medicines'=>'array'
    ];
}