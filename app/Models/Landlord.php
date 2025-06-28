<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Landlord extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name', 'address', 'id_number', 'tax_pin'
    ];

    /**
     * Get the buildings associated with the landlord.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buildings()
    {
        return $this->hasMany(Building::class);
    }
}
