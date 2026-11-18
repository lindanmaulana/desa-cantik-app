<?php

namespace App\Services\Statistics;

use App\Enums\DemographicsType;
use App\Enums\EconomicType;
use App\Enums\HealthType;
use App\Enums\InfrastructureType;
use App\Enums\MsmeType;
use App\Enums\SocialType;

class StatisticsExportService
{
    public function __construct(
        protected DemographService $demographService,
        protected SocialService $socialService,
        protected HealthService $healthService,
        protected EconomicService $economicService,
        protected MsmeService $msmeService,
        protected InfrastructureService $infrastructureService,
    ) {}

    public function module(string $module, ?string $type = null, ?string $rw = null, ?string $rt = null): array
    {
        $rw = $rw && $rw !== 'all' ? $rw : null;
        $rt = $rt && $rt !== 'all' ? $rt : null;

        return match ($module) {
            'demograph' => $this->demograph($type, $rw, $rt),
            'social' => $this->social($type, $rw, $rt),
            'health' => $this->health($type, $rw, $rt),
            'economic' => $this->economic($type, $rw, $rt),
            'msme' => $this->msme($type, $rw, $rt),
            'infrastructure' => $this->infrastructure($type),
            default => throw new \InvalidArgumentException('Modul statistik tidak valid.'),
        };
    }

    public function all(?string $rw = null, ?string $rt = null): array
    {
        $reports = [];

        foreach ([DemographicsType::AGE_GROUP, DemographicsType::GENDER, DemographicsType::MARITAL_STATUS, DemographicsType::TERRITORY, DemographicsType::CITIZEN_STATUS] as $type) {
            $reports[] = $this->module('demograph', $type->value, $rw, $rt);
        }

        foreach (SocialType::cases() as $type) {
            $reports[] = $this->module('social', $type->value, $rw, $rt);
        }

        foreach (HealthType::cases() as $type) {
            $reports[] = $this->module('health', $type->value, $rw, $rt);
        }

        foreach (EconomicType::cases() as $type) {
            $reports[] = $this->module('economic', $type->value, $rw, $rt);
        }

        foreach (MsmeType::cases() as $type) {
            $reports[] = $this->module('msme', $type->value, $rw, $rt);
        }

        foreach (InfrastructureType::cases() as $type) {
            $reports[] = $this->module('infrastructure', $type->value, $rw, $rt);
        }

        return $reports;
    }

    private function demograph(?string $type, ?string $rw, ?string $rt): array
    {
        $type = DemographicsType::tryFrom($type ?? DemographicsType::AGE_GROUP->value) ?? DemographicsType::AGE_GROUP;
        $data = match ($type) {
            DemographicsType::AGE_GROUP => $this->demographService->getAgeGroup($rw, $rt),
            DemographicsType::GENDER => $this->demographService->getGender($rw, $rt),
            DemographicsType::MARITAL_STATUS => $this->demographService->getMaritalStatus($rw, $rt),
            DemographicsType::TERRITORY => $this->demographService->getTerritory($rw, $rt),
            DemographicsType::CITIZEN_STATUS => $this->demographService->getStatusCitizen($rw, $rt),
            default => $this->demographService->getAgeGroup($rw, $rt),
        };

        $labels = $type === DemographicsType::TERRITORY
            ? ($data['labels'] ?? [])
            : $type->labels();

        return $this->genderRows('Demografi', $this->demographTitle($type), $labels, $data);
    }

