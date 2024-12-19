<?php

namespace Unit;

use app\forms\CreateLinkForm;
use app\repositories\LinkRepository;
use app\services\LinkService;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Codeception\Test\Unit;
use Tests\fixtures\LinkFixture;
use Tests\fixtures\LinkLogFixture;
use Tests\Support\UnitTester;

class LinkServiceTest extends Unit
{
    public UnitTester $tester;
    private LinkService $service;
    private CreateLinkForm $createLinkForm;

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
        $options = new QROptions(
            [
                'outputInterface' => QRGdImagePNG::class,
                'circleRadius' => 10,
            ]
        );

        $this->service = new LinkService(
            new LinkRepository(),
            new QRCode($options)
        );

        $this->createLinkForm = new CreateLinkForm();
    }

    public function testEqual(): void
    {

        $service = $this->service;

//        $callback = static function() use ($form) {
//            $data = [
//                'id' => 10,
//                'name' => 'adas',
//                'surname' => 'asdasd',
//                'email' => 'asda',
//                'phone' => 'asdasd',
//                'events' => 'asd',
//            ];
//            $form->runValidate($data);
//        };
//        $this->tester->expectThrowable(
//            NumberParseException::class,
//            $callback
//        );

//        $data = [
//            'id' => 10,
//            'name' => 'adas',
//            'surname' => 'asdasd',
//            'email' => 'asda',
//            'phone' => '70005557788',
//            'events' => [],
//        ];
//        $this->tester->assertFalse($form->runValidate($data));


        $data = [
            'link' => 'https://vk.com',
        ];
        $form = $this->createLinkForm;
        $form->runValidate($data);
        $array = $service->create($form);

        $this->tester->assertIsArray($array);
        $this->tester->assertArrayHasKey('message', $array);
        $this->tester->assertArrayHasKey('additional', $array);
        $this->tester->assertArrayHasKey('qr_code', $array['additional']);
        $this->tester->assertArrayHasKey('link_generated', $array['additional']);
        unset($form);
        unset($array);


        $array = $service->listByStatistic();

        $fixtures = $this->fixtures();
        $dataFixturesLinkLogs = (new $fixtures['link_log']())->getDataFile();
        $temp = [];
        foreach ($dataFixturesLinkLogs as $dataFixturesLinkLog) {
            $temp[$dataFixturesLinkLog['id_link']][] = true;
        }

        $dataFixturesLinks = (new $fixtures['link']())->getDataFile();
        $dataActual = [];
        foreach ($dataFixturesLinks as $dataFixturesLink) {
            $count = 0;
            if (!empty($temp[$dataFixturesLink['id']])) {
                $count = count($temp[$dataFixturesLink['id']]);
            }
            $dataActual[] = [
                'id' => $dataFixturesLink['id'],
                'url' => $dataFixturesLink['link'],
                'url_generated' => $dataFixturesLink['link_generated'],
                'countVisit' => $count,
                'created_at' => $dataFixturesLink['created_at'],
            ];

        }

        $this->tester->assertIsArray($array);
        foreach ($array as $item) {
            $this->tester->assertArrayHasKey('id', $item);
            $this->tester->assertArrayHasKey('url', $item);
            $this->tester->assertArrayHasKey('url_generated', $item);
            $this->tester->assertArrayHasKey('countVisit', $item);
            $this->tester->assertArrayHasKey('created_at', $item);

            foreach ($dataActual as $value) {
                if ($item['id'] === $value['id']) {
                    $this->tester->assertEquals($item['id'], $value['id']);
                    $this->tester->assertEquals($item['url'], $value['url']);
                    $this->tester->assertEquals($item['url_generated'], $value['url_generated']);
                    $this->tester->assertEquals($item['countVisit'], $value['countVisit']);
                    $this->tester->assertEquals($item['created_at'], $value['created_at']);
                }
            }
        }
    }
}
