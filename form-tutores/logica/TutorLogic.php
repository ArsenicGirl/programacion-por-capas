<?php
require_once('../persistencia/TutorDAO.php');
require_once('../persistencia/TutorDTO.php');
class TutorLogic{
    private $tutorDAO;

    public function __construct(){
        $this->tutorDAO = new TutorDAO();

    }

    //Traer el metodo de leer todos los datos
    public function getReadTutor(){
        return $this->tutorDAO->readTutor();
    }

     //Traer el metodo de leer todos los datos pero por Id
    public function getReadById($id){
        return $this->tutorDAO->readById($id);
    }

    //Traer el metodo de crear tutor
    public function createTutor($name, $phone, $is_director){
        // Crear el objeto DTO
        $tutorDTO = new TutorDTO(null, $name, $phone, (bool)$is_director);

        //lógica para crear un tutor usando DAO
        $this->tutorDAO->createTutor($tutorDTO);
    }

    //Traer el metodo de actualizar al tutor
    public function updateTutor($id, $name, $phone, $is_director){
        //crear el objeto DTO
        $tutorDTO = new TutorDTO($id, $name, $phone, (bool)$is_director);

        $this->tutorDAO->updateTutor($tutorDTO);
    }

    //Traer el metodo para eliminar un tutor
    public function deleteTutor($id){
        $this->tutorDAO->deleteTutor($id);
    }


}
?>