<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface;

abstract class AbstractService
{
    /** @var RepositoryInterface */
    protected $repository;

    /**
     * @param RepositoryInterface $repository
     */
    // public function __construct(RepositoryInterface $repository)
    // {
    //     $this->repository = $repository;
    // }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param string $method
     * @param array  $arguments
     */
    public function __call($method, array $arguments = [])
    {
        if ( ! method_exists($this->repository, $method)) {
            call_user_func_array([$this->repository, $method], $arguments);
        }
    }
}
