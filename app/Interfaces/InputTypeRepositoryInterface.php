<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface InputTypeRepositoryInterface
{
    public function getAll(Request $request);
    public function getAllActives(Request $request);
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function updateActive(int $id);
}
