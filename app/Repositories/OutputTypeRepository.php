<?php

namespace App\Repositories;

use App\Interfaces\OutputTypeRepositoryInterface;
use App\Models\OutputType;
use Illuminate\Http\Request;

class OutputTypeRepository implements OutputTypeRepositoryInterface
{
    public function getAll(Request $request)
    {
        return OutputType::query()
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
        return OutputType::query()
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
        return OutputType::find($id);
    }
    public function create(array $data)
    {
        return OutputType::create([
            "name" => $data["name"]
        ]);
    }
    public function update(int $id, array $data)
    {
        $outputType = OutputType::find($id);
        $outputType->update([
            "name" => $data["name"]
        ]);
        $outputType->save();

        return $outputType;
    }
    public function updateActive(int $id)
    {
        $outputType = OutputType::find($id);
        $outputType->active = !$outputType->active;
        $outputType->save();

        return $outputType;
    }
}
