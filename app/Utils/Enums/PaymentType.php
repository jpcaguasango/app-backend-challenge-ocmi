<?php

namespace App\Utils\Enums;

enum PaymentTypeEnum: string
{
    case PerHour = 'perHour';
    case Salary = 'salary';
}
