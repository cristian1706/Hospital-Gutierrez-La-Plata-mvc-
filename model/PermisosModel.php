<?php
	class PermisosModel extends ConexionDBModel
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

	    public function permisosDisponibles($action,$idUsuario)
	    {
	    	$result = $this->queryList("SELECT count(*) as result FROM  permiso p
										INNER JOIN rol_permiso r on p.id=r.id_permiso
										INNER JOIN usuario_rol u on u.id_rol=r.id_rol
										INNER JOIN usuario usu on u.id_usuario=usu.id
										WHERE nombre = ? AND usu.id=?;",[$action,$idUsuario]);	    	
	        $res = (int) $result[0]["result"];
	        return $res>0;
    	}

    	public  function existePermiso($action)
    	{
    		$result = $this->queryList("SELECT count(*) as result FROM  permiso
										WHERE nombre = ? ;",[$action]);
    		$res = (int) $result[0]["result"];
	        return $res>0;
    	}

	}
?>