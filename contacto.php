<?php
    
    $pdo=new PDO("mysql:dbname=qalalzheimer;host=127.0.0.1","root","");

    if (!$pdo) {
        echo "Error: No se pudo conectar a MySQL. Error " . mysqli_connect_errno() . " : ". mysqli_connect_error() . PHP_EOL;
        die;
    }
       
    $sentenciaSQL=$pdo->prepare("INSERT INTO contacto (email,nombre,telefono,ciudad,mensaje) VALUES (:email,:nombre,:telefono,:ciudad,:mensaje)");

   //$insertsql="INSERT INTO contacto (email,nombre,telefono,ciudad,mensaje) VALUES ($email,$nombre,$telefono,$ciudad,$mensaje)";
    //$query= mysqli_query($pdo,$sentenciaSQL);
    /*if (($result = mysqli_query($conexion,$insertsql)) === false) {
        die(mysqli_error($conexion));
    }*/

    //$sentenciaSQL=$pdo->prepare("INSERT INTO agenda (idregistro,title,descripcion,color,textColor,start,end) VALUES(:idregistro,:title,:descripcion,:color,:textColor,:start,:end)");

    $respuesta=$sentenciaSQL->execute(array(
        "email"=>$_POST['inputEmail4'],
        "nombre"=>$_POST['inputNombre'],
        "telefono"=>$_POST['inputTel'],
        "ciudad"=>$_POST['inputCiudad'],
        "mensaje"=>$_POST['inputMensaje']
    ));
    //echo "Solicitud Enviada";
    echo "<script type='javascript/text'>"; 
    echo "alert('There are no fields to generate a report');";
    echo "window.location.href = '" . 'contacto.html' . "admin/ahm/panel';"; 
    echo "</script>";
    
?>

