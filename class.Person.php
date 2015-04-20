<?php
class Person {
    private $_name;
    private $_md5Password;
    private $_id;

    public function setName($name) {
        $this->_name = $name;
    }

    public function setPassword($md5Password) {
        $this->_md5Password = $md5Password;
    }

    public function setID($id) {
        $this->_name = $id;
    }

    public function getName() {
        return $this->_name;
    }

    public function getPassword() {
        return $this->_md5Password;
    }

    public function getID() {
        return $this->_id;
    }
}
?>