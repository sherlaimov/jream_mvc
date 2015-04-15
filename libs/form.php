<?php

require_once('Form/validate.php');

class Form
{
    /** @var $_currentItem the immediately posted item */

    private $_currentItem = null;

    /** @var $_postData stores posted data */
    private $_postData = array();

    /** @var object Val*/

    private $_val = array();

    /** @var error array*/

    private $_error = array();


    public function __construct(){

        $this->_val = new Validate();

    }

    public function post($field){
        //var_dump($_POST['lastName']); die;
        $this->_postData[$field] = $_POST[$field];
        $this->_currentItem = $field;
        //echo $this->_currentItem . '<br/>';
        return $this;
    }

    /**
     * fetch - return the posted data
     * @param mixed $fieldName
     * @return mixed string or array
     */

    public function fetch($fieldName = null)
    {
        if($fieldName)
        {
            if (isset($this->_postData[$fieldName]))
            return $this->_postData[$fieldName];
            else
                return false;
        }
        else
        {
            return $this->_postData;
        }

    }

    /*

    @param string $typeOfValidator - a method from the Form/Validate class
    @param string $arg - a property to validate against

    */

    public function validate($typeOfValidator, $arg = null)
    {

        if($arg == null) {
             $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);

        } else {
             $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);

        }

        if ($error){
            $this->_error[$this->_currentItem] = $error;

        }

        //print_r($error);
        //var_dump($error);
        //$this->_val->minLength('dog', $arg);
        //$this->_val->integer($this->_postData[$this->_currentItem]);


        //WHAT THE HELL IS THIS???
        return $this;
    }


    /**
     * submit - handles the form and throws an exception
     * @throws Exception
     */
    public function submit()
    {
        if(empty ($this->_error)){
            return true;
        }
        else {

            $str = '';
            foreach($this->_error as $key => $value) {
                $str .= $key . ' => ' . $value . "\r\n";
            }
            throw new Exception($str);
        }
    }

}