    private function social(?string $type, ?string $rw, ?string $rt): array
    {
        $type = SocialType::tryFrom($type ?? SocialType::RELIGION->value) ?? SocialType::RELIGION;
        $data = match ($type) {
            SocialType::RELIGION => $this->socialService->getReligion($rw, $rt),
            SocialType::SCHOOL_PARTICIPATION => $this->socialService->getSchoolParticipation($rw, $rt),
            SocialType::EDUCATION_LEVEL => $this->socialService->getEducationLevel($rw, $rt),
            SocialType::HIGHEST_DIPLOMA => $this->socialService->getHighestDiploma($rw, $rt),
            SocialType::WELFARE_ASSISTANCE => $this->socialService->getSocialAssistanceStatus($rw, $rt),
            SocialType::SANITATION => $this->socialService->getSanitation($rw, $rt),
            SocialType::WATER_SOURCE => $this->socialService->getWaterSource($rw, $rt),
            SocialType::ELECTRICITY_SOURCE => $this->socialService->getElectricitySource($rw, $rt),
            SocialType::ELECTRICITY_CAPACITY => $this->socialService->getElectricityCapacity($rw, $rt),
        };

        return $this->datasetRows('Sosial', $type->title(), $data['labels'] ?? $type->labels(), $data['datasets'] ?? []);
    }

    private function health(?string $type, ?string $rw, ?string $rt): array
    {
        $type = HealthType::tryFrom($type ?? HealthType::STUNTING_STATUS->value) ?? HealthType::STUNTING_STATUS;
        $data = match ($type) {
            HealthType::STUNTING_STATUS => $this->healthService->getStuntingStatus($rw, $rt),
            HealthType::NUTRITIONAL_STATUS => $this->healthService->getNutritionalStatus($rw, $rt),
            HealthType::PREGNANCY => $this->healthService->getPregnancyStatus($rw, $rt),
            HealthType::FAMILY_PLANNING => $this->healthService->getFamilyPlanning($rw, $rt),
            HealthType::BPJS_STATUS => $this->healthService->getBpjsStatus($rw, $rt),
            HealthType::BLOOD_TYPE => $this->healthService->getBloodType($rw, $rt),
            HealthType::DISABILITY => $this->healthService->getDisability($rw, $rt),
        };

        return $this->datasetRows('Kesehatan', $type->title(), $data['labels'] ?? $type->labels(), $data['datasets'] ?? []);
    }

    private function economic(?string $type, ?string $rw, ?string $rt): array
    {
        $type = EconomicType::tryFrom($type ?? EconomicType::OCCUPATION->value) ?? EconomicType::OCCUPATION;
        $data = match ($type) {
            EconomicType::OCCUPATION => $this->economicService->getOccupation($rw),
            EconomicType::JOB_SECTOR => $this->economicService->getJobSector($rw),
            EconomicType::EMPLOYMENT_STATUS => $this->economicService->getEmploymentStatus($rw),
            EconomicType::HOUSE_OWNERSHIP => $this->economicService->getHouseOwnership($rw),
            EconomicType::FLOOR_MATERIAL => $this->economicService->getFloorMaterial($rw),
            EconomicType::WALL_MATERIAL => $this->economicService->getWallMaterial($rw),
            EconomicType::ROOF_MATERIAL => $this->economicService->getRoofMaterial($rw),
            EconomicType::COOKING_FUEL => $this->economicService->getCookingFuel($rw),
            EconomicType::ELECTRICITY_SOURCE => $this->economicService->getElectricitySource($rw),
            EconomicType::ELECTRICITY_CAPACITY => $this->economicService->getElectricityCapacity($rw),
            EconomicType::ECONOMIC_STATUS => $this->economicService->getEconomicStatus($rw),
        };

        $labels = $type === EconomicType::OCCUPATION
            ? ($data['dynamic_labels'] ?? [])
            : $type->labels();

        return $this->genderRows('Ekonomi', $type->title(), $labels, $data);
    }

