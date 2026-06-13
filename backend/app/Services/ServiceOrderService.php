<?php

namespace App\Services;

use App\Models\ServiceOrder;

class ServiceOrderService
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ServiceOrder($db);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
