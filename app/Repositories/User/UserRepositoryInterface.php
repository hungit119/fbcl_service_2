<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{

    public function getListByParams();

    public function findByParam(array $param,string $method, array $select);

    public function findByPhoneOrEmail(mixed $phone, mixed $email);

    public function findByEmail(mixed $email);
}
