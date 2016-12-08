<?php
/**
 * Clase para controlar principal
 */
abstract class AppsController
{
	protected $_view;

	abstract public function index();
/**
 * [__construct constructor de la clase]
 */
	public function __construct(){
		$this->_view = new View(new request);
		$controller = new request();
		$className = $controller->getController();
		$this->$className = new classPDO();
	}
/**
 * [la funcion para las URL]
 * @param  array  $url [estara redireccionando al controlador]
 * @return [type]      [description]
 */
	public function redirect($url= array())
	{
		$path = "";

		if ($url["controller"]) {
			$path .= $url["controller"];
		}
		if ($url["method"]) {
			$path .= "/".$url["method"];
		}
		header("LOCATION: ".APP_URL."/".$path);
	}
/**
 * [los arrays que estara conbiando]
 * @param [type] $one [el primero]
 * @param [type] $two [el segundo]
 */
	public function set($one, $two=null){
		if (is_array($one)) {
				if (is_array($two)) {
					$data = array_combine($one, $two);
			}else {
					$data = $one;
					}
			}else {
				$data = array($one=> $two);
				}
				$this->_view->setVars($data);
	}
}
