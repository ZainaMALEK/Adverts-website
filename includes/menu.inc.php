<nav>
  <ul>
    <li>
      <a href="index.php">Accueil</a>
    </li>

      <?php
        if (isset($_SESSION['user'])) {
          if (isset($isUserAdmin)&& $isUserAdmin) {
          echo '<li><a href="'.PATH_BASE.'/logout.php">'.$_SESSION['user'].'Logout</a></li>';
          }
        }else{
          echo '<li><a href="'.PATH_BASE.'/login.php">Login</a></li>';
        }

       ?>


  </ul>
</nav>
