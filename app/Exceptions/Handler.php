<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ModelNotFoundException::class,
        IDMustBePostException::class
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
        //id(ids)必须是正整数
        if($e instanceof IDMustBePostException) {
            $result = [
                "msg"    => empty($e->getMessage()) ? $e->message : $e->getMessage() ,
                "data"   => [],
                "error_code" => $e->error_code
            ];
            return response()->json($result, $e->code);
        }
        //用户地址
        if($e instanceof AddressException) {
            $result = [
                "msg"    => empty($e->getMessage()) ? $e->message : $e->getMessage() ,
                "data"   => [],
                "error_code" => $e->error_code
            ];
            return response()->json($result, $e->code);
        }
        //用户信息异常
        if($e instanceof UserException) {
            $result = [
                "msg"    => empty($e->getMessage()) ? $e->message : $e->getMessage() ,
                "data"   => [],
                "error_code" => $e->error_code
            ];
            return response()->json($result, $e->code);
        }
        //用户信息异常
        if($e instanceof OrderProducts) {
            $result = [
                "msg"    => empty($e->getMessage()) ? $e->message : $e->getMessage() ,
                "data"   => [],
                "error_code" => $e->error_code
            ];
            return response()->json($result, $e->code);
        }
        //用户访问权限异常
        if($e instanceof ForbiddenException) {
            $result = [
                "msg"    => empty($e->getMessage()) ? $e->message : $e->getMessage() ,
                "data"   => [],
                "error_code" => $e->error_code
            ];
            return response()->json($result, $e->code);
        }
        //token 异常
        if($e instanceof TokenException) {
            $result = [
                "msg"    => empty($e->getMessage()) ? $e->message : $e->getMessage() ,
                "data"   => [],
                "error_code" => $e->error_code
            ];
            return response()->json($result, $e->code);
        }
        //WeCaht 异常
        if($e instanceof WeChatException) {
            $result = [
                "msg"    => empty($e->getMessage()) ? $e->message : $e->getMessage() ,
                "data"   => [],
                "error_code" => $e->code
            ];
            return response()->json($result, $e->error_code);
        }
        // model 不存在
        if($e instanceof ModelNotFoundException) {
            $result = [
                "msg"    => empty($e->getMessage()) ? '请求的数据不存在' : $e->getMessage(),
                "data"   => [],
                "error_code" => 40000
            ];
            return response()->json($result, 404);
        }
        //自定义URL错误异常
        if($e instanceof HttpException) {
            $result = [
                "msg"    => '访问的URL不存在',
                "data"   => [],
                "error_code" => 999
            ];
            return response()->json($result, 404);
        }

        return parent::render($request, $e);
    }
}
