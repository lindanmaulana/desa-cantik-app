<?php

namespace App\Enums;

enum ConditionInfrastructure: string {
    case GOOD = 'good';
    case DAMAGED_LIGHT = 'damaged_light';
    case DAMAGED_SEVERE = 'damaged_severe';
}
