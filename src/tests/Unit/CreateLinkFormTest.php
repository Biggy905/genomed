<?php

namespace Unit;

use app\controllers\QRController;
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

class CreateLinkFormTest extends Unit
{
    public UnitTester $tester;
    private CreateLinkForm $createLinkForm;

    public function _before(): void
    {
        parent::_before();

        $this->createLinkForm = new CreateLinkForm();
    }

    public function testValidate(): void
    {
        $data = [];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            123
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'asd' => 'asd'
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => '',
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 'asd',
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 123,
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => [],
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 'htt',
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 'https',
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 'https://v342354.com',
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 'https://vk.com/feed',
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);

        $data = [
            'link' => 'https://vk.com',
        ];
        $form = $this->createLinkForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertTrue($result);
        unset($data);
        unset($form);
        unset($result);
    }

    private function test()
    {
        $config = require __DIR__ . '/config/config.php';
        $qrConfig = new QROptions(
            [
                'outputInterface' => QRGdImagePNG::class,
                'circleRadius' => 10,
            ]
        );
        $qr = new QRCode($qrConfig);
        $linkService = new LinkService(
            new LinkRepository(),
            $qr,
        );

        $linkLogService = new LinkLogService(
            new LinkLogRepository(),
            new LinkRepository(),
        );

        Yii::$app->controller = new QRController(
            'q-r',
            new Application($config),
            $linkService,
            $linkLogService,
            new SlugForm(),
        );

        $data = [];
        $form = new SlugForm();
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);
    }
}
