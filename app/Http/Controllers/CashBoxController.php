<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\StoreCashBoxRequest;
use App\Http\Requests\UpdateCashBoxRequest;
use App\Http\Resources\CashBoxResource;
use App\Services\CashBoxService;
use Illuminate\Http\Request;

class CashBoxController
{
    protected $cashBoxService;

    public function __construct(CashBoxService $service)
    {
        $this->cashBoxService = $service;
    }

    public function getAll(Request $request)
    {
        $collection = CashBoxResource::collection(
            $this->cashBoxService->getAll($request)
        );

        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection),
        );
    }
    public function getById(int $id)
    {
        $cashBox = $this->cashBoxService->getById($id);

        if (!$cashBox) {
            return Response::error(t("not_found", "messages", ["cash_box"]), status: 404);
        }

        return Response::success(data: $cashBox);
    }
    public function create(StoreCashBoxRequest $request)
    {
        $cashBox = $this->cashBoxService->create($request->validated());

        return Response::success(
            message: t("created_success", "messages", ["cash_box"]),
            data: $cashBox,
            status: 201
        );
    }
}
