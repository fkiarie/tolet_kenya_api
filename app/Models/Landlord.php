<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Landlord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'business_name', 'address', 'id_number', 'tax_pin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }
}
