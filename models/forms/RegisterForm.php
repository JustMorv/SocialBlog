<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $email;

    public $password;
    public $patronymic;

    public $imageFile;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'first_name', 'last_name', 'email'], 'required'],
            ['password', 'string', 'min' => 6],
            ['email', 'email'],
            ['patronymic', 'string'],
            [['imageFile'], 'file', 'extensions' => 'jpg,png'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t("app",'Имя'),
            'last_name' => Yii::t("app",'Фамилия'),
            'patronymic' => Yii::t("app",'Отчество'),
            'username' => Yii::t("app",'Логин'),
            'email' => Yii::t("app",'E-mail'),
            'password' => Yii::t("app",'Пароль'),
            'photo' => Yii::t("app",'Фото'),
        ];
    }


    public function register()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->patronymic = $this->patronymic;
        $user->photo = $this->imageFile;
        $user->hashPassword($this->password);

        return $user->save() ? $user : null;

    }

    public function uploadImage($image)
    {
        $this->imageFile = $image;
        $path = Yii::getAlias("@webroot") . '/upload/';
        $this->imageFile =  strtolower(md5(uniqid($image->baseName))) . '.' . $image->extension;

        $image->saveAs($path . $this->imageFile);

    }

}