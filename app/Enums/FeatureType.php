<?php

namespace App\Enums;

enum FeatureType: string {
    case RESIDENT_HOUSE = 'resident_house';
    case PUBLIC_FACILITY = 'public_facility';
    case VILLAGE_BOUNDARY = 'village_boundary';
    case MSME_LOCATION = 'msme_location';
}
