<?php

namespace app\fixtures;

use app\entities\Link;
use yii\test\ActiveFixture;

final class LinkFixture extends ActiveFixture
{
    public $modelClass = Link::class;
    public $dataFile = '@app/fixtures/data/link.php';
}
