
  <?php
class ListarUsuarioBusquedaController 
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

                if ($_SERVER['REQUEST_METHOD'] === 'POST') 
                {//la busqueda es opcional no necesita si o si ser por algo
                        $titulo=htmlentities($_POST['titulo']);
                        $activo=htmlentities($_POST['estado']);
                        $_SESSION['titulo']= $titulo;
                        $_SESSION['activo']= $activo;
                        $paginasLista=ListarUsuarioBusquedaController::getInstance()->paginarBusqueda($paginacion, $pagina,$titulo,$activo);
                }
                else
                {
                    $activo=(isset($_SESSION['activo']))?$_SESSION['activo']:1;                   
                    $tit=(isset($_SESSION['titulo']))?$_SESSION['titulo']:'';   
                    $paginasLista=ListarUsuarioBusquedaController::getInstance()->paginarBusqueda($paginacion, $pagina,$tit,$activo);
                } 
                //para moverse de pagina
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
                    $activo=(isset($_SESSION['estado']))?$_SESSION['estado']:1;
                    $tit=(isset($_SESSION['titulo']))?$_SESSION['titulo']:'';   
                    $paginasLista=ListarUsuarioBusquedaController::getInstance()->paginarBusqueda($paginacion, $pagina,$tit,$activo);
                }
                $usuarioRol=array();
                foreach($paginasLista['usuarios'] as $usu){
                    $roles=ListarUsuarioModel::getInstance()->roles($usu['id']);
                    $usuarioRol[$usu['id']]=$roles;
                }
                $activo=(isset($_SESSION['estado']))?$_SESSION['estado']:1;
                $lista=array('paginas'=>  $paginasLista['paginasNro'],'listaPaginada'=> $paginasLista['usuarios'],'estado'=>$activo);
                ListarUsuarioView::getInstance()->showBusqueda($lista,$mover,$user,$rol, $idUsuario,$usuarioRol);
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }
    }
    public function paginarBusqueda($usuariosPorPagina,$paginaActual,$titulo,$activo)
    {
        
        $paginasLista=array();//la funcion retorna este array
        if($paginaActual<1)
        {
            $paginaActual=1;
        }
        $offSet=($paginaActual-1)*$usuariosPorPagina;//FILA INICIAL!! PRIMER PACIENTE DE LA LISTA EN LA PAGINA
        $porPagina=(int)$usuariosPorPagina;
        $tit="%$titulo%";
        $filasUsuarios=ListarUsuarioModel::getInstance()->usuariosPaginaBusqueda($offSet,$porPagina,$tit,$activo);
        $nroFilasTotal=ListarUsuarioModel::getInstance()->nroUsuariosBusqueda($tit,$activo);
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