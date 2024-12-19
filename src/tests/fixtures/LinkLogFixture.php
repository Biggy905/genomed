<?php

namespace Tests\fixtures;

use app\entities\LinkLog;
use yii\test\ActiveFixture;

final class LinkLogFixture extends ActiveFixture
{
    public $modelClass = LinkLog::class;
    public $depends = [LinkFixture::class];
    public $dataFile = '@app/fixtures/data/link_log.php';

    public function getDataFile(): array
    {
        return $this->getData();
    }
}