    private function msme(?string $type, ?string $rw, ?string $rt): array
    {
        $type = MsmeType::tryFrom($type ?? MsmeType::BUSINESS_SECTOR->value) ?? MsmeType::BUSINESS_SECTOR;
        $data = match ($type) {
            MsmeType::BUSINESS_SECTOR => $this->msmeService->getBusinessSector($rw, $rt),
            MsmeType::OWNER_AGE => $this->msmeService->getOwnerAge($rw, $rt),
            MsmeType::OWNER_EDUCATION => $this->msmeService->getOwnerEducation($rw, $rt),
            MsmeType::BUSINESS_LOCATION => $this->msmeService->getBusinessLocation($rw, $rt),
            MsmeType::LEGAL_STATUS => $this->msmeService->getLegalStatus($rw, $rt),
            MsmeType::NIB_OWNERSHIP => $this->msmeService->getNibOwnership($rw, $rt),
            MsmeType::MONTHLY_TURNOVER => $this->msmeService->getMonthlyTurnover($rw, $rt),
            MsmeType::DIGITAL_TRANSACTION => $this->msmeService->getDigitalTransaction($rw, $rt),
            MsmeType::DIGITAL_PLATFORM => $this->msmeService->getDigitalPlatform($rw, $rt),
            MsmeType::CAPITAL_SOURCE => $this->msmeService->getCapitalSource($rw, $rt),
            MsmeType::ECO_FRIENDLY => $this->msmeService->getEcoFriendly($rw, $rt),
            MsmeType::BUMDES_PARTNERSHIP => $this->msmeService->getBumdesPartnership($rw, $rt),
        };

        return $this->genderRows('UMKM', $type->title(), $type->labels(), $data);
    }

    private function infrastructure(?string $type): array
    {
        $type = InfrastructureType::tryFrom($type ?? InfrastructureType::FACILITY_TYPE->value) ?? InfrastructureType::FACILITY_TYPE;
        $data = $this->infrastructureService->getVillageAggregation($type->value, $type->options());
        $rows = collect($data['data'] ?? []);

        $labels = $type === InfrastructureType::CONSTRUCTION_YEAR
            ? $rows->pluck('category')->all()
            : array_values($type->options());

        $values = $rows->pluck('total')->all();

        return $this->datasetRows('Infrastruktur', $type->title(), $labels, $values);
    }

    private function demographTitle(DemographicsType $type): string
    {
        return match ($type) {
            DemographicsType::AGE_GROUP => 'Kelompok Umur',
            DemographicsType::GENDER => 'Jenis Kelamin',
            DemographicsType::MARITAL_STATUS => 'Status Perkawinan',
            DemographicsType::TERRITORY => 'Keberadaan Wilayah',
            DemographicsType::CITIZEN_STATUS => 'Status Penduduk',
            default => 'Demografi',
        };
    }

    private function genderRows(string $module, string $title, array $labels, array $data): array
    {
        $male = $data['male'] ?? [];
        $female = $data['female'] ?? [];
        $grandTotal = 0;
        $rows = [];

        foreach ($labels as $index => $label) {
            $maleCount = (int) ($male[$index] ?? 0);
            $femaleCount = (int) ($female[$index] ?? 0);
            $total = $maleCount + $femaleCount;
            $grandTotal += $total;
            $rows[] = ['category' => $label, 'male' => $maleCount, 'female' => $femaleCount, 'total' => $total];
        }

        foreach ($rows as &$row) {
            $row['percent'] = $grandTotal > 0 ? round(($row['total'] / $grandTotal) * 100, 1) : 0;
        }

        return [
            'module' => $module,
            'title' => $title,
            'rows' => $rows,
            'total' => $grandTotal,
        ];
    }

    private function datasetRows(string $module, string $title, array $labels, array $datasets): array
    {
        $grandTotal = 0;
        $rows = [];

        foreach ($labels as $index => $label) {
            $value = (int) ($datasets[$index] ?? 0);
            $grandTotal += $value;
            $rows[] = ['category' => $label, 'male' => null, 'female' => null, 'total' => $value];
        }

        foreach ($rows as &$row) {
            $row['percent'] = $grandTotal > 0 ? round(($row['total'] / $grandTotal) * 100, 1) : 0;
        }

        return [
            'module' => $module,
            'title' => $title,
            'rows' => $rows,
            'total' => $grandTotal,
        ];
    }
}
