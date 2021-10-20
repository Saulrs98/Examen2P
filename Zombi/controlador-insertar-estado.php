<?php
$titulo="Registrar estado";
if(isset($_POST['estado'])){
	$estado = htmlspecialchars($_POST['estado']);
	insertarLugar($estado);
	header("location:index.php");
}else{
	$estado="";
}
?>