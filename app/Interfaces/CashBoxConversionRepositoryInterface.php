<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CashBoxConversionRepositoryInterface
{
    public function getAll(Request $request);
    public function create(array $data);
}
