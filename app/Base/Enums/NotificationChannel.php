<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum NotificationChannel: string
{
    use EnumCustom;
    case FIREBASE = 'firebase';
    case WHATSAPP = 'whatsapp';
}
