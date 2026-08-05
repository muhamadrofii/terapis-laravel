<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'therapist_id',
        'therapist_name',
        'patient_name',
        'session_type',
        'booking_date',
        'booking_time',
        'status',
        'payment_status',
        'payment_proof',
        'qris_payload',
        'notes',
        'price',
        'whatsapp_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }

    public function getTherapistAvatarAttribute()
    {
        if ($this->therapist && !empty($this->therapist->avatar)) {
            return $this->therapist->avatar;
        }

        if (!empty($this->therapist_name)) {
            $namePart = explode(',', $this->therapist_name)[0];
            $matched = User::where('name', 'like', '%' . trim($namePart) . '%')->first();
            if ($matched && !empty($matched->avatar)) {
                return $matched->avatar;
            }
        }

        return 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=150&auto=format&fit=crop&q=80';
    }

    public function getPatientAvatarAttribute()
    {
        if ($this->user && !empty($this->user->avatar)) {
            return $this->user->avatar;
        }

        return 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80';
    }
}
