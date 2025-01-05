<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function getModel()
    {
        // TODO: Implement getModel() method.
        return User::class;
    }

    public function getListByParams()
    {
        // TODO: Implement getListByParams() method.
        return $this->_model->get();
    }

    public function findByParam(array $param, $method = "get", $select = ["*"])
    {
        // TODO: Implement findByParam() method.
        $query = $this->_model->select($select);
        $query = $this->getQueryByParam($query, $param);
        if (isset($param['page'])) {
            $limit  = $param['per_page'];
            $offset = ($param['page'] - 1) * $limit;
            $query->limit($limit)
                ->offset($offset);
        }
        if ($method == 'get') {
            return $query->get();
        }
        return $query->first();
    }

    private function getQueryByParam($query, array $param)
    {
        if (isset($param[User::_PHONE])) {
            $query = $query->where([User::_PHONE => $param[User::_PHONE]]);
        }
        if (isset($param[User::_EMAIL])) {
            $query = $query->where([User::_EMAIL => $param[User::_EMAIL]]);
        }
        return $query;
    }

    public function findByPhoneOrEmail($phone, $email)
    {
        return $this->_model->whereNull(User::_DELETED_AT)
            ->where(function ($query) use ($phone, $email) {
                $query->where(User::_PHONE, $phone)
                    ->orWhere(User::_EMAIL, $email);
            })->first();
    }

    public function findByEmail($email)
    {
        return $this->_model->whereNull(User::_DELETED_AT)->where(User::_EMAIL, $email)->first();
    }
    public function firstByID($userID)
    {
        return $this->_model->where(User::_ID, $userID)->whereNull(User::_DELETED_AT)->first();
    }

    public function getByID(mixed $userID, $select=["*"])
    {
        return $this->_model->select($select)->where(User::_ID, $userID)->whereNull(User::_DELETED_AT)->first();
    }

    public function getUserInfoByUserIDs($friendIDs, array $select=["*"])
    {
        return $this->_model->whereIn(User::_ID, $friendIDs)->select($select)->whereNull(User::_DELETED_AT)->get();
    }
}
