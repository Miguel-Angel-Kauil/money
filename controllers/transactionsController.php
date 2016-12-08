<?php
/**
 * Clase para las transacciones
 *
 * Para controlar la agregacion de tipos de transacciones, edición, actualización y eliminación. 
 */

cLass transactionsController extends AppsController
{
  /**
   * [__construct constructor de la clase]
   */

  public function __construct(){
    parent::__construct();
  }

  /**
   * [index Metodo para mostrar las transacciones]
   * @return [string] [datos de usuarios]
   */
  
  public function index(){
    $conditions = array("conditions"=>"transactions.account_id=accounts.id and transactions.category_id=categories.id");

    $columnaSuma = array(
        "columna" =>"transactions.amount"
      );

    $this->set("transactions", $this->transactions->find("transactions, accounts, categories",  "all", $conditions));
    $this->set("transactionCount", $this->transactions->find("transactions", "count"));
    $transactionsSuma = $this->transactions->find("transactions", "suma", $columnaSuma);
    $this->set(compact("transactions", "transactionCount", "transactionsSuma"));
  }

  /**
   * [add Agregar nuevas transacciones]
   *
   * De igual forma verifica si es un administrador, en caso de que lo sea, le permite crear un usuario, de lo contrario no.
   */

  public function add(){
   // if ($_SESSION["type_name"]=="Administradores") {
      if ($_POST) {
      if ($_POST["operation"] == 'egreso'){
        $_POST["amount"] = $_POST["amount"]*(-1);
      }
      if ($this->transactions->save("transactions", $_POST)) {
        $this->redirect(array("controller"=>"transactions"));
      }else{
        $this->redirect(array("controller"=>"transactions", "method"=>"add"));
      }
    }
      
      $this->set("accounts", $this->transactions->find("accounts"));
      $this->set("categories", $this->transactions->find("categories"));
      $this->_view->setView("add");
   /* }else{
      $this->redirect(array("controller"=>"transactions"));
    }*/
  }

  /**
   * [editar las transacciones]
   * @param  [type] $id [id de la transaccion]
   * @return [type]     [sonsulta a la base de datos]
   */
  public function edit($id){
      if ($id) {
        $options = array(
          "conditions" => "id=".$id
        );
        $transaction = $this->transactions->find("transactions","first", $options);
        $this->set("transaction", $transaction);
          $this->set("accounts", $this->transactions->find("accounts"));
          $this->set("categories", $this->transactions->find("categories"));
      }

      if($_POST){
        if ($_POST["operation"] == 'egreso'){
          $_POST["amount"] = $_POST["amount"]*(-1);
        }
        if ($this->transactions->update("transactions", $_POST)){
          $this->redirect(
            array(
              "controller"=>"transactions"
            ));
        }else{
          $this->redirect(
            array(
              "controller"=>"transactions",
              "method"=>"edit/".$_POST["id"]
            )
          );
        }
      }
  }

    /**
     * [Eliminar las transacciones]
     * @param  [$id]  [description]
     * @return [type]     [description]
     */
    public function delete($id){
        $conditions = "id=".$id;
      if(  $this->transactions->delete("transactions",$conditions)){
          $this->redirect(array("controller"=>"transactions"));
      }else{
          $this->redirect(array("controller"=>"transactions","method"=>"add"));
      }
    }
}
