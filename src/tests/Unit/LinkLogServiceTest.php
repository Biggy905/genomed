<?php

namespace Unit;

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
use Tests\fixtures\LinkFixture;
use Tests\fixtures\LinkLogFixture;
use Tests\Support\UnitTester;
use yii\web\NotFoundHttpException;

class LinkLogServiceTest extends Unit
{
    public UnitTester $tester;
    private LinkLogService $service;
    private SlugForm $slugForm;

    public function fixtures(): array
    {
        return [
            'link' => LinkFixture::class,
            'link_log' => LinkLogFixture::class,
        ];
    }

    public function _before(): void
    {
        parent::_before();

        $this->service = new LinkLogService(
            new LinkLogRepository(),
            new LinkRepository(),
        );

        $this->slugForm = new SlugForm();
    }

    public function testEqual(): void
    {
        $service = $this->service;

        $data = ['slug' => 'asdasd'];
        $form = $this->slugForm;
        $form->runValidate($data);

        $callback = static function() use ($service, $form) {
            $service->read($form);
        };
        $this->tester->expectThrowable(
            NotFoundHttpException::class,
            $callback
        );
        unset($form);

        $fixtures = $this->fixtures();
        $dataFixturesLink = (new $fixtures['link']())->getDataFile()['link1'];

        $data = ['slug' => 'OTBfGQlr'];
        $form = $this->slugForm;
        $form->runValidate($data);

        $link = $service->read($form);

        $this->tester->assertEquals($link, $dataFixturesLink['link']);
    }
}
