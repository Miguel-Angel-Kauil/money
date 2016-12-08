<?php
/**
 * clase para la autorizaon de inicio de secion
 */
class Authorization
{
	/**
	 * Funcion para desloguearse
	 */

	static function logged(){
		session_start();
		if (!$_SESSION["logged"]) {
			header("Location: ".APP_URL."/users/login");
			exit;
		}
	}
/**
 * [login inicio de sesion]
 * @param  [type] $user [variable que es de mi usuario]
 * @return [type]       [description]
 */
	public function login($user){
		session_start();
		$_SESSION["logged"] = true;
		$_SESSION["username"] = $user["username"]; 
		$_SESSION["type_name"] = $user["type_name"];
		$_SESSION["start"] = time(); 
		$_SESSION["expire"] = $_SESSION["start"] + (5 * 60); 
	}
/**
 * [logout al salir indicar que vista quiero que muestre]
 * @return [type] [description]
 */
	public function logout(){
		session_unset();

		session_destroy();

		echo "
			<script type='text/javascript'>
			alert('Ha salido correctamente');
			window.location='http://localhost/money/users/login';
			</script>
		";
	}
}