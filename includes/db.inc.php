<?php

function connectToDb(){
  try {
        $pdo = new PDO('mysql:host=localhost;dbname=advert_website', 'root', '');
        return $pdo;
  } catch (PDOException $e) {
        return null;
  }
}
