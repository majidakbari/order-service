<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use App\Exceptions\HTTPException\Abstraction\HttpException;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

class Handler extends ExceptionHandler
{
    protected $appExceptions = [
        NotFoundHttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        HttpResponseException::class,
        MethodNotAllowedHttpException::class,
        AuthenticationException::class,
        UnauthorizedException::class,
        SymfonyHttpException::class,
        ThrottleRequestsException::class,
        AuthorizationException::class,
        BadRequestHttpException::class,
    ];

    public function render($request, Throwable $e)
    {
        if ($e instanceof HttpException) {
            return $this->generateJsonResponseForHttpExceptions($e);
        }
        if (in_array(get_class($e), $this->appExceptions)) {
            return $this->generateJsonResponseForAppExceptions($e);
        }

        return parent::render($request, $e);
    }

    public function generateJsonResponseForAppExceptions(Throwable $e): JsonResponse
    {
        $class = get_class($e);
        switch ($class) {
            case NotFoundHttpException::class:
            case ModelNotFoundException::class:
                $statusCode = HTTPResponse::HTTP_NOT_FOUND;
                break;
            case ValidationException::class:
                $statusCode = HTTPResponse::HTTP_UNPROCESSABLE_ENTITY;
                /** @var Validator $validator */
                $validator = $e->validator;
                $msg = $validator->errors()->getMessages();
                break;
            case HttpResponseException::class:
                $statusCode = HTTPResponse::HTTP_INTERNAL_SERVER_ERROR;
                break;
            case MethodNotAllowedHttpException::class:
                $statusCode = HTTPResponse::HTTP_METHOD_NOT_ALLOWED;
                break;
            case AuthenticationException::class:
                $statusCode = HTTPResponse::HTTP_UNAUTHORIZED;
                break;
            case AuthorizationException::class:
                $statusCode = HTTPResponse::HTTP_FORBIDDEN;
                break;
            case UnauthorizedException::class:
                $statusCode = HTTPResponse::HTTP_FORBIDDEN;
                $msg = $e->getMessage() ?? trans('error.' . get_class_name($e));
                break;
            case ThrottleRequestsException::class:
                $statusCode = HTTPResponse::HTTP_TOO_MANY_REQUESTS;
                break;
            case BadRequestHttpException::class:
                $statusCode = HTTPResponse::HTTP_BAD_REQUEST;
                break;
            default:
                $statusCode = HTTPResponse::HTTP_INTERNAL_SERVER_ERROR;
                $msg = 'Error';
        }

        return $this->generateErrorResponse(get_class_name($e), $msg ?? trans('error.' . get_class_name($e)), $statusCode);
    }

    private function generateJsonResponseForHttpExceptions(HttpException $e): JsonResponse
    {
        return $this->generateErrorResponse($e->getError(), $e->getMessage(), $e->getCode());
    }

    private function generateErrorResponse(string $errorCode, $msg, int $statusCode): JsonResponse
    {
        return response()->json([
            'error' => $errorCode,
            'message' => $msg
        ], $statusCode);
    }
}
