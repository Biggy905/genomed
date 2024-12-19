<?php

namespace Unit;

use app\controllers\QRController;
use app\entities\Link;
use app\forms\CreateLinkForm;
use app\forms\SlugForm;
use app\repositories\LinkLogRepository;
use app\repositories\LinkRepository;
use app\services\LinkLogService;
use app\services\LinkService;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;
use Yii;
use yii\web\Application;

class LinkRepositoryTest extends Unit
{
    public UnitTester $tester;

    public function testSave(): void
    {
        $callback = static function() {
            $link = new Link();
            $link->link = 'https://vk.com/feed';

            $repository = new LinkRepository();

            $repository->save($link);
        };
        $this->tester->expectThrowable(
            yii\db\IntegrityException::class,
            $callback
        );
    }
}
