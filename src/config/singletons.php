<?php

use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCode;

return [
    \app\repositories\interfaces\LinkRepositoryInterface::class =>
        \app\repositories\LinkRepository::class,
    \app\repositories\interfaces\LinkLogRepositoryInterface::class =>
        \app\repositories\LinkLogRepository::class,
    \chillerlan\QRCode\QRCode::class => static function () {
        $options = new QROptions(
            [
                'outputInterface' => QRGdImagePNG::class,
                'circleRadius' => 10,
            ]
        );

        return new QRCode($options);
    },

    \app\services\LinkService::class => \app\services\LinkService::class,
    \app\services\LinkLogService::class => \app\services\LinkLogService::class,
];
