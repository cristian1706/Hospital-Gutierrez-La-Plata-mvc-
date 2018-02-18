<?php 
Class Usuario 
{
    protected static $instance;
    //get instance singelton
    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public $nombre;
    public $apellido;
    public $username;
    public $clave;
    public $email;
    public $id;
    public $activo;
    public $ultimaModificacion;
    public $creacion;

    public function getNombre()
    {
        return $this->$nombre;
    }
    public function setNombre($dato)//usar esto en el update
    {
        $this->$nombre = $dato;
               return $this;
    }
    public function getApellido()
    {
        return $this->$apellido;
    }
    public function setApellido($dato)
    {
        $this->$apellido = $dato;
               return $this;
    }
    public function getUsername()
    {
        return $this->$username;
    }
    public function setUsername($dato)
    {
        $this->$username= $dato;
               return $this;
    }
    public function getClave()
    {
        return $this->$clave;
    }
    public function setClave($dato)
    {
        $this->$clave = $dato;
               return $this;
    }
    public function getEmail()
    {
        return $this->$email;
    }
    public function setEmail($dato)
    {
        $this->$email = $dato;
               return $this;
    }
    public function getID()
    {
        return $this->$id;
    }
    public function setID($dato)
    {
        $this->$id = $dato;
               return $this;
    }
    public function getActivo()
    {
        return $this->$activo;
    }
    public function setActivo($dato)
    {
        $this->$activo = $dato;
               return $this;
    }
    public function getCreacion()
    {
        return $this->$creacion;
    }
    public function setCreacion($dato)
    {
        $this->$creacion = $dato;
               return $this;
    }
    public function getModificacion()
    {
        return $this->$ultimaModificacion;
    }
    public function setModificacion($dato)
    {
        $this->$ultimaModificacion = $dato;
               return $this;
    }
    public function obtenerInfoUsuario()
    {
        return $this;
    }
}
?>