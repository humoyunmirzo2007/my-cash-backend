<?php

namespace App\Services;

use App\Repositories\OutputTypeRepository;
use Illuminate\Http\Request;

class OutputTypeService
{
    protected $outputTypeRepository;

    public function __construct(OutputTypeRepository $repository)
    {
        $this->outputTypeRepository = $repository;
    }

    public function getAll(Request $request)
    {
        return $this->outputTypeRepository->getAll($request);
    }
    public function getAllActives(Request $request)
    {
        return $this->outputTypeRepository->getAllActives($request);
    }
    public function getById(int $id)
    {
        return $this->outputTypeRepository->getById($id);
    }
    public function create(array $data)
    {
        return $this->outputTypeRepository->create($data);
    }
    public function update(int $id, array $data)
    {
        return $this->outputTypeRepository->update($id, $data);
    }
    public function updateActive(int $id)
    {
        return $this->outputTypeRepository->updateActive($id);
    }
}
