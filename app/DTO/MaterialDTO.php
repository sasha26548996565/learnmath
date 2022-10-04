<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class MaterialDTO extends DataTransferObject
{
    public string $name;
    public string $description;
    public string $content;
    public $preview;
    public int $category_id;
}
