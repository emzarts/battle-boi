<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Battle Boi</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <?php 
    require_once("pokeapi.php");
    $pokemon = $_GET['pokemon-name'];
    session_start();
    find_pokemon($pokemon);
    ?>
  </body>
</html>