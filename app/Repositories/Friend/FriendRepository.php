<?php

namespace App\Repositories\Friend;

use App\Models\Friend;
use App\Repositories\BaseRepository;

class FriendRepository extends BaseRepository implements FriendRepositoryInterface
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Friend::class;
    }

    public function getByUserID(mixed $userID)
    {
        return $this->_model->where(Friend::_USER_ID,$userID)->whereNull(Friend::_DELETED_AT)->get();
    }
}
