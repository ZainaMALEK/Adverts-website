<?php
require_once PATH_BASE.'includes/db.inc.php';

class Access {
  private $pdo = null;

  function __construct(){//injection de dependence, on utilise le retour de la fonction connectToDb provenant du fichier db.inc.php pour hydrater la proprieté pdo de la classe Access
    $this->pdo = connectToDb();

  }//fin constructeur

  public function getRoleByPseudo($pseudo){

      $query = $this->pdo->prepare('SELECT role FROM user WHERE pseudo=:pseudo');
      $query->execute([':pseudo'=>$pseudo]);

      $role =  $query->fetch(PDO::FETCH_OBJ);
      return $role;

    }


}//fin classe
 ?>
