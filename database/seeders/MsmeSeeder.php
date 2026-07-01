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

class MsmeSeeder extends Seeder
{
    public function run(): void
    {
        $owners = Citizen::inRandomOrder()->take(10)->get();

        if ($owners->isEmpty()) {
            return;
        }

        $categories = array_column(BusinessCategory::cases(), 'value');
        $legalEntities = array_column(LegalEntityType::cases(), 'value');
        $digitalPlatforms = array_column(DigitalPlatformType::cases(), 'value');
        $capitalSources = array_column(CapitalSource::cases(), 'value');
        $bumdesStatuses = array_column(BumdesPartnershipStatus::cases(), 'value');

        $tokoNames = ['Warung', 'Toko', 'Kios', 'Sembako', 'Catering', 'Bengkel', 'Kedai', 'Boutique', 'Laundry', 'Fotocopy'];

        foreach ($owners as $index => $owner) {
            $randomName = $tokoNames[array_rand($tokoNames)] . ' ' . $owner->fullname;

            Msme::create([
                'citizen_id'                  => $owner->id,
                'business_name'               => $randomName,
                'business_category'           => $categories[array_rand($categories)],
                'license_number'              => 'NIB' . rand(10000000, 99999999), // Menggantikan numerify()
                'employee_count'              => rand(0, 20),
                'monthly_revenue'             => rand(1000000, 50000000),
                'legal_entity_type'           => $legalEntities[array_rand($legalEntities)],
                'uses_digital_payment'        => (bool) rand(0, 1), // Menggantikan fake()->boolean()
                'digital_platform_type'       => $digitalPlatforms[array_rand($digitalPlatforms)],
                'capital_source'              => $capitalSources[array_rand($capitalSources)],
                'is_environmentally_friendly' => (bool) rand(0, 1), // Menggantikan fake()->boolean()
                'bumdes_partnership_status'   => $bumdesStatuses[array_rand($bumdesStatuses)],
            ]);
        }
    }
}
