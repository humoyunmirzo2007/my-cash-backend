<?php

namespace App\Services;

use App\Models\InputType;
use App\Repositories\InputTypeRepository;
use Illuminate\Http\Request;

class InputTypeService
{
    protected $inputTypeRepository;

    public function __construct(InputTypeRepository $repository)
    {
        $this->inputTypeRepository = $repository;
    }

    public function getAll(Request $request)
    {
        return $this->inputTypeRepository->getAll($request);
    }
    public function getAllActives(Request $request)
    {
        return $this->inputTypeRepository->getAllActives($request);
    }
    public function getById(int $id)
    {
        return $this->inputTypeRepository->getById($id);
    }
    public function create(array $data)
    {
        return $this->inputTypeRepository->create($data);
    }
    public function update(int $id, array $data)
    {
        return $this->inputTypeRepository->update($id, $data);
    }
    public function updateActive(int $id)
    {
        return $this->inputTypeRepository->updateActive($id);
    }
}
