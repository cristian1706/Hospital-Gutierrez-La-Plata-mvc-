<?php
class ListarUsuarioController 
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
    public function listarUsuario($pagina)
    {
        $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
        $infoGeneral = $infoGral[0];
        
            if (isset($_SESSION['idUsuario']))
            {
                $rol=$_SESSION['roles'];
                $user=$_SESSION['username'];
                $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
                $idUsuario=$_SESSION['idUsuario'];
                $paginacion=$infoGeneral['cant_elementos_pagina'];
                $paginasLista=ListarUsuarioController::getInstance()->paginar($paginacion, $pagina);  
                //Para moverse de pagina
                $mover=array();
                $mover['actual']=$pagina;
                $mover['final']=$paginasLista['nroPaginas']; 
                //control para no salirse de la primera pagina ni la ultima!
                if($pagina+1<$paginasLista['nroPaginas'])
                {
                    $mover['sig']=$pagina+1;
                }
                else
                {
                    $mover['sig']=$paginasLista['nroPaginas'];
                }
                if($pagina-1>1)
                {
                    $mover['ant']=$pagina-1;
                }
                else
                {
                    $mover['ant']=1;
                }
                if($paginasLista['nroPaginas']<$pagina)
                {
                    $pagina=$paginasLista['nroPaginas'];
                    $paginasLista=ListarUsuarioController::getInstance()->paginar($paginacion, $pagina);
                }
                $usuarioRol=array();
                foreach($paginasLista['usuarios'] as $usu){
                    $roles=ListarUsuarioModel::getInstance()->roles($usu['id']);
                    $usuarioRol[$usu['id']]=$roles;
                }
                
                $todosLosUsuarios = ListarUsuarioModel::getInstance()->listAll();
                $lista=array('paginas'=>  $paginasLista['paginasNro'],'listaPaginada'=> $paginasLista['usuarios']);
                ListarUsuarioView::getInstance()->show($lista,$mover,$user,$rol, $idUsuario,$usuarioRol);
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }
    }

    public function listarUsuarioExito($pagina,$mensajeExito)
    {
        $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
        $infoGeneral = $infoGral[0];
        
            if (isset($_SESSION['idUsuario']))
            {
                $rol=$_SESSION['roles'];
                $user=$_SESSION['username'];
                $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
                $idUsuario=$_SESSION['idUsuario'];
                $paginacion=$infoGeneral['cant_elementos_pagina'];
                $paginasLista=ListarUsuarioController::getInstance()->paginar($paginacion, $pagina);  
                //Para moverse de pagina
                $mover=array();
                $mover['actual']=$pagina;
                $mover['final']=$paginasLista['nroPaginas']; 
                //control para no salirse de la primera pagina ni la ultima!
                if($pagina+1<$paginasLista['nroPaginas'])
                {
                    $mover['sig']=$pagina+1;
                }
                else
                {
                    $mover['sig']=$paginasLista['nroPaginas'];
                }
                if($pagina-1>1)
                {
                    $mover['ant']=$pagina-1;
                }
                else
                {
                    $mover['ant']=1;
                }
                if($paginasLista['nroPaginas']<$pagina)
                {
                    $pagina=$paginasLista['nroPaginas'];
                    $paginasLista=ListarUsuarioController::getInstance()->paginar($paginacion, $pagina);
                }
                $usuarioRol=array();
                foreach($paginasLista['usuarios'] as $usu){
                    $roles=ListarUsuarioModel::getInstance()->roles($usu['id']);
                    $usuarioRol[$usu['id']]=$roles;
                }
                
                $todosLosUsuarios = ListarUsuarioModel::getInstance()->listAll();
                $lista=array('paginas'=>  $paginasLista['paginasNro'],'listaPaginada'=> $paginasLista['usuarios']);                            
                ListarUsuarioView::getInstance()->showExito($lista,$mover,$user,$rol, $idUsuario,$usuarioRol,$mensajeExito);
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }
    }    

    public function paginar($usuariosPorPagina,$paginaActual)
    {
        $paginasLista=array();//la funcion retorna este array
        if($paginaActual<1)
        {
            $paginaActual=1;
        }
        $offSet=($paginaActual-1)*$usuariosPorPagina;//FILA INICIAL!! PRIMER PACIENTE DE LA LISTA EN LA PAGINA
        $porPagina=(int)$usuariosPorPagina;
        $filasUsuarios=ListarUsuarioModel::getInstance()->usuariosPagina($offSet,$porPagina);
        $nroFilasTotal=ListarUsuarioModel::getInstance()->nroUsuarios();
        $nro_FilasTotal=$nroFilasTotal[0];
        $totalFilas=(int)$nro_FilasTotal['total'];
        //generar el href en un arreglo para poder ir de posicion en posicion
        $paginas=array();
        $nroPaginas=ceil($totalFilas/$usuariosPorPagina);//ceil redondea para arriba
        for($nro=1; $nro<=$nroPaginas;$nro++)
        {
            $paginas[$nro]='pag='.$nro;
        }
        
        $paginasLista['paginasNro']=$paginas;
        $paginasLista['usuarios']= $filasUsuarios;
        $paginasLista['nroPaginas']=$nroPaginas;

        return $paginasLista;
    }

}
?>