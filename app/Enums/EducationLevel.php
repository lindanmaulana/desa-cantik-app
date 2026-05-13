<?php

namespace App\Enums;

enum EducationLevel: string {
    case NONE = 'none';
    case ELEMENTORY_SCHOOL = 'elementory_school';
    case MIDDLE_SCHOOL = 'middle_school';
    case HIGH_SCHOOL = 'high_school';
    case ASSOCIATE_DEGREE = 'associate_degree';
    case BACHELOR_DEGREE = 'bachelor_degree';
    case POSTGRADUATE = 'postgraduate';
}
