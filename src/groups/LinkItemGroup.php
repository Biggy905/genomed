<?php

namespace app\groups;

use app\entities\Link;

final class LinkItemGroup
{
    public static function toArray(Link $link): array
    {
        return [
            'id' => $link->id,
            'url' => $link->link,
            'url_generated' => $link->link_generated,
            'countVisit' => $link->countLinkLog,
            'created_at' => $link->created_at,
        ];
    }
}
