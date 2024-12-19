<?php

namespace app\forms;

use app\components\AbstractForm;
use app\components\CustomUrl;
use app\repositories\LinkRepository;
use yii\helpers\Url;

final class SlugForm extends AbstractForm
{
    public $slug;

    public function rules(): array
    {
        return [
            [
                'slug',
                'required',
            ],
            [
                'slug',
                'trim',
            ],
            [
                'slug',
                'validateSlug',
            ],
        ];
    }

    public function validateSlug(): void
    {
        $repository = new LinkRepository();
        $link = CustomUrl::toUrl(['q-r/index', 'slug' => $this->slug]);
        $exists = $repository->existsByLinkGenerated($link);
        if (!$exists) {
            $this->addError('slug', 'Ссылка не найдена!');
        }
    }
}
