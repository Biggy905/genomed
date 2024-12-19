<?php

declare(strict_types=1);

namespace app\components;

use yii\web\Controller;
use yii\web\Response;
use Yii;

class AbstractController extends Controller
{
    public function response(?array $data = null): Response
    {
        $response['status'] = true;

        $code = Yii::$app->response->statusCode;
        if ($code >= 400 && $code <= 599) {
            $response['status'] = false;

            $exception =  Yii::$app->getErrorHandler()->exception;
            if (!empty($exception)) {
                $response['code'] = $code;
                $response['message'] = $exception->getMessage();
                if (
                    $code >= 500
                    && $code <= 599
                    && (
                        getenv('ENV') === 'dev'
                        || getenv('ENV') === 'test'
                    )
                ) {
                    $response['line'] = $exception->getLine();
                    $response['stacktrace'] = $exception->getTrace();
                }
            }
        } elseif ($code === 200) {
            $response['data'] = $data;
        }

        $this->response->format = Response::FORMAT_JSON;
        $this->response->data = $response;

        return $this->response;
    }
}