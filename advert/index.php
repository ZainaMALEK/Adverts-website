<?php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

$pdo = connectToDb();

$query = $pdo->prepare(
  'SELECT * FROM advert
  WHERE user_id = :user_id
   ORDER BY id DESC');

$query->execute([':user_id'=>$_SESSION['user_id']]);
$adverts = $query->fetchAll(PDO::FETCH_OBJ);
// balise link, img ,a , script generent des requetes http elles sont dans le dom=>URL_BASE 
//dans les include et les require on utilise PATH_BASE, architecture serveur
?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Project 2: Mes annonces</title>
   </head>
   <body>
     <header>
       <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
       <h1>Mes annonces</h1>
     </header>

     <div class="">
       <a class="btn btn-primary" href="add.php">Déposer une annonce</a>

     </div>
     <?php foreach($adverts as $advert): ?>
       <article class="advert">
         <h3><?php echo $advert->title; ?></h3>
         <div>
           <?php echo $advert->body; ?>
         </div>
       </article>
     <?php endforeach; ?>




   </body>
 </html>
