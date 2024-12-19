<?php

declare(strict_types=1);

namespace app\components;

use yii\base\Model;

abstract class AbstractForm extends Model
{
    protected string $formName = '';

    public function formName(): string
    {
        return $this->formName;
    }

    public function addRule($attributes, $validator, $options = []): self
    {
        $validators = $this->getValidators();

        if ($validator instanceof Validator) {
            $validator->attributes = (array)$attributes;
        } else {
            $validator = Validator::createValidator($validator, $this, (array)$attributes, $options);
        }

        $validators->append($validator);
        $this->defineAttributesByValidator($validator);

        return $this;
    }

    public function runValidate(
        array $request,
              $attributes = null,
              $validator = null,
        ?array $options = null,
    ): bool {
        $this->load($request);

        if (
            !empty($attributes)
            && $validator instanceof Validator
            && isset($options)
        ) {
            $this->addRule($attributes, $validator, $options);
        }

        return $this->validate();
    }

    private function defineAttributesByValidator($validator): void
    {
        foreach ($validator->getAttributeNames() as $attribute) {
            if (!$this->hasAttribute($attribute)) {
                $this->defineAttribute($attribute);
            }
        }
    }
}
