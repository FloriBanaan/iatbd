<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bericht extends Model
{
    use HasFactory;

    protected $table = 'berichten';

    protected $fillable = ['huisdier_id', 'user_id', 'bericht'];

    public function huisdier()
    {
        return $this->belongsTo(Huisdier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}