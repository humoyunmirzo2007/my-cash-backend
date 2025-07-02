<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CashBoxRepositoryInterface
{
    public function getAll(Request $request);
    public function getById(int $id);
    public function create(array $data);
}
