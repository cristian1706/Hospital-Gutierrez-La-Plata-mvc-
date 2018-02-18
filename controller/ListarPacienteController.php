<?php
class ListarPacienteController 
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
    public function listarPaciente($pagina)
    {        
        $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
        $infoGeneral = $infoGral[0];
            
            if (isset($_SESSION['idUsuario']))
            {
                $rol=$_SESSION['roles'];
                $user=$_SESSION['username'];
                $id=$_SESSION['idUsuario'];
                $paginacion=$infoGeneral['cant_elementos_pagina'];
                $paginasLista=ListarPacienteController::getInstance()->paginar($paginacion, $pagina);
                //Para moverse de página
                $mover=array();
                $mover['actual']=$pagina;
                $mover['final']=$paginasLista['nroPaginas'];
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
                //control para no salirse de la primera pagina ni la ultima!
                if($paginasLista['nroPaginas']<$pagina)
                {
                    $pagina=$paginasLista['nroPaginas'];
                    $paginasLista=ListarPacienteController::getInstance()->paginar($paginacion, $pagina);
                }
                $lista=array('paginas'=>  $paginasLista['paginasNro'],'listaPaginada'=> $paginasLista['pacientes']);
                ListarPacienteView::getInstance()->show($lista,$mover,$user,$rol,$id);
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }              
    }

    public function paginar($pacientesPorPagina,$paginaActual)
    {
        
        $paginasLista=array();//la funcion retorna este array
        if($paginaActual<1)
        {
            $paginaActual=1;
        }
        $offSet=($paginaActual-1)*$pacientesPorPagina;//FILA INICIAL!! PRIMER PACIENTE DE LA LISTA EN LA PAGINA
        $porPagina=(int)$pacientesPorPagina;
        $filasPacientes=ListarPacienteModel::getInstance()->pacientesPagina($offSet,$porPagina);
        $nroFilasTotal=ListarPacienteModel::getInstance()->nroPacientes();
        $nro_FilasTotal=$nroFilasTotal[0];
        $totalFilas=(int)$nro_FilasTotal['total'];
        //generar el href en un arreglo para poder ir de posicion en posicion
        $paginas=array();
        $nroPaginas=ceil($totalFilas/$pacientesPorPagina);//ceil redondea para arriba
        for($nro=1; $nro<=$nroPaginas;$nro++)
        {
            $paginas[$nro]='pag='.$nro;
        }
        
        $paginasLista['paginasNro']=$paginas;
        $paginasLista['pacientes']= $filasPacientes;
        $paginasLista['nroPaginas']=$nroPaginas;
        

        return $paginasLista;
    }
}
?>