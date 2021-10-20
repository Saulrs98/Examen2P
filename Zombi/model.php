<?php 
  //función para conectarnos a la BD
  function conectar_bd() {
      $conexion_bd = mysqli_connect("localhost","root","","examen");
      if ($conexion_bd == NULL) {
          die("No se pudo conectar con la base de datos");
      }
      return $conexion_bd;
  }

  //función para desconectarse de una bd
  //@param $conexion: Conexión de la bd que se va a cerrar
  function desconectar_bd($conexion_bd) {
      mysqli_close($conexion_bd);
  }

  /*Funcion para obtener los lugares del parque*/

  function getEstado(){
    $conexion_bd=conectar_bd();
    $resultado='<table class="highlight"><thead><tr><th>Estado</th><th>Nuevo Zombi</th></tr></thead>';
    $consulta='Select E.IdEstado as E_id, E.Nombre as E_nombre From estado as E';
    $resultados=mysqli_query($conexion_bd,$consulta);
    if(mysqli_num_rows($resultados)>0){
      while($row=mysqli_fetch_assoc($resultados)){
        $resultado.="<tr>";
        $resultado.="<td>".$row["E_nombre"]."</td>";
        $resultado.="<td>";
        $resultado.=getIncidente($row["E_id"]);
        $resultado.= '<a href="agregar_nuevo.php?id='.$row["E_id"].'&nombre='.$row["E_nombre"].'"class="waves-effect waves-light btn"><i class="material-icons left">add</i>Registrar estado</a>';
        $resultado.="</td>";
        $resultado.="</tr>";
      }
    }
    mysqli_free_result($resultados);
    desconectar_bd($conexion_bd);
    $resultado.="</tbody></table>";
    return $resultado;
  }
  function inputEscribir($descripcion,$nomform){
    $resultado = '<div class="input-field"><input placeholder="Escribir '.$descripcion.'" type="text" class="validate" name="'.$nomform.'"><label for="">'.$descripcion.'</label></div>';
    return $resultado;
  }

  function insertarNuevoZombi($nuevo){
    $conexion_bd=conectar_bd();
    $consulta='Insert Into nuevo-zombi (Nombre) Values (?) ';
    if(!($statement=$conexion_bd->prepare($consulta))){
    }
    if(!$statement->bind_param("s",$nuevo)){
    }
    if(!$statement->execute()){
    }
    desconectar_bd($conectar_bd);
  }

  function selectEstado($id,$columna,$tabla){
    $conexion_bd=conectar_bd();
    $resultado='<div class="input-field"><select name="'.$tabla.'" id="'.$tabla.'"><option value"" disabled selected>Selecciona una opción</option>';
    $consulta='Select '.$id.', '.$columna.' From '.$tabla;
    
    $resultados=mysqli_query($conexion_bd,$consulta);
    if(mysqli_num_rows($resultados)>0){
      while($row=mysqli_fetch_assoc($resultados)){
        $resultado.='<option value="'.$row[$id].'">'.$row[$columna].'</option>';
      }
    }
    desconectar_bd($conexion_bd);
    $resultado.='</select><label>'.$columna.' '.$tabla.'...</label></div>';
    return $resultado;
  }

  function insertarZombi($id,$nuevo){
    $conexion_bd=conectar_bd();
    $consulta='Insert Into Zombis (idEstado, id) Values (?,?)';

    if ( !($statement = $conexion_bd->prepare($consulta)) ) {
    }
    if (!$statement->bind_param("ii", $id, $nuevo)) {

    }
    if (!$statement->execute()) {
  }
    desconectar_bd($conexion_bd);
  }

  function getNuevo($id){
    $conexion_bd=conectar_bd();
    $consulta='Select I.Nombre as I_nombre, O.Fecha as O_fecha From nuevo-zombi as I, estado as L, zombis as O Where I.id = O.idZombi AND L.id=O.IdEstado AND O.IdEstado='.$id.' Order By O.Fecha ASC';
    $resultado="";
    $resultados=mysqli_query($conexion_bd,$consulta);
    if(mysqli_num_rows($resultados)>0){
      while($row=mysqli_fetch_assoc($resultados)){
        $resultado.=$row["I_nombre"];
        $resultado.=" (".$row["O_fecha"].")";
        $resultado.="<br>";
      }
    }
    mysqli_free_result($resultados);
    desconectar_bd($conexion_bd);
    return $resultado;
  }

  function boton(){
    $i = 1;
    $resultado;
    while($i<=4){
      if($i==1){
    $resultado='<a href="consultas.php?idb='.$i.'"class="waves-effect waves-light btn"><i class="material-icons left">add</i>Consulta '.$i.'</a>';
    $resultado.=" ";
    $i=$i+1;
  }else{
  $resultado.='<a href="consultas.php?idb='.$i.'"class="waves-effect waves-light btn"><i class="material-icons left">add</i>Consulta '.$i.'</a>';
  $resultado.=" ";
    $i=$i+1;    
  }
}
    return $resultado;
  }
function getLugaressinboton($estado,$zombi){
    $conexion_bd=conectar_bd();
    $resultado='<table class="highlight"><thead><tr><th>Lugar</th><th>Incidente</th><th>Fecha</th></tr></thead>';
    $consulta='Select L.Nombre as L_nombre, I.Nombre as I_nombre, O.Fecha as O_fecha From estado as L, nuevo-zombi as I, zombis as O WHERE L.IdEstado = O.IdEstado AND I.Id = O.Id';
    if($lugar!=""){
      $consulta.= " AND O.IdEstado=".$estado;
    }
    if($incidente!=""){
      $consulta.=" AND O.Id=".$zombi;
    }
    $consulta.=" Order By O.Fecha DESC";
    $resultados=mysqli_query($conexion_bd,$consulta);
    if(mysqli_num_rows($resultados)>0){
      while($row=mysqli_fetch_assoc($resultados)){
        $resultado.="<tr>";
        $resultado.="<td>".$row["L_nombre"]."</td>";
        $resultado.="<td>".$row["I_nombre"]."</td>";
        $resultado.="<td>".$row["O_fecha"]."</td>";
        $resultado.="</tr>";
      }
    }
    mysqli_free_result($resultados);
    desconectar_bd($conexion_bd);
    $resultado.="</tbody></table>";
    return $resultado;
  }

?>