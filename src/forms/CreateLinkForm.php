<?php

declare(strict_types=1);

namespace app\forms;

use app\components\AbstractForm;
use app\components\HttpClient\HttpClient;
use app\repositories\LinkRepository;

final class CreateLinkForm extends AbstractForm
{
    public $link;

    public function rules(): array
    {
        return [
            [
                'link',
                'required',
                'skipOnEmpty' => false,
                'message' => 'Необходимо заполнить ссылку',
            ],
            [
                'link',
                'trim',
            ],
            [
                'link',
                'string',
                'min' => 4,
                'max' => 256,
            ],
            [
                'link',
                'url',
                'message' => 'Невалидная ссылка',
            ],
            [
                'link',
                'validateLinkExternal',
            ],
            [
                'link',
                'validateLinkUnique',
            ],
        ];
    }

    public function validateLinkExternal(): void
    {
        $client = new HttpClient();
        $response = $client->exec($this->link);
        $code = $response['code'] ?? 0;
        if ($code !== 200) {
            $this->addError('link', 'Данный URL не доступен');
        }
    }

    public function validateLinkUnique(): void
    {
        $repository = new LinkRepository();
        $link = $repository->existsByLink($this->link);
        if (!empty($link)) {
            $this->addError('link', 'В системе данный URL существует!');
        }
    }
}
