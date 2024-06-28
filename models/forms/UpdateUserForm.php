<?php

namespace app\models\forms;

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UpdateUserForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $password;
    public $patronymic;
    public $imageFile;

    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name'], 'required'],
            [['password'], 'string'],
            ['patronymic', 'string'],
            [['imageFile'], 'file', 'extensions' => 'jpg,png', 'skipOnEmpty' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t("app", 'ID'),
            'first_name' => Yii::t("app", 'Имя'),
            'last_name' => Yii::t("app", 'Фамилия'),
            'patronymic' => Yii::t("app", 'Отчество'),
            'username' => Yii::t("app", 'Username'),
            'email' => Yii::t("app", 'Email'),
            'password' => Yii::t("app", 'Password'),
            'isAdmin' => Yii::t("app", 'Is Admin'),
            'photo' => Yii::t("app", 'Аватар'),
            'authKey' => Yii::t("app", 'Auth Key'),
            'createdAt' => Yii::t("app", 'Created At'),
            'updatedAt' => Yii::t("app", 'Updated At'),
        ];
    }

    public function update($user)
    {
        if (!$this->validate()) {
            return false;
        }

        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->patronymic = $this->patronymic;
        $user->username = $this->username;

        if ($this->password) {
            $user->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        if ($this->imageFile) {
            $filePath = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($filePath);
            $user->photo = $filePath;
        }

        return $user->save();
    }
}