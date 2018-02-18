<?php

class ConfiguracionAdminController
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

    public function configurar()
    {

        $infoIndex = ConfiguracionAdminModel::getInstance()->getConfiguracionInicial();
        $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
        $infoGeneral = $infoGral[0];
        if (isset($_SESSION['idUsuario'])){

            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if (isset($_POST['titulo1']) and isset($_POST['descripcion1']) and isset($_POST['mail_contacto1']) and isset($_POST['id1']) and isset($_POST['titulo2']) and isset($_POST['descripcion2']) and isset($_POST['mail_contacto2']) and isset($_POST['id2']) and isset($_POST['titulo3']) and isset($_POST['descripcion3']) and isset($_POST['mail_contacto3']) and isset($_POST['id3'])) {
                    if (strlen(str_replace(' ','',$_POST['titulo1']))!=0 and
                        strlen(str_replace(' ','',$_POST['descripcion1']))!=0 and
                        strlen(str_replace(' ','',$_POST['mail_contacto1']))!=0 and
                        strlen(str_replace(' ','',$_POST['id1']))!=0 and
                        strlen(str_replace(' ','',$_POST['titulo2']))!=0 and
                        strlen(str_replace(' ','',$_POST['descripcion2']))!=0 and
                        strlen(str_replace(' ','',$_POST['mail_contacto2']))!=0 and
                        strlen(str_replace(' ','',$_POST['id2']))!=0 and
                        strlen(str_replace(' ','',$_POST['titulo3']))!=0 and
                        strlen(str_replace(' ','',$_POST['descripcion3']))!=0 and
                        strlen(str_replace(' ','',$_POST['mail_contacto3']))!=0 and
                        strlen(str_replace(' ','',$_POST['id3']))!= 0)
                    {
                        $panel1=array('titulo' => $_POST['titulo1'], 'descripcion' => $_POST['descripcion1'], 'mail_contacto' => $_POST['mail_contacto1'], 'id' => $_POST['id1']);
                        $panel2=array('titulo' => $_POST['titulo2'], 'descripcion' => $_POST['descripcion2'], 'mail_contacto' => $_POST['mail_contacto2'], 'id' => $_POST['id2']);
                        $panel3=array('titulo' => $_POST['titulo3'], 'descripcion' => $_POST['descripcion3'], 'mail_contacto' => $_POST['mail_contacto3'], 'id' => $_POST['id3']);
                        //$cant_elementos_pagina = htmlentities($_POST['cant_elementos_pagina']);
                        //$sitio_habilitado = htmlentities($_POST['sitio_habilitado']);
                        $cant_elementos_pagina = ValidarDatosController::getInstance()->validarDatos($_POST['cant_elementos_pagina']);
                        $sitio_habilitado = ValidarDatosController::getInstance()->validarDatos($_POST['sitio_habilitado']);
                        ConfiguracionAdminModel::getInstance()->modificarConfiguracionInicial($panel1,$panel2,$panel3);
                        ConfiguracionAdminModel::getInstance()->modificarConfiguracionGeneral($cant_elementos_pagina,$sitio_habilitado);
                        $infoIndex = ConfiguracionAdminModel::getInstance()->getConfiguracionInicial();
                        $infoGral = ConfiguracionAdminModel::getInstance()->getConfiguracionGeneral();
                        $infoGeneral = $infoGral[0];
                        $mensajeError = "";
                        $configuracion_inicial = $infoIndex;
                        $configuracion_general = $infoGeneral;
                        $rol=$_SESSION['roles'];
                        $user=$_SESSION['username'];
                        $idUsuario=$_SESSION['idUsuario'];
                        ConfiguracionAdminView::getInstance()->show($configuracion_inicial,$configuracion_general,$user,$rol,$idUsuario,$mensajeError);
                    }
                    else
                    {
                        $mensajeError = "No se puede modificar la configuración si deja campos vacíos";
                        $configuracion_inicial = $infoIndex;
                        $configuracion_general = $infoGeneral;
                        $rol=$_SESSION['roles'];
                        $user=$_SESSION['username'];
                        $idUsuario=$_SESSION['idUsuario'];
                        ConfiguracionAdminView::getInstance()->show($configuracion_inicial,$configuracion_general,$user,$rol,$idUsuario,$mensajeError);
                    }
                }
                else {
                    $mensajeError = "Por favor no elimine campos del formulario";
                    $configuracion_inicial = $infoIndex;
                    $configuracion_general = $infoGeneral;
                    $rol=$_SESSION['roles'];
                    $user=$_SESSION['username'];
                    $idUsuario=$_SESSION['idUsuario'];
                    ConfiguracionAdminView::getInstance()->show($configuracion_inicial,$configuracion_general,$user,$rol,$idUsuario,$mensajeError);
                }
            }
            else
            {
                $mensajeError = "";
                $configuracion_inicial = $infoIndex;
                $configuracion_general = $infoGeneral;
                $rol=$_SESSION['roles'];
                $user=$_SESSION['username'];
                $idUsuario=$_SESSION['idUsuario'];
                ConfiguracionAdminView::getInstance()->show($configuracion_inicial,$configuracion_general,$user,$rol,$idUsuario,$mensajeError);
            }
                /*
                else{
                    LoginController::getInstance()->index();
                }*/
            }
            else
            {
                $mensajeError = "";
                LoginView::getInstance()->show($mensajeError);
            }
        }

    }

    ?>