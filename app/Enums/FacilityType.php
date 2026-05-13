<?php

namespace App\Enums;

enum FacilityType: string {
    case ROAD = 'road';
    case BRIDGE = 'bridge';
    case IRRIGATION = 'irrigation';
    case EDUCATION = 'education';
    case HEALTH = 'health';
    case WORSHIP = 'worship';
    case GOVERMENT = 'goverment';
}
