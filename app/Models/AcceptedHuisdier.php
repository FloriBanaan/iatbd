<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedHuisdier extends Model
{
    use HasFactory;

    protected $fillable = ['huisdier_id', 'user_id'];

    protected $table = 'accepted_huisdieren';

    public function huisdier()
    {
        return $this->belongsTo(Huisdier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}