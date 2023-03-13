<?php
namespace App\Service;
/**
 *  class Form
 *  Permet de générer un formulaire
 */
class Form
{
    protected $post;
    protected $error;

    function __construct($error = array(),$method = 'post')
    {
        if($method == 'post') {
            $this->post = $_POST;
        } else {
            $this->post = $_GET;
        }
        $this->error = $error;
    }

    /**
     * @param $html string
     * @return string
     */
    private function arround($html)
    {
        return '<div class="form-control">'.$html.'</div>';
    }

    /**
     * @param $name string
     * @return string
     */
    private function getValue($name,$data)
    {
        if(!empty($data)) {
            return !empty($this->post[$name]) ? $this->post[$name] : $data ;
        } else {
            return !empty($this->post[$name]) ? $this->post[$name] : null ;
        }

    }
    /**
     * @param $name string
     * @return string
     */
    public function input($name,$type = 'text',$data = null)
    {
        return $this->arround('<input type="'.$type.'" id="input_'.$name.'" name="'.$name.'" value="'.$this->getValue($name,$data).'">');
    }

    /**
     * @param $name
     * @param null $data
     * @return string
     */
    public function textarea($name, $data = null)
    {
        return $this->arround('<textarea name="'.$name.'">'.$this->getValue($name,$data).'</textarea>');
    }

    /**
     * @param $name string
     * @param $value string
     * @return string
     */
    public function submit($name = 'submitted',$value='Envoyer')
    {
        return '<input type="submit" name="'.$name.'" id="'.$name.'" value="'.$value.'">';
    }

    /**
     * @param $name
     * @return string|null
     */
    public function error($name)
    {
        if(!empty($this->error[$name])) {
            return '<span class="error">'.$this->error[$name].'</span>';
        }
        return null;
    }

    /**
     * @param $name
     * @param $label valeur du label
     * @return string
     */
    public function label($name,$label = null)
    {
        //$text = ($label === null) ? $name : $label;
        return '<label for="'.$name.'">'.ucfirst($name).'</label>';
    }

    /**
     * @param $name
     * @param $entitys
     * @param $column
     * @param $data
     * @return string
     */
    public function selectEntity($name, $entitys, $column, $data = '', $idd = 'id')
    {
        $html = '<select id="'.$name.'" name="'.$name.'">';
        foreach ($entitys as $entity) {
            if(!empty($data) && $data == $entity->$idd){
                $selected = ' selected="selected"';
            } else {
                $selected = '';
            }
            $html .= '<option value="'.$entity->$idd.'"'.$selected.'>'.$entity->$column.'</option>';
        }
        $html .= '</select>';
        return $html;
    }

    /**
     * @param string $name
     * @param array $options
     * @param $selected
     * @return string
     */
    public function select(string $name, array $options, $selected = null): string
    {
        $html = '<select id="'.$name.'" name="'.$name.'">';
        foreach($options as $value => $label) {
            $isSelected = ($value === $selected) ? 'selected' : '';
            $html .= '<option value="'.$value.'" '.$isSelected.'>'.$label.'</option>';
        }
        $html .= '</select>';
        return $html;
    }
}
