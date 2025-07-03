<?php

namespace App\Services;

use App\Repositories\CashBoxOperationRepository;
use Illuminate\Http\Request;

class CashBoxOperationService
{
    protected $cashBoxOperationRepository;

    public function __construct(CashBoxOperationRepository $repository)
    {
        $this->cashBoxOperationRepository = $repository;
    }

    public function getOperations(Request $request, $type)
    {
        return $this->cashBoxOperationRepository->getOperations($request, $type);
    }

    public function getById(int $id, $type)
    {
        return $this->cashBoxOperationRepository->getOperationById($id, $type);
    }
    public function create(array $data)
    {
        return $this->cashBoxOperationRepository->create($data);
    }
    public function update(int $id, array $data)
    {
        return $this->cashBoxOperationRepository->update($id, $data);
    }
    public function delete(int $id)
    {
        return $this->cashBoxOperationRepository->delete($id);
    }
}
