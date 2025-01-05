<?php

namespace App\Repositories\Friend;

use App\Repositories\RepositoryInterface;

interface FriendRepositoryInterface extends RepositoryInterface
{
    public function getByUserID(mixed $userID);
}
