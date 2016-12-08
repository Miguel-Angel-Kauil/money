<?php
/**
 * Clase para las cuentas
 *
 * Para controlar la agregacion de tipos de cuentas, edición, actualización y eliminación.
 */
cLass accountsController extends AppsController
{
  /**
   * [__construct constructor de la clase]
   */
  public function __construct(){
    parent::__construct();
  }

  /**
   * [index Metodo para mostrar las cuentas]
   * @return [string] [datos de tipos de cuentas]
   */
  public function index(){
    $conditions = array("conditions"=>"accounts.user_id=users.id");
    $this->set("accounts", $this->accounts->find("accounts, users",  "all", $conditions));
    $this->set("accountsCount", $this->accounts->find("accounts", "count"));
  }
  
  /**
   * [add Agregar nuevas cuentas]
   *
   * De igual forma verificamos si es administrador o no, para realizar este tipo de movimientos
   */
  
  public function add(){
    if ($_SESSION["type_name"]=="Administrador") {
      if ($_POST) {
      if ($this->accounts->save("accounts", $_POST)) {
        $this->redirect(array("controller"=>"accounts"));
      }else{
        $this->redirect(array("controller"=>"transactions", "method"=>"add"));
      }
    }
      
      $this->set("users", $this->accounts->find("users"));
      $this->_view->setView("add");
    }else{
      $this->redirect(array("controller"=>"accounts"));
    }
  }   

  /**
   * [edit Editar las cuentas que se han agregado]
   * @param  [int] $id [id del typo de categoria]
   * @return [string]     [consulta]
   */
  
  public function edit($id){
      if ($id) {
        $options = array(
          "conditions" => "id=".$id
        );
        $account = $this->accounts->find("accounts","first", $options);
        $this->set("account", $account);
        $this->set("users", $this->accounts->find("users"));
      }

      if($_POST){
        if ($this->accounts->update("accounts", $_POST)){
          $this->redirect(
            array(
              "controller"=>"accounts"
            ));
        }else{
          $this->redirect(
            array(
              "controller"=>"accounts",
              "method"=>"edit/".$_POST["id"]
            )
          );
        }
      }
  }
    /**
     * [Eliminar las cuentas]
     * @param  [$id]  [id de la cuenta]
     * @return [type]     [description]
     */
    
    public function delete($id){
        $conditions = "id=".$id;
      if(  $this->accounts->delete("accounts",$conditions)){
          $this->redirect(array("controller"=>"accounts"));
      }else{
          $this->redirect(array("controller"=>"accounts","method"=>"add"));
      }
    }
    /**
     * [Ingresar]
     * @return [login] [la variable a ingresar]
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
            "accounts.id as user_id,
            accounts.password as password,
            accounts.username as username, 
            users.name as type_name",
            "conditions"=>"username='$username' and accounts.user_id=users.id"
          );
        $user= $this->accounts->find("accounts, users", "first", $options);
        if($pass->isValid($password, $user["password"])){
            $auth->login($user);
            $this->redirect(array("controller"=>"pages"));
        }else{
            echo "Usuario no valido";
        }
        }
    }

    public function logout(){
      $auth = new Authorization();
      $auth->logout();
      $this->_view->render("login");
    }
}
