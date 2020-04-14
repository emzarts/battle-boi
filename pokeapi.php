<?php
$url = "https://pokeapi.co/api/v2/";

class pokemon {
  function __construct($name, $sprite, $types, $stats) {
    $this->name = ucfirst($name);
    $this->sprite_url = $sprite;
    $this->types = $types;
    $this->stats = $stats;
  }
  public $name = "";
  public $sprite_url = "";
  private $types = array();
  private $stats = array();
}

// call the pokeapi to find given pokemon info and return a pokemon object 
function find_pokemon($pokemon) {
  global $url;
  $json = file_get_contents("{$url}pokemon/{$pokemon}/");
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

  return new pokemon($pokemon, $sprite, $types, $statz);
}