<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'unit_id', 'id_number', 'emergency_contact_name',
        'emergency_contact_phone', 'lease_start_date', 'lease_end_date',
        'monthly_rent', 'deposit_paid', 'is_active'
    ];

    protected $casts = [
        'lease_start_date' => 'date',
        'lease_end_date' => 'date',
        'monthly_rent' => 'decimal:2',
        'deposit_paid' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
