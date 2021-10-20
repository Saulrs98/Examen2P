<?php
if (isset($_POST["estado"])) {
      $estado = htmlspecialchars($_POST["estado"]);
  } else {
      $estado = "";
    }

if(isset($_POST["nuevoZombi"])){
	$nuevoZombi = htmlspecialchars($_POST["nuevoZombi"]);
}else{
	$nuevoZombi = "";
}

 echo getinboton($estado,$nuevoZombi);


?>