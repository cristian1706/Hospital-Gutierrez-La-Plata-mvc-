<?php
session_start();
Class ModificarUsuarioController 
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
	public function modificarUsuario($idUsuario)
	{

		if (isset($_SESSION['idUsuario']))
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') 
			{	
				if (isset($_POST['nombre']) and isset($_POST['apellido']) and isset($_POST['usuario']) and isset($_POST['clave']) and isset($_POST['email']) and isset($_POST['id']) and isset($_POST['rol'])) {

					if (strlen(str_replace(' ','',$_POST['nombre']))!=0 and
						strlen(str_replace(' ','',$_POST['apellido']))!=0 and
						strlen(str_replace(' ','',$_POST['usuario']))!=0 and
						strlen(str_replace(' ','',$_POST['clave']))!=0 and
						strlen(str_replace(' ','',$_POST['email']))!=0 and		            	
						strlen(str_replace(' ','',$_POST['id'])))
					{
						$idUsuario = ValidarDatosController::getInstance()->validarDatos($_POST['id']);
						$email = ValidarDatosController::getInstance()->validarDatos($_POST['email']);
						$usuario = ValidarDatosController::getInstance()->validarDatos($_POST['usuario']);
						$clave = ValidarDatosController::getInstance()->validarDatos($_POST['clave']);
						$nombre = ValidarDatosController::getInstance()->validarDatos($_POST['nombre']);
						$apellido = ValidarDatosController::getInstance()->validarDatos($_POST['apellido']);
						$updated_at = date("Y-m-d H:i:s");

						$arregloDeRoles = array();
						$arregloDeRoles = $_POST['rol'];

						$check_username = ModificarUsuarioModel::getInstance()->check_username($usuario,$idUsuario);
						$check_email = ModificarUsuarioModel::getInstance()->check_email($email,$idUsuario);
						$check_username_cant = $check_username[0];
						$check_email_cant = $check_email[0];
						if ($check_email_cant['cant'] < 1)
						{
							if ($check_username_cant['cant'] < 1)
							{	
								ModificarUsuarioModel::getInstance()->modificar($email,$usuario,$clave,$nombre,$apellido,$updated_at);

								$cant_array=count($arregloDeRoles);
							//$rolesConsulta = ModificarUsuarioModel::getInstance()->getRoles($idUsuario);
							//$cant_roles_consulta = count($rolesConsulta);
							//if (($cant_array != $cant_roles_consulta) and ()) {
								ModificarUsuarioModel::getInstance()->borrarRoles($idUsuario);
							//}
								for ($i=0; $i<$cant_array; $i++){

									$rol = $arregloDeRoles[$i];
									if ($rol == 'administrador'){
										$id_rol = 1;
									}
									else{
										if ($rol == 'pediatra'){
											$id_rol = 2;
										}
										else{
											if ($rol == 'recepcionista'){
												$id_rol = 3;
											}
										}

									}
									ModificarUsuarioModel::getInstance()->usuarioRol($idUsuario,$id_rol);
								}

								if ($_SESSION['idUsuario'] == $idUsuario) 
								{
									$_SESSION['username']=$usuario;
									$_SESSION['roles'] = $arregloDeRoles;
								}
								$mensajeExito = "El usuario ha sido modificado exitosamente";
								ListarUsuarioController::getInstance()->listarUsuarioExito(1,$mensajeExito);
							}
							else
							{							
								$mensajeError= "El nombre de usuario que quiere modificar ya existe, pruebe con otro";
									$id=$_SESSION['idUsuario']; //este es el id del que esta logueado
									$result = ModificarUsuarioModel::getInstance()->datosUsuario($idUsuario); //id para encontrar al usuario que quiero modificar, esta en el for de twig en el template listarUsuarios.html
									$usuario=$result[0];
									$roll=$_SESSION['roles'];
									$user=$_SESSION['username'];
									$rolesConsulta = ModificarUsuarioModel::getInstance()->getRoles($idUsuario);
									$roles = array();
									foreach ($rolesConsulta as $rol) {
										$roles[]=$rol['id_rol'];
									}
									ModificarUsuarioView::getInstance()->show($usuario,$user,$roll,$id,$mensajeError,$roles);
								}
							}
							else
							{							
								$mensajeError= "El email que quiere modificar ya existe, pruebe con otro";
								$id=$_SESSION['idUsuario']; //este es el id del que esta logueado
								$result = ModificarUsuarioModel::getInstance()->datosUsuario($idUsuario); //id para encontrar al usuario que quiero modificar, esta en el for de twig en el template listarUsuarios.html
								$usuario=$result[0];
								$roll=$_SESSION['roles'];
								$user=$_SESSION['username'];
								$rolesConsulta = ModificarUsuarioModel::getInstance()->getRoles($idUsuario);
								$roles = array();
								foreach ($rolesConsulta as $rol) {
									$roles[]=$rol['id_rol'];
								}
								ModificarUsuarioView::getInstance()->show($usuario,$user,$roll,$id,$mensajeError,$roles);
							}
						}
						else
						{	                    
							$mensajeError= "No se puede modificar el usuario si deja campos vacíos";
							$id=$_SESSION['idUsuario']; //este es el id del que esta logueado
							$idUsuario = $_POST['id'];						
							$result = ModificarUsuarioModel::getInstance()->datosUsuario($idUsuario); //id para encontrar al usuario que quiero modificar, esta en el for de twig en el template listarUsuarios.html
							$usuario=$result[0];
							$roll=$_SESSION['roles'];
							$user=$_SESSION['username'];
							$rolesConsulta = ModificarUsuarioModel::getInstance()->getRoles($idUsuario);
							$roles = array();
							foreach ($rolesConsulta as $rol) {
								$roles[]=$rol['id_rol'];
							}
							ModificarUsuarioView::getInstance()->show($usuario,$user,$roll,$id,$mensajeError,$roles);
						}
						
					}
					else {
						$mensajeError= "Por favor no elimine campos del formulario";
							$id=$_SESSION['idUsuario']; //este es el id del que esta logueado
							$idUsuario = $_POST['id'];						
							$result = ModificarUsuarioModel::getInstance()->datosUsuario($idUsuario); //id para encontrar al usuario que quiero modificar, esta en el for de twig en el template listarUsuarios.html
							$usuario=$result[0];
							$roll=$_SESSION['roles'];
							$user=$_SESSION['username'];
							$rolesConsulta = ModificarUsuarioModel::getInstance()->getRoles($idUsuario);
							$roles = array();
							foreach ($rolesConsulta as $rol) {
								$roles[]=$rol['id_rol'];
							}
							ModificarUsuarioView::getInstance()->show($usuario,$user,$roll,$id,$mensajeError,$roles);
						}
					}
					else 		
					{
						$mensajeError= "";
						$id=$_SESSION['idUsuario']; //este es el id del que esta logueado
						$result = ModificarUsuarioModel::getInstance()->datosUsuario($idUsuario); //id para encontrar al usuario que quiero modificar, esta en el for de twig en el template listarUsuarios.html
						$rolesConsulta = ModificarUsuarioModel::getInstance()->getRoles($idUsuario);
						$roles = array();
						foreach ($rolesConsulta as $rol) {
							$roles[]=$rol['id_rol'];
						}
						$usuario=$result[0];
						$rol=$_SESSION['roles'];
						$user=$_SESSION['username'];
						ModificarUsuarioView::getInstance()->show($usuario,$user,$rol,$id,$mensajeError,$roles);
					}
				}
				else
				{
					$mensajeError = "";
					LoginView::getInstance()->show($mensajeError);
				}

			}
	    // si hay algo pasado por post si loa datos pasados son correctos hace la consulta sino muestra el formulario
		}

		?>