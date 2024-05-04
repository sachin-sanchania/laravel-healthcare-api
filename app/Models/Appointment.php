<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'healthcare_professional_id',
        'status',
    ];

    protected array $dates = ['appointment_start_time', 'appointment_end_time'];

    protected $casts = [
        'user_id' => 'integer',
        'healthcare_professional_id' => 'integer',
        'appointment_start_time' => 'datetime',
        'appointment_end_time' => 'datetime',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function healthcareProfessional(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(HealthcareProfessional::class);
    }
}
