<?php
    Class ModificarPacienteController
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
        public function modificarPaciente($idPaciente)

        {
            $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
            $infoGeneral = $infoGral[0];
            
                if (isset($_SESSION['idUsuario']))
                {

                $viviendas=DatosDemograficosModel::getInstance()->tiposVivienda();
                $aguas=DatosDemograficosModel::getInstance()->tiposAgua();
                $calefacciones=DatosDemograficosModel::getInstance()->tiposCalefaccion();
                $obrasSociales=DatosDemograficosModel::getInstance()->tiposObraSocial();
                $documentos=DatosDemograficosModel::getInstance()->tiposDocumento();


                    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
                    {                
                        if (strlen(str_replace(' ','',$_POST['id']))!=0 and
                            strlen(str_replace(' ','',$_POST['nombre']))!=0 and
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
                            $idPaciente= htmlentities($_POST['id']);
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
                            // DATOS DEMOGRÁFICOS
                            $heladera =htmlentities($_POST['heladera']);
                            $electricidad = htmlentities($_POST['electricidad']);
                            $mascota = htmlentities($_POST['mascota']);
                            $calefaccion = htmlentities($_POST['calefaccion']);
                            $vivienda = htmlentities($_POST['vivienda']);
                            $agua = htmlentities($_POST['agua']);
                            $check_documento = ModificarPacienteModel::getInstance()->check_documento($documento,$idPaciente);
                            $check_documento_cant = $check_documento[0];                        
                            if ($check_documento_cant['cant'] < 1)
                            {
                                ModificarPacienteModel::getInstance()->modificar($nombre,$apellido,$fechaDeNacimiento,$genero,$tipoDocumento,$documento,$domicilio,$telefono,$obraSocial,$idPaciente);
                                DatosDemograficosModel::getInstance()->modificar($heladera,$electricidad,$mascota,$calefaccion,$vivienda,$agua,$idPaciente);
                                VerPacienteController::getInstance()->verPaciente($idPaciente);
                            }
                            else
                            {                            
                                $mensajeError= "El DNI que quiere modificar ya está en uso, pruebe con otro";
                                $user=$_SESSION['username'];
                                $rol=$_SESSION['roles'];
                                $idUsuario=$_SESSION['idUsuario'];
                                $result = ModificarPacienteModel::getInstance()->datosPaciente($idPaciente);
                                $paciente=$result[0];                
                                $result = DatosDemograficosModel::getInstance()->datosDemograficos($idPaciente);
                                $datosDemograficos = $result[0];                
                                ModificarPacienteView::getInstance()->show($paciente,$datosDemograficos,$user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos);
                            }
                        }
                        else
                        {                        
                            $mensajeError= "No se puede modificar el paciente si deja campos vacíos";
                            $user=$_SESSION['username'];
                            $rol=$_SESSION['roles'];
                            $idUsuario=$_SESSION['idUsuario'];
                            $idPaciente = $_POST['id'];
                            $result = ModificarPacienteModel::getInstance()->datosPaciente($idPaciente);
                            $paciente=$result[0];                
                            $result = DatosDemograficosModel::getInstance()->datosDemograficos($idPaciente);
                            $datosDemograficos = $result[0];                
                            ModificarPacienteView::getInstance()->show($paciente,$datosDemograficos,$user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos);
                        }
                    }
                    else
                    {
                        $mensajeError= "";
                        $user=$_SESSION['username'];
                        $rol=$_SESSION['roles'];
                        $idUsuario=$_SESSION['idUsuario'];
                        $result = ModificarPacienteModel::getInstance()->datosPaciente($idPaciente);
                        $paciente=$result[0];                
                        $result = DatosDemograficosModel::getInstance()->datosDemograficos($idPaciente);
                        $datosDemograficos = $result[0];                
                        ModificarPacienteView::getInstance()->show($paciente,$datosDemograficos,$user,$rol,$idUsuario,$mensajeError,$viviendas,$aguas,$calefacciones,$obrasSociales,$documentos);
                    }
                }
                else
                {
                    $mensajeError = "";
                    LoginView::getInstance()->show($mensajeError);
                }
        }// si hay algo pasado por post si loa datos pasados son correctos hace la consulta sino muestra el formulario
    }
?>