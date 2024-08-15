//Es el DTO

<?
TutorDTO{
    private $id;
    private $name;
    private $phone;
    private $is_director;//recordar que es boobleano

    public function __Construct($id, $name, $phone, $is_director){
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->is_director = $is_director;
    }

    //Getters y Setters del id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Getters y setters para name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Getters y setters para phone
    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    // Getters y setters para is_director
    public function getIsDirector() {
        return $this->is_director;
    }

    public function setIsDirector($is_director) {
        $this->is_director = $is_director;
    }
}
?>