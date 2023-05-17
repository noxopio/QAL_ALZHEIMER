<?php
header('Content-Type: application/json');

$pdo=new PDO("mysql:dbname=qalalzheimer;host=127.0.0.1","root","");


$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';
$data=array();
switch($accion){
    case 'agregar':
        //instruccion de agregado
        
        $sentenciaSQL=$pdo->prepare("INSERT INTO agenda (idregistro,title,descripcion,color,textColor,start,end) VALUES(:idregistro,:title,:descripcion,:color,:textColor,:start,:end)");
        
        $respuesta=$sentenciaSQL->execute(array(
            "idregistro"=>$_POST['idregistro'],
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end']
        ));
        echo json_encode($respuesta);
        break;//exit(json_encode(array("msg"=>"exito")));
               

    case 'eliminar':
         //instruccion de eliminar
        //echo "eliminar";
        $respuesta=false;          

        if(isset($_POST['id'])){
            $sentenciaSQL=$pdo->prepare("DELETE FROM agenda WHERE ID=:ID");
            $respuesta=$sentenciaSQL->execute(array("ID"=>$_POST['id']));
        }
        echo json_encode($respuesta);

        break;
       
    
    case 'modificar':
         //instruccion de modificar
        //echo "modificar";
        $sentenciaSQL=$pdo->prepare("UPDATE agenda SET 
        title=:title,
        descripcion=:descripcion,
        color=:color,
        textColor=:textColor,
        start=:start,
        end=:end
        WHERE ID=:ID
        ");

        $respuesta=$sentenciaSQL->execute(array(
            
            "ID"=>$_POST['id'],
            //"idregistro"=>$_POST['idregistro'],
            "title"=>$_POST['title'],
            "descripcion"=>$_POST['descripcion'],
            "color"=>$_POST['color'],
            "textColor"=>$_POST['textColor'],
            "start"=>$_POST['start'],
            "end"=>$_POST['end']
        ));

        echo json_encode($respuesta);

        break;
    default:
            //seleccionar los eventos del calendario
            $idregistro=$_GET['idregistro'];
            $sentenciaSQL=$pdo->prepare("SELECT * FROM agenda WHERE idregistro='$idregistro';");
            $sentenciaSQL->execute();

            $resultado=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($resultado);
        break;
}

?>