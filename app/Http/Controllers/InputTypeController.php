<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\StoreInputTypeRequest;
use App\Http\Requests\UpdateInputTypeActiveRequest;
use App\Http\Requests\UpdateInputTypeRequest;
use App\Http\Resources\InputTypeResource;
use App\Services\InputTypeService;
use Illuminate\Http\Request;

class InputTypeController
{
    protected $inputTypeService;

    public function __construct(InputTypeService $service)
    {
        $this->inputTypeService = $service;
    }

    public function getAll(Request $request)
    {
        $collection = InputTypeResource::collection(
            $this->inputTypeService->getAll($request)
        );
        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection)
        );
    }
    public function getAllActives(Request $request)
    {
        $collection = InputTypeResource::collection(
            $this->inputTypeService->getAllActives($request)
        );
        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection)
        );
    }
    public function getById(int $id)
    {
        $inputType = $this->inputTypeService->getById($id);

        if (!$inputType) {
            return Response::error(t("not_found", "messages", ["input_type"]), status: 404);
        }

        return Response::success(data: $inputType);
    }
    public function create(StoreInputTypeRequest $request)
    {

        $inputType = $this->inputTypeService->create($request->validated());

        return Response::success(
            message: t("created_success", "messages", ["input_type"]),
            data: $inputType,
            status: 201
        );
    }
    public function update(int $id, UpdateInputTypeRequest $request)
    {
        $inputType = $this->inputTypeService->update($id, $request->validated());

        return Response::success(
            message: t("updated_success", "messages", ["input_type"]),
            data: $inputType,
        );
    }
    public function updateActive(int $id, UpdateInputTypeActiveRequest $request)
    {
        $inputType = $this->inputTypeService->updateActive($id);

        return Response::success(t("active_updated_success", "messages", ["input_type"]), $inputType);
    }
}
