<?php

namespace App\Model;

use Core\App;
use Core\Kernel\AbstractModel;

class ProductsModel extends AbstractModel
{
    protected static $table = 'products';

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
            "INSERT INTO " . self::$table . " (title,reference,descri) VALUES (?,?,?)",
            array($post['title'], $post['reference'], $post['descri'])
        );
    }


    public static function update($id,$post)
    {
        App::getDatabase()->prepareInsert(
            "UPDATE " . self::$table . " SET title = ?, reference = ?, descri = ? WHERE id = ?",
            array($post['title'],$post['reference'],$post['descri'],$id)
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
    public static function findById($id,$columId = 'id')
    {
        return App::getDatabase()->prepare("SELECT * FROM " . self::getTable() . " WHERE ".$columId." = ?",[$id],get_called_class(),true);
    }


}