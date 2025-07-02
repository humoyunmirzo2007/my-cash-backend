<?php

namespace App\Services;

use App\Repositories\CashBoxRepository;
use Illuminate\Http\Request;

class CashBoxService
{
    protected $cashBoxRepository;

    public function __construct(CashBoxRepository $repository)
    {
        $this->cashBoxRepository = $repository;
    }

    public function getAll(Request $request)
    {
        return $this->cashBoxRepository->getAll($request);
    }
    public function getById(int $id)
    {
        return $this->cashBoxRepository->getById($id);
    }
    public function create(array $data)
    {
        return $this->cashBoxRepository->create($data);
    }
}
