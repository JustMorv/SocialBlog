<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $patronymic
 * @property string|null $username
 * @property string $email
 * @property string|null $password
 * @property int|null $isAdmin
 * @property string|null $photo
 * @property string|null $authKey
 * @property string|null $createdAt
 * @property string|null $updatedAt
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['isAdmin'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['first_name', 'last_name', 'patronymic', 'username', 'email', 'password', 'photo', 'authKey'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' =>Yii::t("app",'ID'),
            'first_name' => Yii::t("app",'Имя'),
            'last_name' => Yii::t("app",'Фамилия'),
            'patronymic' => Yii::t("app",'Отчество'),
            'username' => Yii::t("app",'Username'),
            'email' => Yii::t("app",'Email'),
            'password' => Yii::t("app",'Password'),
            'isAdmin' => Yii::t("app",'Is Admin'),
            'photo' => Yii::t("app",'Аватар'),
            'authKey' => Yii::t("app",'Auth Key'),
            'createdAt' => Yii::t("app",'Created At'),
            'updatedAt' => Yii::t("app",'Updated At'),
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);// TODO: Implement findIdentity() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {

    }
    public static function findByEmailUser($email)
    {
        return static::findOne(['email' => $email ]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    public function hashPassword($password){
        return $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public static function getUserInfo()
    {
        return static::findOne(['id' => Yii::$app->user->id]);
    }
}
