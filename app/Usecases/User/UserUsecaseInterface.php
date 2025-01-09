<?php

namespace App\Usecases\User;

interface UserUsecaseInterface
{
    public function updateUserByParams($id, array $dataUpdate);

    public function getUserInfo(mixed $userID);
}
