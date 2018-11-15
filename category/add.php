<?php
//file: category/add.php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

if (isset($_POST['submit'])) {
  $pdo = connectToDb();

  $query = $pdo->prepare(
    'INSERT INTO category (name)
      VALUES (:name)');

  $result = $query->execute([
    ':name' => $_POST['name'],

  ]);

  if ($result) {
    echo 'Catégorie enregistrée';
  } else {
    echo 'Echec';
  }

}

?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Project 2: Ajout d'une catégorie</title>
   </head>
   <body>
     <header>
       <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
     </header>

    <?php if($isUserAdmin): ?>

      <h2>Ajout d'une annonce</h2>

      <form method="post">
        <input type="text" placeholder="Ajouter une catégorie" name="name">
        <input type="submit" name="submit" value="Valider">

      </form>

    <?php else: ?>

      <p>ACCESS INTERDIT</p>

    <?php endif; ?>


   </body>
 </html>
