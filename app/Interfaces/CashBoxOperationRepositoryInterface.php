<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CashBoxOperationRepositoryInterface
{
    public function getOperations(Request $request, string $type);
    public function getOperationById(int $id, string $type);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
