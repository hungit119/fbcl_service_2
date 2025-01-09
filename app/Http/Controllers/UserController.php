<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordEmail;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Email\MailServiceInterface;
use App\Services\Jwt\JwtServiceInterface;
use App\Usecases\User\UserUsecaseInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected Request                 $request;
    protected JwtServiceInterface     $jwtService;
    protected MailServiceInterface    $mailService;
    protected UserUsecaseInterface    $userUsecase;
    protected UserRepositoryInterface $userRepo;

    public function __construct(
        Request $request,
        JwtServiceInterface $jwtService,
        MailServiceInterface $mailService,
        UserUsecaseInterface $userUsecase,
        UserRepositoryInterface $userRepo,
    ) {
        $this->request     = $request;
        $this->jwtService  = $jwtService;
        $this->mailService = $mailService;
        $this->userUsecase = $userUsecase;
        $this->userRepo    = $userRepo;
    }

    public function register()
    {
        $validated = $this->validateBase($this->request, [
            'firstname'     => 'required',
            'surname'       => 'required',
            'date_of_birth' => 'required',
            'gender'        => 'required',
            'phone'         => 'required_without:email',
            'email'         => 'required_without:phone|email',
            'password'      => 'required',
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $firstname   = $this->request->get('firstname');
        $surname     = $this->request->get('surname');
        $dateOfBirth = $this->request->get('date_of_birth');
        $gender      = $this->request->get('gender');
        $phone       = $this->request->get('phone');
        $email       = $this->request->get('email');
        $password    = $this->request->get('password');

        $data = [];
        // check phone or email
        $exited = $this->userRepo->findByPhoneOrEmail($phone, $email);
        if ($exited) {
            $this->message = "user already exists";
            $this->code    = 400;
            return $this->responseData($data);
        }

        $newUser = [
            User::_PHONE      => $phone,
            User::_EMAIL      => $email,
            User::_DOB        => $dateOfBirth,
            User::_FULLNAME   => $firstname . " " . $surname,
            User::_GENDER     => $gender,
            User::_CREATED_AT => date('Y-m-d H:i:s'),
            User::_UPDATED_AT => date('Y-m-d H:i:s'),
        ];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $newUser[User::_PASSWORD] = $hashedPassword;

        $userCreated = $this->userRepo->create($newUser);
        $token       = $this->jwtService->createJwtToken($userCreated);

        $data          = [
            'user'         => $userCreated,
            'access_token' => $token
        ];
        $this->status  = "success";
        $this->message = "user registered successfully";
        return $this->responseData($data);
    }

    public function login()
    {
        $validated = $this->validateBase($this->request, [
            'email'    => 'required_without:phone|email',
            'phone'    => 'required_without:email',
            'password' => 'required',
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $email    = $this->request->get('email');
        $phone    = $this->request->get('phone');
        $password = $this->request->get('password');

        $data = [];
        $user = $this->userRepo->findByPhoneOrEmail($phone, $email);
        if (!$user) {
            $this->message = "user not found";
            $this->code    = 404;
            goto next;
        }
        $checkPassword = password_verify($password, $user->password);
        if (!$checkPassword) {
            $this->message = "wrong password";
            $this->code    = 400;
            goto next;
        }
        $token = $this->jwtService->createJwtToken($user);
        $data  = [
            'user'         => $user,
            'access_token' => $token
        ];

        $this->status  = "success";
        $this->message = "user logged in successfully";
        next:
        return $this->responseData($data);
    }

    public function forgotPassword()
    {
        $validated = $this->validateBase($this->request, [
            'email' => 'required|email',
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $email = $this->request->get('email');

        $data = [];
        $user = $this->userRepo->findByEmail($email);
        if (!$user) {
            $this->message = "user not found";
            $this->code    = 404;
            goto next;
        }

        $data = [
            'code'     => rand(100000, 999999),
            'fullname' => $user[User::_FULLNAME],
        ];
        try {
            $this->mailService->sendMail($user[User::_EMAIL], new ForgotPasswordEmail($data['code']));
        } catch (\Exception $exception) {
            $this->message = $exception->getMessage();
            $this->code    = 500;
            goto next;
        }

        $this->status  = "success";
        $this->message = "user forgotten password successfully";
        next:
        return $this->responseData($data);
    }

    public function submitForgotPassword()
    {
        $validated = $this->validateBase($this->request, [
            'token' => 'required'
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $data       = [];
        $token      = $this->request->get('token');
        $dataDecode = $this->jwtService->verifyJwtToken($token);
        $userID     = ((array)$dataDecode['user'])['user_id'];
        if (!isset($userID)) {
            $this->message = "user id not found";
            $this->code    = 404;
            goto next;
        }
        $user = $this->userRepo->firstByID($userID);
        if (!$user) {
            $this->message = "user not found";
            $this->code    = 404;
            goto next;
        }
        $this->status  = 'success';
        $this->message = "user submitted successfully";
        $data          = $userID;
        next:
        return \view('change-password')->with(['user_id' => $data]);
    }

    public function updateUserByParams()
    {
        $validated = $this->validateBase($this->request, [
            'user_id'     => 'required',
            'data_update' => 'required|array'
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $data       = [];
        $userID     = $this->request->get('user_id');
        $dataUpdate = $this->request->get('data_update');

        $user = $this->userRepo->firstByID($userID);
        if (!$user) {
            $this->message = "user not found";
            $this->code    = 404;
            goto next;
        }
        $result = $this->userUsecase->updateUserByParams($user[User::_ID], $dataUpdate);
        if (!$result) {
            $this->message = "user update failed";
            $this->code    = 500;
            goto next;
        }
        $this->status  = "success";
        $this->message = "user updated successfully";
        $data          = $result;
        next:
        return $this->responseData($data);
    }

    public function confirmForgotPassword($user_id)
    {
        $this->request->validate([
            'new-password'     => ['required', 'min:6'],
            'confirm-password' => ['required', 'same:new-password'],
        ]);

        $newPassword = $this->request->get('new-password');
        $dataUpdate = [
            User::_PASSWORD => $newPassword
        ];
        $this->userUsecase->updateUserByParams($user_id, $dataUpdate);
        return view('congratulate')->with(['url' => Config('environment.APP_DOMAIN')]);
    }

    // user info
    public function getUserInfo(){
        $validated = $this->validateBase($this->request,[
            'user_id' => 'required'
        ]);
        if ($validated) {
            $this->message = "validation fail";
            $this->code    = 422;
            return $this->responseData($validated);
        }
        $userID = $this->request->get('user_id');

        $userInfo = $this->userUsecase->getUserInfo($userID);

        $this->message = "get user info successfully";
        $this->status = "success";
        return $this->responseData($userInfo);
    }
}
