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
    $pokemon_details = json_decode($json);

    // display message if pokemon is not found
    if(!$json) {
      echo "$pokemon not found.";
      return;
    }
    echo "<h1>$pokemon</h1>";
    $sprite = $pokemon_details->{"sprites"}->{"front_default"};
    echo "<img src=\"$sprite\" alt=\"image of $pokemon\"/>";
    echo "<br>";
    echo "<strong>Types: </strong>";
    foreach($pokemon_details->{"types"} as $type) {
      echo $type->{"type"}->{"name"} . " ";
    }
    echo "<br> <strong>Stats:</strong> <br>";
    //var_dump($pokemon_details->{"stats"});
    foreach($pokemon_details->{"stats"} as $stat) {
      echo $stat->{"stat"}->{"name"} . ": ";
      echo $stat->base_stat;
      echo "<br>";
    }
    ?>
  </body>
</html>