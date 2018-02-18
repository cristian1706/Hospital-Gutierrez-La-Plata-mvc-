<?php

class ConfiguracionAdminModel extends ConexionDBModel
{
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getConfiguracionInicial(){
    	$result = $this->queryList("SELECT * FROM configuracion_inicial;",[]);
        return $result;
    }

    public function getConfiguracionGeneral(){
        $result = $this->queryList("SELECT * FROM configuracion_general;",[]);
        return $result;
    }


    public function modificarConfiguracionInicial($panel1,$panel2,$panel3) {
    	$this->queryList("UPDATE configuracion_inicial SET titulo=?, descripcion=?, mail_contacto=? WHERE id=?;",[$panel1['titulo'],$panel1['descripcion'],$panel1['mail_contacto'],$panel1['id']]);
        $this->queryList("UPDATE configuracion_inicial SET titulo=?, descripcion=?, mail_contacto=? WHERE id=?;",[$panel2['titulo'],$panel2['descripcion'],$panel2['mail_contacto'],$panel2['id']]);
        $this->queryList("UPDATE configuracion_inicial SET titulo=?, descripcion=?, mail_contacto=? WHERE id=?;",[$panel3['titulo'],$panel3['descripcion'],$panel3['mail_contacto'],$panel3['id']]);
    }

    public function modificarConfiguracionGeneral($cant_elementos_pagina,$sitio_habilitado){
        $this->queryList("UPDATE configuracion_general SET cant_elementos_pagina=?, sitio_habilitado=?;",[$cant_elementos_pagina,$sitio_habilitado]);
    }
}

?>