<?php
session_start();

require_once PATH_BASE . 'classes/Access.php';

$isUserAdmin = false; //variable flag(booléenne)

//vérification des droits
if (isset($_SESSION['user'])) {

  $access = new Access();
  $role = $access->getRoleByPseudo($_SESSION['user']);

  if($role !=false && $role->role = $_SESSION['user']){//if le user est admin
    $isUserAdmin = true;
  }
}//fin if isset session user
 ?>
