<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\StoreCashBoxOperationRequest;
use App\Http\Requests\UpdateCashBoxOperationRequest;
use App\Http\Resources\CashBoxResource;
use App\Services\CashBoxOperationService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CashBoxOperationController
{
    protected $cashBoxOperationService;

    public function __construct(CashBoxOperationService $service)
    {
        $this->cashBoxOperationService = $service;
    }

    public function getIncomes(Request $request)
    {
        $collection = CashBoxResource::collection(
            $this->cashBoxOperationService->getOperations($request, "INPUT")
        );

        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection),
        );
    }

    public function getOutputs(Request $request)
    {
        $collection = CashBoxResource::collection(
            $this->cashBoxOperationService->getOperations($request, "OUTPUT")
        );

        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection),
        );
    }

    public function getIncomeById(int $id)
    {
        try {

            $cashBox = $this->cashBoxOperationService->getById($id, "INPUT");

            if (!$cashBox) {
                return Response::error(t("not_found", "messages", ["cash_box"]), status: 404);
            }

            return Response::success(data: $cashBox);
        } catch (ModelNotFoundException) {
            return Response::error(t("not_found", "messages", ["input_operation"]), status: 404);
        }
    }

    public function getOutputById(int $id)
    {
        try {

            $cashBox = $this->cashBoxOperationService->getById($id, "OUTPUT");

            if (!$cashBox) {
                return Response::error(t("not_found", "messages", ["cash_box"]), status: 404);
            }

            return Response::success(data: $cashBox);
        } catch (ModelNotFoundException) {
            return Response::error(t("not_found", "messages", ["output_operation"]), status: 404);
        }
    }

    public function create(StoreCashBoxOperationRequest $request)
    {
        $cashBox = $this->cashBoxOperationService->create($request->validated());

        return Response::success(
            message: t("created_success", "messages", ["cash_box_operation"]),
            data: $cashBox,
            status: 201
        );
    }

    public function update(int $id, UpdateCashBoxOperationRequest $request)
    {
        try {
            $cashBox = $this->cashBoxOperationService->update($id, $request->validated());

            return Response::success(
                message: t("updated_success", "messages", ["cash_box_operation"]),
                data: $cashBox,
            );
        } catch (ModelNotFoundException) {
            return Response::error(t("not_found", "messages", ["cash_box_operation"]), status: 404);
        }
    }

    public function delete(int $id)
    {
        try {

            $this->cashBoxOperationService->delete($id);

            return Response::success(
                message: t("deleted_success", "messages", ["cash_box_operation"]),
            );
        } catch (ModelNotFoundException) {
            return Response::error(t("not_found", "messages", ["cash_box_operation"]), status: 404);
        }
    }
}
