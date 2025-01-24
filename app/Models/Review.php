<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'eigenaar_id', 'oppas_id'];

    public function eigenaar()
    {
        return $this->belongsTo(User::class, 'eigenaar_id');
    }

    public function oppas()
    {
        return $this->belongsTo(User::class, 'oppas_id');
    }
}