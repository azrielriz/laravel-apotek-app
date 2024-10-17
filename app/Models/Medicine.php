<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    // public $table = 'medicines';
    // ditambahkan apabila nama model dan migrations tidak sinkron atau tidak sama


    protected $fillable = [
        'type','name','price','stock'
    ];
    
}
