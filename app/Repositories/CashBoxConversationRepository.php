<?php

namespace App\Repositories;

use App\Interfaces\CashBoxConversionRepositoryInterface;
use App\Models\CashBoxConversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBoxConversionRepository implements CashBoxConversionRepositoryInterface
{
    public function getAll(Request $request)
    {
        return CashBoxConversion::with(['fromCashBox', 'toCashBox'])
            ->where('user_id', Auth::id())
            ->latest()
            ->when($request->filled('from_date'), fn($q) => $q->whereDate('created_at', '>=', $request->from_date))
            ->when($request->filled('to_date'), fn($q) => $q->whereDate('created_at', '<=', $request->to_date))
            ->when($request->filled('from_cash_box_id'), fn($q) => $q->where('from_cash_box_id', $request->from_cash_box_id))
            ->when($request->filled('to_cash_box_id'), fn($q) => $q->where('to_cash_box_id', $request->to_cash_box_id))
            ->when($request->filled('currency'), function ($q) use ($request) {
                $q->whereHas('toCashBox', fn($q2) => $q2->where('currency', $request->currency));
            })
            ->paginate(15);
    }

    public function create(array $data)
    {
        return CashBoxConversion::create($data);
    }
}
