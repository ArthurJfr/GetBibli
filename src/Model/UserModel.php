<?php

namespace App\Model;

use Core\App;
use Core\Kernel\AbstractModel;
use Core\Kernel\Database;


class UserModel extends AbstractModel
{
    protected static $table = 'users';
    public static function insert($post,$pass,$token,$role = 'user')
    {
        App::getDatabase()->prepareInsert(

            "INSERT INTO " . self::$table . " (`email`,`password`,`role`,`token`,`created_at`) VALUES (?,?,?,?, NOW())",
            array($post['email'],$pass,$role,$token)
        );
    }

}