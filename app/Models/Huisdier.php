<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Huisdier extends Model
{
    use HasFactory;

    protected $table = 'huisdieren';

    protected $fillable = [
        'naam_dier',
        'soort_dier',
        'begindatum_oppassen',
        'einddatum_oppassen',
        'uurtarief',
        'belangrijke_zaken',
        'foto_huisdier',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function berichten()
    {
        return $this->hasMany(Bericht::class);
    }
    public function acceptedUser()
    {
        return $this->belongsTo(User::class, 'accepted_user_id');
    }
    public function acceptedHuisdieren()
    {
        return $this->hasMany(AcceptedHuisdier::class);
    }
}
