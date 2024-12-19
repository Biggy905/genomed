<?php

declare(strict_types=1);

namespace app\components\model;

use app\components\query\AbstractQueryInterface;

interface AbstractModelInterface
{
    public static function tableName(): string;

    public static function find(): AbstractQueryInterface;

    public static function findByDeleted(): AbstractQueryInterface;
}
