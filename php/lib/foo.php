<?php
namespace dgonzales351\DataDesign;

require_once(dirname(__DIR__ ) . "/classes/autoload.php");
use dgonzales351\DataDesign\Author;
$hash = password_hash( "Fighter2424", PASSWORD_ARGON2I, ["time_cost" => 7]);
$author = new Author("a4661c33f7134b72bfc097eaa16d3141", "dr463hys83jw82ja93j7sy3h6st3ga32", "https://www.uuidgenerator.net/","dgonzales371@cnm.edu", $hash , "dgonzales371");
var_dump($author);