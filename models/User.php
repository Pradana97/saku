<?php
namespace app\models;
use mdm\admin\models\User as mdmUser;
use mdm\admin\components\UserStatus;
use app\models\GeneralModelsTrait;
class User extends mdmUser{
    use GeneralModelsTrait;
    public static function findIdentity($id)
    {
        return static::where(['id' => $id, 'status' => UserStatus::ACTIVE])->one();
    }
    public static function findByUsername($username)
    {
        return static::first(['username' => $username, 'status' => UserStatus::ACTIVE]);
    }
}