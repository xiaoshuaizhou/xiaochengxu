<?php

namespace App\Exceptions;

use Exception;

class ExceptionHandler extends Handler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // 如果config配置debug为true ==>debug模式的话让laravel自行处理
        if(config('app.debug')){
            return parent::render($request, $e);
        }
        return $this->handle($request, $e);
    }

    /**
     * 自定义全局异常
     * @param $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Exception $e){
        // 只处理自定义的APIException异常
        if($e instanceof ApiException) {
            $result = [
                "msg"    => $e->getMessage(),
                "data"   => [],
                "error_code" => 0
            ];
            return response()->json($result, 400);
        }
        //id必须是正整数
        if($e instanceof IDMustBePostException) {
            $result = [
                "msg"    => $e->getMessage(),
                "data"   => [],
                "error_code" => 10001
            ];
            return response()->json($result, 400);
        }
        return parent::render($request, $e);
    }
}