<?php

namespace Unit;

use app\groups\LinkItemGroup;
use app\groups\LinkListGroup;
use Tests\fixtures\LinkFixture;
use app\forms\CreateLinkForm;
use app\forms\SlugForm;
use app\repositories\LinkRepository;
use app\services\LinkService;
use chillerlan\QRCode\Output\QRGdImagePNG;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Codeception\Test\Unit;
use Tests\fixtures\LinkLogFixture;
use Tests\Support\UnitTester;

class LinkGroupTest extends Unit
{
    public UnitTester $tester;
    private LinkRepository $linkRepository;
    private LinkItemGroup $linkItemGroup;
    private LinkListGroup $linkListGroup;

    public function _before(): void
    {
        parent::_before();

        $this->linkRepository = new LinkRepository();
        $this->linkListGroup = new LinkListGroup();
        $this->linkItemGroup = new LinkItemGroup();
    }

    public function fixtures(): array
    {
        return [
            'link' => LinkFixture::class,
            'link_log' => LinkLogFixture::class,
        ];
    }

    public function testItemToArray(): void
    {
        $fixtures = $this->fixtures();
        $dataFixturesLinkLog = (new $fixtures['link_log']())->getDataFile();
        $temp = [];
        foreach ($dataFixturesLinkLog as $item) {
            if ($item['id_link'] === 1) {
                $temp[] = true;
            }
        }

        $count = count($temp);

        $dataFixturesLink = (new $fixtures['link']())->getDataFile()['link1'];
        $dataActual = [
            'id' => $dataFixturesLink['id'],
            'url' => $dataFixturesLink['link'],
            'url_generated' => $dataFixturesLink['link_generated'],
            'countVisit' => 0,
            'created_at' => $dataFixturesLink['created_at'],
        ];

        $link = $this->linkRepository->findById($dataActual['id']);

        $array = $this->linkItemGroup::toArray($link);

        $this->tester->assertIsArray($array);

        $this->tester->assertArrayHasKey('id', $array);
        $this->tester->assertArrayHasKey('url', $array);
        $this->tester->assertArrayHasKey('url_generated', $array);
        $this->tester->assertArrayHasKey('countVisit', $array);
        $this->tester->assertArrayHasKey('created_at', $array);

        $this->tester->assertEquals($array, $dataActual);
    }

    public function testListToArray(): void
    {
        $links = $this->linkRepository->findAll();

        $array = $this->linkListGroup::toArray($links);

        $fixtures = $this->fixtures();
        $dataFixturesLinks = (new $fixtures['link']())->getDataFile();
        $dataActual = [];
        foreach ($dataFixturesLinks as $dataFixturesLink) {
            $dataActual[] = [
                'id' => $dataFixturesLink['id'],
                'url' => $dataFixturesLink['link'],
                'url_generated' => $dataFixturesLink['link_generated'],
                'countVisit' => 0,
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
        }

        $this->tester->assertEquals($array, $dataActual);
    }
}
