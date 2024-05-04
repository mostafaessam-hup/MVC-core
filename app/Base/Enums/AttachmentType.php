<?php

namespace App\Base\Enums;

use App\Base\Traits\Custom\EnumCustom;

enum AttachmentType: string
{
    use EnumCustom;
    case IMAGE = 'image';
    case VIDEO = 'video';
    case DOC = 'doc';
}
