<?php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

$pdo = connectToDb();

$query = $pdo->prepare(
  'SELECT * FROM category
   ORDER BY name ASC');

$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);
// balise link, img ,a , script generent des requetes http elles sont dans le dom=>URL_BASE
//dans les include et les require on utilise PATH_BASE, architecture serveur
?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Project 2: Catégories</title>
   </head>
   <body>
     <header>
       <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
       <h1>Les catégories</h1>
     </header>

     <div class="">
       <a class="btn btn-primary" href="add.php">Ajouter une catégorie</a>

     </div>
     <table class="table table-striped ">


       <?php foreach($categories as $category): ?>

         <tr>
           <td><?php echo $category->id;  ?></td>
           <td><?php echo $category->name;  ?></td>
         </tr>

       <?php endforeach; ?>
     </table>




   </body>
 </html>
