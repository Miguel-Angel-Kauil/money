<?php
/**
 * Clase Bootstrap
 *
 * Para el manejo de las vistas
 */
cLass Bootstrap
{
  /**
   * [run Para manejar los diferentes controladores y vistas]
   * @param  request $p [recibe controlador]
   * @return [type]     [cadena de texto o string]
   */
  public static function run(request $p){
    $controllerName = $p->getController()."controller";
    $routeController = ROOT."controllers".DS.$controllerName.".php";
    $method = $p->getMethod();
    $args = $p->getArgs();

    if (is_readable($routeController)) {
      include_once($routeController);
      $controller = new $controllerName;

      if (is_callable(array($controller,$method))) {
        $method = $p->getMethod();
      }else {
        $method = "index";
      }

        if($method=="login"){
            
        }else{
           Authorization::logged();
        }

      if (isset($args)) {
        call_user_func_array(array($controller, $method), $args);
      }else {
        call_user_func(array($controller, $method));
      }
    }else {
      throw new Exception("Controlador no encontrado");
    }
  }
}
