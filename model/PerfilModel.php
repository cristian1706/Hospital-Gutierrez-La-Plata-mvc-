<?php
 
class PerfilModel extends ConexionDBModel
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

    public function usuario($id) 
    {
        $answer = $this->queryList("SELECT * FROM usuario WHERE id=?;", [$id]);
        return $answer;
    }
}
?>