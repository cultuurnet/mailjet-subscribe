<?php

namespace publiq\mailjetsubscribe\models;

use craft\base\Model;

class Settings extends Model
{
    public string $apiKeyPublic = '';
    public string $apiKeyPrivate = '';
    public string $listId = '';

    public function rules(): array
    {
        return [
            [['apiKeyPublic', 'apiKeyPrivate', 'listId'], 'required'],
        ];
    }
}