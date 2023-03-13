<?php

namespace App\Model;

use Core\App;
use Core\Kernel\AbstractModel;

class BorrowModel extends AbstractModel
{
    protected static $table = 'borrows';
    protected static $tablePdt = 'products';
    protected static $tableSub = 'subscribers';

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
            "INSERT INTO " . self::$table . " (id_sub,id_product,date_start,date_end) VALUES (?,?,NOW(),?)",
            array($post['subscriber'], $post['product'], $post['date_end'])
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


    public static function getAll()
    {
        return App::getDatabase()->query("SELECT * FROM ".self::getTable()." a INNER JOIN products b ON a.id_product = b.id INNER JOIN subscribers d ON a.id_sub = d.id ORDER BY date_start ASC ",get_called_class());
    }

    public static function findById($id,$columId = 'id')
    {
        return App::getDatabase()->prepare("SELECT * FROM " . self::getTable() . " WHERE ".$columId." = ?",[$id],get_called_class(),true);
    }


}