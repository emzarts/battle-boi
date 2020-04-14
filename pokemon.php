<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Battle Boi</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <?php 
    require_once("pokeapi.php");
    $pokemon_name = $_GET['pokemon-name'];
    session_start();
    $pokemon = find_pokemon($pokemon_name);
    if(!$pokemon) {
      echo "<p>{$pokemon_name} not found :(</p>";
      return;
    }
    echo "<h1>{$pokemon->name}</h1>";
    echo "<img src='$pokemon->sprite_url' alt='Image of {$pokemon->name}'>";
    ?>
  </body>
</html>