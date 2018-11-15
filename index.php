<?php
require_once 'includes/settings.inc.php';
require_once PATH_BASE . 'includes/checkaccess.inc.php';
require_once PATH_BASE . 'includes/db.inc.php';

  $pdo = connectToDb();
  //récupération des catégories

  $query = $pdo->prepare(
    'SELECT * FROM category
     ORDER BY name ASC');

  $query->execute();
  $categories = $query->fetchAll(PDO::FETCH_OBJ);//fin récupération des catégories


  $sql = 'SELECT advert.id as advert_id, advert.title, category.name, category.id as category_id
  FROM advert
  LEFT JOIN advert_category
  ON advert_category.advert_id = advert.id
  LEFT JOIN category
  ON advert_category.category_id = category.id';

  $bindings =[];

    // if (isset($_GET['search'])) {
    //   $sql.= 'WHERE advert.title LIKE :search';
    //   $bindings = [':search' => '%'. $_GET['search'] . '%'];
    // }

  if (isset($_GET['categories'])) {
    $in = implode(',',$_GET['categories']);
    $sql .= 'WHERE category_id IN ('.$in.')';//le binding pdo ne fonctionne pas avec la clause IN , solution:faire une concatenation dans la requete
    //$bindings = [':in'=> $in];

  }


  $query = $pdo->prepare($sql);
  $query->execute($bindings);

  $rows = $query->fetchAll(PDO::FETCH_OBJ);//il va falloir afficher pr chaque annonce ses categories...

  $adverts = []; // longueur 0;
  $previous_id = 0;

  for ($i = 0; $i < sizeof($rows); $i++) {
    if ($previous_id != $rows[$i]->advert_id) {
      // la longueur de $adverts augmente d'une unité
      // un nouvel indice est créé
      $adverts[] = array(
        'advert' => $rows[$i],'categories' => []);
      if ($rows[$i]->name != null) {
          $lastIndex = sizeof($adverts) - 1;
          $adverts[$lastIndex]['categories'][] = $rows[$i]->name;
      }
    } else {
      // on est face à un doublon => catégorie à traiter
      // on ajoute le nom de la catégorie dans le tableau
      // imbriqué correspond à l'annonce dont on repère l'indice
      // dans la variable $lastIndex
      $lastIndex = sizeof($adverts) - 1;
      $adverts[$lastIndex]['categories'][] = $rows[$i]->name;
    }
    $previous_id = $rows[$i]->advert_id;
  }


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 2: Accueil</title>
    <?php include_once PATH_BASE . 'includes/css.inc.php'; ?>
  </head>
  <body>
    <header>
      <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
    </header>
    <h1>Projet 2: Accueil</h1>

    <!--Moteur de recherche -->
    <form class="" action="" method="">
      <input type="search" name="search" placeholder="Mots-clés">
      <input type="submit" name="submit">

      <!--filtres par caégories-->
      <div class="">

        <?php foreach ($categories as $category): ?>


          <input type="checkbox"
          name="categories"
          value="<?php echo $category->id;?>">
          <label for=""><?php echo $category->name;?></label>


        <?php endforeach ?>
      </div>
    </form>

    <?php for($i = 0; $i < sizeof($adverts); $i++): ?>
      <article class="advert">
        <h3><?php echo $adverts[$i]['advert']->title; ?></h3>
        <div>
          <br>
        </div>
        <div>
          <span>Catégories: </span>
          <?php echo implode(', ', $adverts[$i]['categories']); ?>
        </div>
      </article>
    <?php endfor; ?>


  </body>
</html>
