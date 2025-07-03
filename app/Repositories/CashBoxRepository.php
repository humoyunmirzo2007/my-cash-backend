<?php

namespace App\Repositories;

use App\Interfaces\CashBoxRepositoryInterface;
use App\Models\CashBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBoxRepository implements CashBoxRepositoryInterface
{
    public function getAll(Request $request)
    {
        return CashBox::query()
            ->where("user_id", Auth::id())
            ->when($request->search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query
                        ->where("currency", "ILIKE", "%{$search}%")
                        ->orWhere("residue", "ILIKE", "%{$search}%");
                });
            })
            ->orderBy(
                $request->input("sort_by", "id"),
                $request->input("order_by", "desc")
            )
            ->paginate($request->input("per_page", 15));
    }

    public function getById(int $id)
    {
        return CashBox::where("id", $id)
            ->where("user_id", Auth::id())
            ->first();
    }

    public function create(array $data)
    {
        return CashBox::create([
            "user_id" => Auth::id(),
            "currency" => $data["currency"]
        ]);
    }
}
