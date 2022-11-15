<?php

require_once 'clases/respuestas.class.php';
require_once 'clases/asesores.class.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
$_respuestas = new respuestas;
$_asesores = new asesores;


if($_SERVER['REQUEST_METHOD'] == "GET"){

  

    if(isset($_GET["page"])){
        $pagina = $_GET["page"];
        $listaasesores = $_asesores->listaAsesores($pagina);
        header("Content-Type: application/json");
        echo json_encode($listaasesores);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $asesoresid = $_GET['id'];
        $datosasesores = $_asesores->obtenerAsesor($asesoresid);
        header("Content-Type: application/json");
        echo json_encode($datosasesores);
        http_response_code(200);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    //recibimos los datos enviados
    $postBody = file_get_contents("php://input");
    //enviamos los datos al manejador
    $datosArray = $_asesores->post($postBody);
    //delvovemos una respuesta 
     header('Content-Type: application/json');
     if(isset($datosArray["result"]["error_id"])){
         $responseCode = $datosArray["result"]["error_id"];
         http_response_code($responseCode);
     }else{
         http_response_code(200);
     }
     echo json_encode($datosArray);
    
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
      //recibimos los datos enviados
      $postBody = file_get_contents("php://input");
      //enviamos datos al manejador
      $datosArray = $_asesores->put($postBody);
        //delvovemos una respuesta 
     header('Content-Type: application/json');
     if(isset($datosArray["result"]["error_id"])){
         $responseCode = $datosArray["result"]["error_id"];
         http_response_code($responseCode);
     }else{
         http_response_code(200);
     }
     echo json_encode($datosArray);

}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){

       $headers = getallheaders();
       /* if(isset($headers["token"]) && isset($headers["IDProducto"])){
            //recibimos los datos enviados por el header
            $send = [
                "token" => $headers["token"],
                "IDProducto" =>$headers["IDProducto"]
            ];
            $postBody = json_encode($send);
        }else{*/
            //recibimos los datos enviados
            $postBody = file_get_contents("php://input");
        //}
        
        //enviamos datos al manejador
        $datosArray = $_asesores->delete($postBody);
        //delvovemos una respuesta 
        header('Content-Type: application/json');
        if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
        }else{
            http_response_code(200);
        }
        echo json_encode($datosArray);
       

}else{
    header('Content-Type: application/json');
    $datosArray = $_respuestas->error_405();
    echo json_encode($datosArray);
}


?>