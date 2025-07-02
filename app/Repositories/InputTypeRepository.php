<?php

namespace App\Repositories;

use App\Interfaces\InputTypeRepositoryInterface;
use App\Models\InputType;
use Illuminate\Http\Request;

class InputTypeRepository implements InputTypeRepositoryInterface
{
    public function getAll(Request $request)
    {
        return InputType::query()
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
        return InputType::find($id);
    }
    public function create(array $data)
    {
        return InputType::create([
            "name" => $data["name"]
        ]);
    }
    public function update(int $id, array $data)
    {
        $inputType = InputType::find($id);
        $inputType->update([
            "name" => $data["name"]
        ]);
        $inputType->save();

        return $inputType;
    }
    public function updateActive(int $id)
    {
        $inputType = InputType::find($id);
        $inputType->active = !$inputType->active;
        $inputType->save();

        return $inputType;
    }
}
