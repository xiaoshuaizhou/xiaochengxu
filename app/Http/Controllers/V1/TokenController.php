<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\UsersTokenRepository;
use App\Validator\TokenGetValidator;

class TokenController extends Controller
{
    protected $tokenValidator;
    protected $userRepository;

    /**
     * TokenController constructor.
     * @param $tokenValidator
     */
    public function __construct(
        TokenGetValidator $tokenValidator,
        UsersTokenRepository $usersRepository
    ){
        $this->tokenValidator = $tokenValidator;
        $this->userRepository = $usersRepository;
    }

    /**
     * @param $code 客户端传递的code
     */
    public function getToken()
    {
        $code = request()->input('code');
        $this->tokenValidator->checkToken($code);

        return $this->userRepository->getToken($code);
    }
}
