<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\MaterialDTO;
use App\Events\MaterialCreated;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;

class MaterialService
{
    public function store(MaterialDTO $params): Material
    {
        if (isset($params->preview))
            $params->preview = Storage::disk('public')->put('/materials', $params->preview);

        $material = Material::create($params->toArray());
        event(new MaterialCreated($material));

        return $material;
    }

    public function update(MaterialDTO $params, Material $material): void
    {
        if (isset($params->preview))
        {
            if (isset($material->preview))
                Storage::delete($params->preview);

            $params->preview = Storage::disk('public')->put('/materials', $params->preview);
        }

        $material->update($params->toArray());
    }
}
