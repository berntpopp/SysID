<?php

namespace app\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadDatabaseForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $databaseFile;

    public function rules()
    {
        return [
            [['databaseFile'], 'file', 'skipOnEmpty' => false],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->databaseFile->saveAs('../files/' . $this->databaseFile->baseName . '.' . $this->databaseFile->extension);
            return true;
        } else {
            return false;
        }
    }
}