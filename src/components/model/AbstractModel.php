<?php

declare(strict_types=1);

namespace app\components\model;

use app\components\query\AbstractQueryInterface;
use yii\db\ActiveRecord;
use LogicException;

abstract class AbstractModel extends ActiveRecord implements AbstractModelInterface
{
    protected static ?string $tableName;
    protected static ?string $nameClassQuery;

    public static function tableName(): string
    {
        static::throwTableName();

        return static::$tableName;
    }

    public static function find(): AbstractQueryInterface
    {
        static::throwActiveQuery();

        return (new static::$nameClassQuery(get_called_class()))
            ->byDeletedNull();
    }

    public static function findByDeleted(): AbstractQueryInterface
    {
        static::throwActiveQuery();

        return (new static::$nameClassQuery(get_called_class()));
    }

    private static function throwTableName(): void
    {
        if (empty(static::$tableName)) {
            throw new LogicException('Не указано имя таблицы!');
        }
    }

    private static function throwActiveQuery(): void
    {
        if (empty(static::$nameClassQuery)) {
            throw new LogicException('Не указан класс от AbstractQuery.');
        }

        if (!class_exists(static::$nameClassQuery)) {
            throw new LogicException('Класс "' . static::$nameClassQuery . '" не существует.');
        }
    }
}
