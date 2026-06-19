<?php

namespace Database\Seeders;

use App\Enums\BumdesPartnershipStatus;
use App\Enums\BusinessCategory;
use App\Enums\CapitalSource;
use App\Enums\DigitalPlatformType;
use App\Enums\LegalEntityType;
use App\Models\Citizen;
use App\Models\Msme;
use Illuminate\Database\Seeder;

class MSMESeeder extends Seeder
{
    public function run(): void
    {
        $owners = Citizen::inRandomOrder()
            ->take(10)
            ->get();

        foreach ($owners as $owner) {

            Msme::create([
                'citizen_id' => $owner->id,
                'business_name' => fake()->company(),
                'business_category' => fake()->randomElement(array_column(BusinessCategory::cases(), 'value')),
                'license_number' => fake()->numerify('NIB########'),
                'employee_count' => rand(0, 20),
                'monthly_revenue' => rand(1000000, 50000000),
                'legal_entity_type' => fake()->randomElement(array_column(LegalEntityType::cases(), 'value')),
                'uses_digital_payment' => fake()->boolean(),
                'digital_platform_type' => fake()->randomElement(array_column(DigitalPlatformType::cases(), 'value')),
                'capital_source' => fake()->randomElement(array_column(CapitalSource::cases(), 'value')),
                'is_environmentally_friendly' => fake()->boolean(),
                'bumdes_partnership_status' => fake()->randomElement(array_column(BumdesPartnershipStatus::cases(), 'value')),
            ]);
        }
    }
}
