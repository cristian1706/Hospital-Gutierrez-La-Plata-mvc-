<?php  
class RegistrarPacienteController
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
    public function registrarPaciente()
    {

        if (isset($_SESSION['idUsuario']))
        {
            $rol=$_SESSION['roles'];
            $user=$_SESSION['username'];

            $viviendas=DatosDemograficosModel::getInstance()->tiposVivienda();
            $aguas=DatosDemograficosModel::getInstance()->tiposAgua();
            $calefacciones=DatosDemograficosModel::getInstance()->tiposCalefaccion();
            $obrasSociales=DatosDemograficosModel::getInstance()->tiposObraSocial();
            $documentos=DatosDemograficosModel::getInstance()->tiposDocumento();



            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                if (isset($_POST['nombre']) and isset($_POST['apellido']) and isset($_POST['genero']) and isset($_POST['tipoDocumento']) and isset($_POST['numeroDocumento']) and isset($_POST['domicilio']) and isset($_POST['telefono']) and isset($_POST['obraSocial']) and isset($_POST['fechaDeNacimiento']) and isset($_POST['vivienda']) and isset($_POST['agua']) and isset($_POST['calefaccion']) and isset($_POST['heladera']) and isset($_POST['electricidad']) and isset($_POST['mascota'])) {
                    if (strlen(str_replace(' ','',$_POST['nombre']))!=0 and
                        strlen(str_replace(' ','',$_POST['apellido']))!=0 and
                        strlen(str_replace(' ','',$_POST['genero']))!=0 and
                        strlen(str_replace(' ','',$_POST['tipoDocumento']))!=0 and
                        strlen(str_replace(' ','',$_POST['numeroDocumento']))!=0 and
                        strlen(str_replace(' ','',$_POST['domicilio']))!=0 and
                        strlen(str_replace(' ','',$_POST['telefono']))!=0 and
                        strlen(str_replace(' ','',$_POST['obraSocial']))!=0 and
                        strlen(str_replace(' ','',$_POST['fechaDeNacimiento']))!=0 and
                        strlen(str_replace(' ','',$_POST['vivienda']))!=0 and
                        strlen(str_replace(' ','',$_POST['agua']))!=0 and
                        strlen(str_replace(' ','',$_POST['calefaccion']))!=0 and
                        strlen(str_replace(' ','',$_POST['heladera']))!=0 and
                        strlen(str_replace(' ','',$_POST['electricidad']))!=0 and
                        strlen(str_replace(' ','',$_POST['mascota']))!= 0)
                    {
                        $nombre = htmlentities($_POST['nombre']);
                        $apellido = htmlentities($_POST['apellido']);                    
                        $genero =htmlentities ($_POST['genero']);
                        $tipoDocumento =htmlentities ($_POST['tipoDocumento']);
                        $documento =htmlentities ($_POST['numeroDocumento']);
                        $domicilio = htmlentities($_POST['domicilio']);
                        $telefono =htmlentities($_POST['telefono']);
                        $obraSocial = htmlentities($_POST['obraSocial']);
                            // ACÁ HAGO LA CONVERSIÓN DE LA FECHA CAMBIANDO EL FORMATO DE PRESENTACIÓN
                        $fecha = htmlentities($_POST['fechaDeNacimiento']);
                        $fechaDeNacimiento=new DateTime(str_replace('/', '-', $fecha));
                        $fechaDeNacimiento= $fechaDeNacimiento->format('Y-m-d');                                            
                            //DATOS DEMOGRÁFICOS
                        $vivienda= htmlentities($_POST['vivienda']); 
                        //var_dump($vivienda);die();
                        $agua = htmlentities($_POST['agua']);
                        $calefaccion = htmlentities($_POST['calefaccion']);
                        $heladera= htmlentities($_POST['heladera']);
                        $electricidad = htmlentities($_POST['electricidad']);
                        $mascota= htmlentities($_POST['mascota']); 
                        $check_documento = RegistrarPacienteModel::getInstance()->check_documento($documento);
                        $check_documento_cant = $check_documento[0];
                        if ($check_documento_cant['cant'] < 1)
                        {                  
                            $answer=RegistrarPacienteModel::getInstance()->agregarPaciente($nombre,$apellido,$fechaDeNacimiento,$genero,$tipoDocumento,$documento,$domicilio,$telefono,$obraSocial);
                            $paciente=$answer[0];
                            DatosDemograficosModel::getInstance()->agregar($vivienda,$agua,$calefaccion,$heladera,$electricidad,$mascota, $paciente['id']);
                            $datosPaciente = ModificarPacienteModel::getInstance()->datosPacienteByDni($documento);
                            $paciente = $datosPaciente[0];
                            $idPaciente = $paciente['id'];
                            VerPacienteController::getInstance()->verPaciente($idPaciente);
                        }
                        else 
                        {                            
                            $mensajeError= "El DNI ya esta en uso, pruebe con otro";
                            $idUsuario = $_SESSION['idUsuario'];
                            RegistrarPacienteView::getInstance()->show($user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos);
                        } 
                    }
                    else 
                    {                        
                        $mensajeError= "No se puede registrar el paciente si deja campos vacíos";
                        $idUsuario = $_SESSION['idUsuario'];
                        RegistrarPacienteView::getInstance()->show($user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos);
                    }
                }
                else{
                    $mensajeError= "Por favor no elimine campos del formulario";
                    $idUsuario = $_SESSION['idUsuario'];
                    RegistrarPacienteView::getInstance()->show($user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos);
                }
            }
            else
            {
                $mensajeError= "";
                $idUsuario = $_SESSION['idUsuario'];
                RegistrarPacienteView::getInstance()->show($user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos);                            
            }
        }
        else
        {
            $mensajeError = "";
            LoginView::getInstance()->show($mensajeError);
        }
    }
}








?>