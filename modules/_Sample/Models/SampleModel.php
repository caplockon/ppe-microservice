<?php
declare(strict_types=1);

namespace Modules\_Sample\Models;

use Modules\_Sample\Models\Relations\SampleModelRelations;
use Modules\Core\Models\Model;

class SampleModel extends Model
{
    use SampleModelRelations;
}
