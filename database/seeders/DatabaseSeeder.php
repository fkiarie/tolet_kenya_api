<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Landlord;
use App\Models\Building;
use App\Models\Unit;
use App\Models\Tenant;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Landlord
        $landlordUser = User::create([
            'name' => 'Jane Landlord',
            'email' => 'landlord@example.com',
            'password' => Hash::make('password'),
            'phone' => '+254700123456',
            'role' => 'landlord',
        ]);

        $landlord = Landlord::create([
            'user_id' => $landlordUser->id,
            'business_name' => 'Jane Rentals Ltd',
            'address' => 'Nairobi, Kenya',
            'id_number' => '12345678',
            'tax_pin' => 'P123456789',
        ]);

        // Building
        $building = Building::create([
            'landlord_id' => $landlord->id,
            'name' => 'Palm Heights',
            'address' => 'Westlands, Nairobi',
            'city' => 'Nairobi',
            'county' => 'Nairobi',
            'description' => 'Modern apartments in prime location',
            'total_units' => 10,
        ]);

        // Units
        $unitTypes = ['bedsitter', 'studio', '1_bedroom', '2_bedroom'];
        $rentAmounts = [15000, 20000, 25000, 35000];

        for ($i = 1; $i <= 10; $i++) {
            $typeIndex = array_rand($unitTypes);

            Unit::create([
                'building_id' => $building->id,
                'unit_number' => 'A' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'unit_type' => $unitTypes[$typeIndex],
                'rent_amount' => $rentAmounts[$typeIndex],
                'deposit_amount' => $rentAmounts[$typeIndex] * 2,
                'floor_number' => ceil($i / 2),
                'is_occupied' => false,
                'is_active' => true,
            ]);
        }

        // Tenant
        $tenantUser = User::create([
            'name' => 'Tom Tenant',
            'email' => 'tenant@example.com',
            'password' => Hash::make('password'),
            'phone' => '+254711223344',
            'role' => 'tenant',
        ]);

        $unit = Unit::where('is_occupied', false)->first();

        Tenant::create([
            'user_id' => $tenantUser->id,
            'unit_id' => $unit->id,
            'id_number' => '67890123',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_phone' => '+254722334455',
            'lease_start_date' => now()->subMonth(),
            'lease_end_date' => now()->addMonths(11),
            'monthly_rent' => $unit->rent_amount,
            'deposit_paid' => $unit->deposit_amount,
            'is_active' => true,
        ]);

        $unit->update(['is_occupied' => true]);
    }
}
