<?php

namespace App\Utils\Enums;

enum StateEnum: string
{
    case Pending = 'pending';
    case Rejected = 'rejected';
    case Success = 'success';
}
