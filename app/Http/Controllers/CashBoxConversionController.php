<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\StoreCashBoxConversionRequest;
use App\Http\Resources\CashBoxResource;
use App\Services\CashBoxConversionService;
use Illuminate\Http\Request;

class CashBoxConversionController
{
    protected $cashBoxConversionService;

    public function __construct(CashBoxConversionService $service)
    {
        $this->cashBoxConversionService = $service;
    }

    public function getAll(Request $request)
    {
        $collection = CashBoxResource::collection(
            $this->cashBoxConversionService->getAll($request)
        );
        return Response::success(
            data: $collection->items(),
            extra: getPagination($collection),
        );
    }

    public function create(StoreCashBoxConversionRequest $request)
    {
        $cashBoxConversion = $this->cashBoxConversionService->create($request->validated());

        return Response::success(
            message: t("created_success", "messages", ["cash_box_operation"]),
            data: $cashBoxConversion,
            status: 201
        );
    }
}
