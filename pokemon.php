<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Battle Boi</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <?php 
    $pokemon = $_GET['pokemon-name'];
    $json = file_get_contents("https://pokeapi.co/api/v2/pokemon/$pokemon/");
    //echo $json;
    $pokemon_details = json_decode($json);
    echo "types: ";
    foreach($pokemon_details->{"types"} as $type) {
      echo $type->{"type"}->{"name"} . " ";
    }
    //.$pokemon_details->{"types"}[1]->{"type"}->{"name"};
    ?>
  </body>
</html>