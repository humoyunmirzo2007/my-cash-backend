<?php

namespace App\Repositories;

use App\Interfaces\CashBoxOperationRepositoryInterface;
use App\Models\CashBoxOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CashBoxOperationRepository implements CashBoxOperationRepositoryInterface
{
    public function getOperations(Request $request, string $type)
    {
        $operationType = $type === "INPUT" ? "inputType" : "outputType";
        $operationTypeIdColumn = $type === "INPUT" ? "input_type_id" : "output_type_id";

        return CashBoxOperation::with($operationType)
            ->where("user_id", Auth::id())
            ->whereNotNull($operationTypeIdColumn)
            ->when($request->search, function ($q) use ($request, $operationType) {
                $search = $request->search;

                $q->where(function ($query) use ($search, $operationType) {
                    $query
                        ->where("currency", "ILIKE", "%{$search}%")
                        ->orWhereRaw("CAST(amount AS TEXT) ILIKE ?", ["%{$search}%"])
                        ->orWhereHas($operationType, function ($q2) use ($search) {
                            $q2->where("name", "ILIKE", "%{$search}%");
                        });
                });
            })
            ->orderBy(
                $request->input("sort_by", "id"),
                $request->input("order_by", "desc")
            )
            ->paginate($request->input("per_page", 15));
    }

    public function getOperationById(int $id, string $type)
    {
        $operationType = $type === "INPUT" ? "inputType" : "outputType";
        $operationTypeIdColumn = $type === "INPUT" ? "input_type_id" : "output_type_id";

        $operation = CashBoxOperation::with([
            $operationType => function ($query) {
                $query->select('id', 'name');
            }
        ])
            ->where("user_id", Auth::id())
            ->where("id", $id)
            ->whereNotNull($operationTypeIdColumn)
            ->firstOrFail();

        return $operation;
    }

    public function create(array $data)
    {
        if (!empty($data["output_type_id"]) && $data["amount"] > 0) {
            $data["amount"] = -1 * abs($data["amount"]);
        }

        if (!empty($data["input_type_id"]) && $data["amount"] < 0) {
            $data["amount"] = abs($data["amount"]);
        }

        return CashBoxOperation::create([
            "user_id" => Auth::id(),
            "input_type_id" => $data["input_type_id"] ?? null,
            "output_type_id" => $data["output_type_id"] ?? null,
            "currency" => $data["currency"],
            "amount" => $data["amount"],
            "comment" => $data["comment"] ?? null,
        ]);
    }

    public function update(int $id, array $data)
    {
        $cashBoxOperation =  CashBoxOperation::query()
            ->where("user_id", Auth::id())
            ->where("id", $id)
            ->first();

        if (!$cashBoxOperation) {
            throw new ModelNotFoundException();
        }

        if (!empty($data["output_type_id"])) {
            $data["amount"] = -abs($data["amount"]);
        } elseif (!empty($data["input_type_id"])) {
            $data["amount"] = abs($data["amount"]);
        }

        $cashBoxOperation->update([
            "user_id" => Auth::id(),
            "input_type_id" => $data["input_type_id"] ?? null,
            "output_type_id" => $data["output_type_id"] ?? null,
            "currency" => $data["currency"],
            "amount" => $data["amount"],
            "comment" => $data["comment"] ?? null,
        ]);

        return $cashBoxOperation;
    }


    public function delete(int $id)
    {
        $cashBoxOperation =  CashBoxOperation::query()
            ->where("user_id", Auth::id())
            ->where("id", $id)
            ->first();

        if (!$cashBoxOperation) {
            throw new ModelNotFoundException();
        }

        $cashBoxOperation->delete();
    }
}
