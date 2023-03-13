<?php

namespace App\Model;

use Core\App;
use Core\Kernel\AbstractModel;

class SubscribersModel extends AbstractModel
{
    protected static $table = 'subscribers';

    protected $id;
    protected $title;
    protected $content;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
    protected $super;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getSuper()
    {
        return mb_strtoupper($this->title);
    }


    public static function insert($post)
    {
        App::getDatabase()->prepareInsert(
            "INSERT INTO " . self::$table . " (lname,fname,email,age,created_at) VALUES (?,?,?,?,NOW())",
            array($post['lname'], $post['fname'], $post['email'],$post['age'])
        );
    }


    public static function update($id,$post)
    {
        App::getDatabase()->prepareInsert(
            "UPDATE " . self::$table . " SET fname = ?, lname = ?, email = ?, age = ? WHERE id = ?",
            array($post['fname'],$post['lname'],$post['email'],$post['age'],$id)
        );
    }
    public static function delete($id,$columId = 'id')
    {
        return App::getDatabase()->prepareInsert("DELETE FROM " . self::getTable() . " WHERE ".$columId." = ?",[$id],get_called_class(),true);
    }


    public static function getAllSub($column,$value)
    {
        return App::getDatabase()->prepare("SELECT * FROM " . self::getTable() ,get_called_class(),true);
    }


}