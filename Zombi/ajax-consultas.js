//  Funcion para crear el objeto para realizar una peticion asincrona
function getRequestObject() {
    // Asynchronous objec created, handles browser DOM differences
    if(window.XMLHttpRequest) {
      // Mozilla, Opera, Safari, Chrome IE 7+
      return (new XMLHttpRequest());
    }
    else if (window.ActiveXObject) {
      // IE 6-
      return (new ActiveXObject("Microsoft.XMLHTTP"));
    } else {
      // Non AJAX browsers
      return(null);
    }
  }
  
  
  function buscar(){
    //console.log("click en buscar");
     request=getRequestObject();
     if(request!=null)
     {
       let estado = document.getElementById("estado").value;
       let nuevoZ = document.getElementById("nuevoZombi").value;
       var url='controlador-consultas.php?estado='+ estado +'&nuevoZombi='+ nuevoZ;
       request.open('GET',url,true);
  
       request.onreadystatechange =
            function() {
                if((request.readyState==4)){
                    // Se recibió la respuesta asíncrona, entonces hay que actualizar el cliente.
            // callback
                    //console.log("respuesta recibida");
                    document.getElementById("resultados_consulta").innerHTML = request.responseText;
                   }  
            };
       // Limpiar 
       request.send(null);
    }
  }
  
  //Evento que detonara la peticion asincrona
  document.getElementById("buscar").onclick = buscar;