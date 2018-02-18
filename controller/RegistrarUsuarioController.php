<?php  
class RegistrarUsuarioController 
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
	public function registrarUsuario()
	{
		if (isset($_SESSION['idUsuario']))
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') 
			{
				if (isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email'])) {       
					
					if (strlen(str_replace(' ','',$_POST['first_name']))!=0 and
						strlen(str_replace(' ','',$_POST['last_name']))!=0 and
						strlen(str_replace(' ','',$_POST['username']))!=0 and
						strlen(str_replace(' ','',$_POST['password']))!=0 and
						strlen(str_replace(' ','',$_POST['email']))!=0 and isset($_POST['rol']))
					{	            	
						$first_name = ValidarDatosController::getInstance()->validarDatos($_POST['first_name']);
						$last_name = ValidarDatosController::getInstance()->validarDatos($_POST['last_name']);
						$username = ValidarDatosController::getInstance()->validarDatos($_POST['username']);
						$password = ValidarDatosController::getInstance()->validarDatos($_POST['password']);
						$email = ValidarDatosController::getInstance()->validarDatos($_POST['email']);
						$created_at = date("Y-m-d H:i:s");
						$updated_at = date("Y-m-d H:i:s");
						
						$arregloDeRoles = array();
						$arregloDeRoles = $_POST['rol'];

						$check_username = RegistrarUsuarioModel::getInstance()->check_username($username);
						$check_email = RegistrarUsuarioModel::getInstance()->check_email($email);
						$check_username_cant = $check_username[0];
						$check_email_cant = $check_email[0];
						if ($check_email_cant['cant'] < 1)
						{
							if ($check_username_cant['cant'] < 1)
							{ 
								$answer=RegistrarUsuarioModel::getInstance()->agregarUsuario($first_name, $last_name, $username, $password, $email, $created_at, $updated_at);	               
								$user=$answer[0];
								$idUsuario=$user['id'];
								$cant_array=count($arregloDeRoles);
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
									
									RegistrarUsuarioModel::getInstance()->usuarioRol($idUsuario,$id_rol);
								}
								$mensajeExito = "El usuario ha sido registrado exitosamente";
								ListarUsuarioController::getInstance()->listarUsuarioExito(1,$mensajeExito);
							}
							else
							{
								$mensajeError="El nombre de usuario que quiere registrar ya esta en uso, pruebe con otro";
								$user=$_SESSION['username'];
								$rol=$_SESSION['roles'];
								$idUsuario=$_SESSION['idUsuario'];
								$roles=RegistrarUsuarioModel::getInstance()->roles();
								RegistrarUsuarioView::getInstance()->show($user,$rol,$roles,$idUsuario,$mensajeError);
							}
						}
						else
						{
							$mensajeError="El mail que quiere registrar ya esta en uso, pruebe con otro";
							$user=$_SESSION['username'];
							$rol=$_SESSION['roles'];
							$idUsuario=$_SESSION['idUsuario'];
							$roles=RegistrarUsuarioModel::getInstance()->roles();
							RegistrarUsuarioView::getInstance()->show($user,$rol,$roles,$idUsuario,$mensajeError);
						}             
					}
					else
					{
						$mensajeError="No se puede registrar si deja campos vacíos";
						$user=$_SESSION['username'];
						$rol=$_SESSION['roles'];
						$idUsuario=$_SESSION['idUsuario'];
						$roles=RegistrarUsuarioModel::getInstance()->roles();
						RegistrarUsuarioView::getInstance()->show($user,$rol,$roles,$idUsuario,$mensajeError);
					}
				}
				else {
					$mensajeError="Por favor no elimine campos del formulario";
					$user=$_SESSION['username'];
					$rol=$_SESSION['roles'];
					$idUsuario=$_SESSION['idUsuario'];
					$roles=RegistrarUsuarioModel::getInstance()->roles();
					RegistrarUsuarioView::getInstance()->show($user,$rol,$roles,$idUsuario,$mensajeError);
				}
			}
			else 
			{
				$mensajeError= "";
				$user=$_SESSION['username'];
				$rol=$_SESSION['roles'];
				$idUsuario=$_SESSION['idUsuario'];
				$roles=RegistrarUsuarioModel::getInstance()->roles();
				RegistrarUsuarioView::getInstance()->show($user,$rol,$roles,$idUsuario,$mensajeError);
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