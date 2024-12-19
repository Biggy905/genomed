<?php

namespace Unit;

use app\forms\CreateLinkForm;
use app\forms\SlugForm;
use app\repositories\LinkRepository;
use app\services\LinkService;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class SlugFormTest extends Unit
{
    public UnitTester $tester;
    private SlugForm $slugForm;

    public function _before(): void
    {
        parent::_before();

        $this->slugForm = new SlugForm();
    }

    public function testValidate(): void
    {
        $data = [];
        $form = $this->slugForm;
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            123
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'asd' => 'asd'
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => '',
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 'asd',
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 123,
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => [],
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'link' => 'htt',
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);
        
        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'slug' => 'https://vk.com',
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);

        $this->tester->assertFalse($result);
        unset($data);
        unset($form);
        unset($result);


        $data = [
            'slug' => 'OTBfGQlr',
        ];
        $form = $this->slugForm;
        $result = $form->runValidate($data);

        $this->tester->assertTrue($result);
        unset($data);
        unset($form);
        unset($result);
    }
}
