<?php 
$connection = new mysqli ("localhost", "root","","solitaire_db");

if ($connection -> connect_error){
    die ("connection error:" . $connection-> connect_error);
}

?>