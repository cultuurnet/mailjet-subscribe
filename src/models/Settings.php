<?php

namespace publiq\mailjetsubscribe\models;

use craft\base\Model;

class Settings extends Model
{
    public $apiKeyPublic = '';
    public $apiKeyPrivate = '';
    public $listId = '';

    public function rules()
    {
        return [
            [['apiKeyPublic', 'apiKeyPrivate', 'listId'], 'required'],
        ];
    }
}