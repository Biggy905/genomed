<?php

$exception = Yii::$app->getErrorHandler()->exception;

$statusCode = 500;
$message = 'Неизвестная ошибка';
$title = 'Ошибка: ' . $statusCode . '.';
if ($exception) {
    $statusCode = $exception->statusCode;
    $title = 'Ошибка: ' . $statusCode . ', ' .$exception->getMessage();
    $message = $exception->getMessage();
}

$this->title = $title;

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2><?= $statusCode?></h2>
            <p>
                <?= $message?>
            </p>
        </div>
    </div>
</div>
