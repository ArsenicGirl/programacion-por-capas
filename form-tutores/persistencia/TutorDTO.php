<?php
//Es el DTO
class TutorDTO {
    private $id;
    private $name;
    private $phone;
    private $is_director;

    public function __construct($id, $name, $phone, $is_director) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->is_director = $is_director;
    }

    // Getters y Setter para el id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getters y Setter para  el nombre
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    //Getters y Setter para el teléfono
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    //Getters y Setter para is_director
    public function getIsDirector() {
        return $this->is_director;
    }

    public function setIsDirector($is_director) {
        $this->is_director = $is_director;
    }
}
?>
