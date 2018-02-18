<?php 
Class Usuario 
{
    public $nombre;
    public $apellido;
    public $documento;
    public $tipoDocumento;
    public $telefono;
    public $id;
    public $fechaDeNacimiento;
    public $domicilio;
    public $obraSocial;
    public $genero;

/*    function __construct($nom, $ape) {
       $this->$nombre = $nom;
       $this->$apellido = $ape;
   }

    */



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
    public function getDocumento()
    {
        return $this->$documento;
    }
    public function setDocumento($dato)
    {
        $this->$documento = $dato;
               return $this;
    }
    public function getTipoDocumento()
    {
        return $this->$tipoDocumento;
    }
    public function setTipoDocumento($dato)
    {
        $this->$tipoDocumento = $dato;
               return $this;
    }
    public function getTelefono()
    {
        return $this->$telefono;
    }
    public function setTelefono($dato)
    {
        $this->$telefono = $dato;
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
    public function getFechaDeNacimiento()
    {
        return $this->$fechaDeNacimiento;
    }
    public function setFechaDeNacimiento($dato)
    {
        $this->$fechaDeNacimiento = $dato;
               return $this;
    }
    public function getDomicilio()
    {
        return $this->$domicilio;
    }
    public function setDomicilio($dato)
    {
        $this->$domicilio= $dato;
               return $this;
    }
    public function getObraSocial()
    {
        return $this->$obraSocial;
    }
    public function setObraSocial($dato)
    {
        $this->$obraSocial = $dato;
               return $this;
    }
    public function getGenero()
    {
        return $this->$genero;
    }
    public function setGenero($dato)
    {
        $this->$genero = $dato;
               return $this;
    }
    public function obtenerInfoPaciente()
    {
        return $this;
    }
}
?>