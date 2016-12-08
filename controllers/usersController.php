<?php
/**
 * Clase usuarios
 *
 * Para controlar la agregacion de usuarios, edicion, actualización y eliminación de usuarios. 
 */
cLass usersController extends AppsController
{
  /**
   * [__construct constructor de la clase]
   */
  public function __construct(){
    parent::__construct();
  }

  /**
   * [index Metodo para mostrar los usuarios]
   * @return [string] [datos de usuarios]
   */
  public function index(){
    $conditions = array("conditions"=>"users.type_id=types.id");
    $this->set("users", $this->users->find("users, types",  "all", $conditions));
    $this->set("usersCount", $this->users->find("users", "count"));
  }

  /**
   * [add Agregar nuevos usuarios]
   *
   * De igual forma verifica si es un administrador, en caso de que lo sea, le permite crear un usuario, de lo contrario no.
   */
  public function add(){
    if ($_SESSION["type_name"]=="Administrador") {
      if ($_POST) {
      include_once(ROOT."libs".DS."password.php");
      $pass = new password();
      $_POST["password"] = $pass->getPassword($_POST["password"]);
      if ($this->users->save("users", $_POST)) {
        $this->redirect(array("controller"=>"users"));
      }else{
        $this->redirect(array("controller"=>"users", "method"=>"add"));
      }
    }
      
      $this->set("types", $this->users->find("types"));
      $this->_view->setView("add");
    }else{
      $this->redirect(array("controller"=>"users"));
    }
  } 

  /*  SIRVE PARA AGREGAR USUARIOS SIN ESTAR LOGUADO.
  public function add(){
      if ($_POST) {
      include_once(ROOT."libs".DS."password.php");
      $pass = new password();
      $_POST["password"] = $pass->getPassword($_POST["password"]);
      if ($this->users->save("users", $_POST)) {
        $this->redirect(array("controller"=>"users"));
      }else{
        $this->redirect(array("controller"=>"users", "method"=>"add"));
      }
    }
      
      $this->set("types", $this->users->find("types"));
      $this->_view->setView("add");
  }*/

  /**
   * [edit Editar usuario]
   * @param  [int] $id [id del usuario]
   * @return [string]     [consulta]
   */
  public function edit($id){
      if ($id) {
        $options = array(
          "conditions" => "id=".$id
        );
        $user = $this->users->find("users","first", $options);
        $this->set("user", $user);
          $this->set("types", $this->users->find("types"));
      }

      if($_POST){
        if(!empty($_POST["newPassword"])){
            $pass = new password();
            $_POST["password"] = $pass->getPassword($_POST["newPassword"]);
        }
        if ($this->users->update("users", $_POST)){
          $this->redirect(
            array(
              "controller"=>"users"
            ));
        }else{
          $this->redirect(
            array(
              "controller"=>"users",
              "method"=>"edit/".$_POST["id"]
            )
          );
        }
      }
  }
    /**
     * [delete Eliminar registro de usuario]
     * @param  [int] $id [id del usuario]
     */
    public function delete($id){
        $conditions = "id=".$id;
      if(  $this->users->delete("users",$conditions)){
          $this->redirect(array("controller"=>"users"));
      }else{
          $this->redirect(array("controller"=>"users","method"=>"add"));
      }
    }
    
    /**
     * [login Acceso de usuarios]
     * @return [string] [falso o cierto para acceder a la aplicación]
     */
    public function login(){
    $this->_view->setLayout("login");
        
        if($_POST){
            
        $pass= new Password();
        $auth= new Authorization();
        $filter= new Validations();
        
        $username = $filter->sanitizeText($_POST["username"]);
        $password = $filter->sanitizeText($_POST["password"]);
        
        $options = array(
          "field" => 
            "users.id as user_id,
            users.password as password,
            users.username as username, 
            types.name as type_name",
            "conditions"=>"username='$username' and users.type_id=types.id"
          );
        $user= $this->users->find("users, types", "first", $options);
        if($pass->isValid($password, $user["password"])){
            $auth->login($user);
            $this->redirect(array("controller"=>"pages"));
        }else{
            echo "Usuario no valido";
        }
        }
    }

    /**
     * [logout Función para cerar sesión]
     */
    public function logout(){
      $auth = new Authorization();
      $auth->logout();
      $this->_view->render("login");
    }
}
