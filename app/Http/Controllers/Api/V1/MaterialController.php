<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Material;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MaterialResource;
use App\Http\Requests\Api\MaterialRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MaterialController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return MaterialResource::collection(Material::latest()->get());
    }

    public function show(Material $material): MaterialResource
    {
        return new MaterialResource($material);
    }

    public function store(MaterialRequest $request): MaterialResource
    {
        return new MaterialResource(Material::create($request->validated()));
    }

    public function update(Material $material, MaterialRequest $request):  MaterialResource
    {
        $material->update($request->validated());
        return new MaterialResource($material);
    }

    public function destroy(Material $material): Response
    {
        $material->delete();
        return response(Response::HTTP_NO_CONTENT);
    }
}
