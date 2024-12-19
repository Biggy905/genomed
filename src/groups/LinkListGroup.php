<?php

namespace app\groups;

use app\entities\Link;

final class LinkListGroup
{
    public static function toArray(array $links): array
    {
        $data = [];
        foreach ($links as $link) {
            $data[] = LinkItemGroup::toArray($link);
        }

        return $data;
    }
}
