<?php

namespace App\Usecases\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Usecases\BaseUsecase;

class UserUsecase extends BaseUsecase implements UserUsecaseInterface
{
    protected UserRepositoryInterface $userRepo;
    public function __construct(
        UserRepositoryInterface $userRepo
    )
    {
        $this->userRepo = $userRepo;
    }

    public function updateUserByParams($id, array $dataUpdate)
    {
        $update = [];
        if (isset($dataUpdate[User::_FULLNAME])){
            $update[User::_FULLNAME] = $dataUpdate[User::_FULLNAME];
        }
        if (isset($dataUpdate[User::_EMAIL])){
            $update[User::_EMAIL] = $dataUpdate[User::_EMAIL];
        }
        if (isset($dataUpdate[User::_DOB])){
            $update[User::_DOB] = $dataUpdate[User::_DOB];
        }
        if (isset($dataUpdate[User::_PHONE])){
            $update[User::_PHONE] = $dataUpdate[User::_PHONE];
        }
        if (isset($dataUpdate[User::_GENDER])){
            $update[User::_GENDER] = $dataUpdate[User::_GENDER];
        }
        if (isset($dataUpdate[User::_ADDRESS])){
            $update[User::_ADDRESS] = $dataUpdate[User::_ADDRESS];
        }
        if (isset($dataUpdate[User::_EDUCATION_INFO])){
            $update[User::_EDUCATION_INFO] = $dataUpdate[User::_EDUCATION_INFO];
        }
        if (isset($dataUpdate[User::_WORK_INFO])){
            $update[User::_WORK_INFO] = $dataUpdate[User::_WORK_INFO];
        }
        if (isset($dataUpdate[User::_PASSWORD])){
            $newPassword = password_hash($dataUpdate[User::_PASSWORD], PASSWORD_DEFAULT);
            $update[User::_PASSWORD] = $newPassword;
        }
        $update[User::_UPDATED_AT] = date('Y-m-d H:i:s');
        return $this->userRepo->update($id, $update);
    }
}
