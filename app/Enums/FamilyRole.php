<?php

namespace App\Enums;


enum FamilyRole: string
{
    case HEAD_OF_FAMILY = 'head_of_family';
    case SPOUSE = 'spouse';
    case CHILD = 'child';
    case PARENT = 'parent';
    case OTHER_RELATIVE = 'other_relative';
}
