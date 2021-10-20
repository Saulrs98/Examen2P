<?php
$nombre=htmlspecialchars($_GET["nombre"]);
$titulo="Registro del zombi ".$nombre;
$id=htmlspecialchars($_GET["id"]);
if(isset($_POST["zombi"])){
	$nuevo = htmlspecialchars($_POST["zombi"]);
	insertarZombi($id,$nuevo);
	header("location:index.php");
}
?>