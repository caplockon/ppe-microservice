<?php
declare(strict_types=1);

namespace Modules\Core\Serializer;

enum Format: string
{
    case JSON = 'json';
    case XML = 'xml';
    case CSV = 'csv';
    case YAML = 'yaml';
}
