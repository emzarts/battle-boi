<?php
$url = "https://pokeapi.co/api/v2/";

// the type is key and the value represents the types it is weak against
$types = [
  "water" => ["grass"],
  "fire" => ["water"],
  "grass" => ["fire"]
];

class pokemon {
  function __construct($name, $sprite, $types, $stats) {
    $this->name = ucfirst($name);
    $this->sprite_url = $sprite;
    $this->types = $types;
    $this->stats = $stats;
  }
  public $name = "";
  public $sprite_url = "";
  public $types = array();
  public $stats = array();
  public $counters = array();

  public function __toString() {
    return $this->name;
  }
}

function check_cache($pokemon) {
  if(isset($_SESSION[$pokemon])) {
    echo "<p>cached</p>";
    return $_SESSION[$pokemon];
  } 
  echo "<p>not cached</p>";
  return null;
}

// call the pokeapi to find given pokemon info and return a pokemon object 
function find_pokemon($pokemon) {
  $cached_pokemon = check_cache($pokemon);
  if($cached_pokemon) {
    return $cached_pokemon;
  }

  global $url;
  $json = @file_get_contents("{$url}pokemon/{$pokemon}/");
  $pokemon_details = json_decode($json);

  // if pokemon is not found return null
  if(!$json) {
    return null;
  }
  $sprite = $pokemon_details->{"sprites"}->{"front_default"};

  $types = [];
  foreach($pokemon_details->{"types"} as $type) {
    array_push($types, $type->{"type"}->{"name"});
  }

  $statz = [];
  foreach($pokemon_details->{"stats"} as $stat) {
    $statz[$stat->{"stat"}->{"name"}] = $stat->base_stat;
  }

  $pokemon_object = new pokemon($pokemon, $sprite, $types, $statz);
  $_SESSION[$pokemon] = $pokemon_object;
  getCounters($pokemon_object);
  return $pokemon_object;
}

function getCounters($pokemon) {
  global $url;
  foreach($pokemon->types as $type) {
    //echo $type;
  }
  $json = @file_get_contents("{$url}pokemon/{$pokemon->name}/");
  $pokemon_details = json_decode($json);
}