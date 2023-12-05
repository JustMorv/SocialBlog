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
    public $photo;


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
            ['photo', 'string'],
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
        $user->photo = $this->photo;
        $user->hashPassword($this->password);

        return $user->save() ? $user : null;

    }

}