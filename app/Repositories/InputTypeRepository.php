<?php

namespace App\Repositories;

use App\Interfaces\InputTypeRepositoryInterface;
use App\Models\InputType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputTypeRepository implements InputTypeRepositoryInterface
{
    public function getAll(Request $request)
    {
        return InputType::query()
            ->where("user_id", Auth::user()->id)
            ->when(
                $request->search,
                fn($q, $search) =>
                $q->where('name', 'ILIKE', "%{$search}%")
            )
            ->orderBy(
                $request->input('sort_by', 'id'),
                $request->input('order_by', 'desc')
            )
            ->paginate($request->input('per_page', 15));
    }
    public function getAllActives(Request $request)
    {
        return InputType::query()
            ->where("user_id", Auth::user()->id)
            ->where("active", true)
            ->when(
                $request->search,
                fn($q, $search) =>
                $q->where('name', 'ILIKE', "%{$search}%")
            )
            ->orderBy(
                $request->input('sort_by', 'id'),
                $request->input('order_by', 'desc')
            )
            ->paginate($request->input('per_page', 15));
    }
    public function getById(int $id)
    {
        return InputType::where("id", $id)
            ->where("user_id", Auth::id())
            ->first();
    }
    public function create(array $data)
    {
        return InputType::create([
            "name" => $data["name"],
            "user_id" => Auth::user()->id
        ]);
    }
    public function update(int $id, array $data)
    {
        $inputType = InputType::where("id", $id)
            ->where("user_id", Auth::id())
            ->first();
        $inputType->update([
            "name" => $data["name"]
        ]);
        $inputType->save();

        return $inputType;
    }
    public function updateActive(int $id)
    {
        $inputType = InputType::where("id", $id)
            ->where("user_id", Auth::id())
            ->first();
        $inputType->active = !$inputType->active;
        $inputType->save();

        return $inputType;
    }
}
