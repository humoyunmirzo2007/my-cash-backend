<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\StoreOutputType;
use App\Http\Requests\UpdateOutputType;
use App\Http\Requests\UpdateOutputTypeActive;
use App\Http\Resources\OutputTypeResource;
use App\Services\OutputTypeService;
use Illuminate\Http\Request;

class OutputTypeController
{
    protected $outputTypeService;

    public function __construct(OutputTypeService $service)
    {
        $this->outputTypeService = $service;
    }

    public function getAll(Request $request)
    {
        $collection = OutputTypeResource::collection(
            $this->outputTypeService->getAll($request)
        );
        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection)
        );
    }
    public function getAllActives(Request $request)
    {
        $collection = OutputTypeResource::collection(
            $this->outputTypeService->getAllActives($request)
        );
        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection)
        );
    }
    public function getById(int $id)
    {
        $outputType = $this->outputTypeService->getById($id);

        if (!$outputType) {
            return Response::error(t("not_found"), status: 404);
        }

        return Response::success(data: $outputType);
    }
    public function create(StoreOutputType $request)
    {

        $outputType = $this->outputTypeService->create($request->validated());

        return Response::success(
            message: t("created_success", "messages", ["output_type"]),
            data: $outputType,
            status: 201
        );
    }
    public function update(int $id, UpdateOutputType $request)
    {
        $outputType = $this->outputTypeService->update($id, $request->validated());

        return Response::success(
            message: t("updated_success", "messages", ["output_type"]),
            data: $outputType,
        );
    }
    public function updateActive(int $id, UpdateOutputTypeActive $req)
    {

        $outputType = $this->outputTypeService->updateActive($id);

        return Response::success(t("active_updated_success", "messages", ["output_type"]), $outputType);
    }
}
