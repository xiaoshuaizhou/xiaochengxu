<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\UsersTokenRepository;
use App\Validator\TokenGetValidator;

class TokenController extends Controller
{
    protected $tokenValidator;

    /**
     * TokenController constructor.
     * @param $tokenValidator
     */
    public function __construct(TokenGetValidator $tokenValidator)
    {
        $this->tokenValidator = $tokenValidator;
    }

    /**
     * @param $code 客户端传递的code
     * @return mixed
     * @throws \Exception
     */
    public function getToken()
    {
        $code = request()->input('code');
        $this->tokenValidator->checkToken($code);
        $userToken = new UsersTokenRepository($code);

        return $userToken->getToken($code);
    }
}
