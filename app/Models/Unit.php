<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id', 'unit_number', 'unit_type', 'rent_amount',
        'deposit_amount', 'description', 'floor_number', 'is_occupied', 'is_active'
    ];

    protected $casts = [
        'rent_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'is_occupied' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    public function getUnitTypeDisplayAttribute()
    {
        return match($this->unit_type) {
            'bedsitter' => 'Bedsitter',
            'studio' => 'Studio',
            '1_bedroom' => '1 Bedroom',
            '2_bedroom' => '2 Bedroom',
            '3_bedroom' => '3 Bedroom',
            'shop' => 'Shop',
            'bungalow' => 'Bungalow',
            default => ucfirst($this->unit_type),
        };
    }
}
