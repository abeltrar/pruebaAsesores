<?php
require_once "conexion/conexion.php";
require_once "respuestas.class.php";


class asesores extends conexion {
 
    private $table = "adviser";
    private $IdAsesor = "";
    private $nombre = "";
    private $cedula = "";
    private $telefono = "";
    private $fechanacimiento = "0000-00-00";
    private $genero = "";
    private $clientetrabajo = "";
    private $sede = "";
    private $token = "";
    private $userregistro = "";
    private $edad = "";
    
//912bc00f049ac8464472020c5cd06759

    public function listaAsesores($pagina = 1){
        $inicio  = 0 ;
        $cantidad = 100;
        if($pagina > 1){
            $inicio = ($cantidad * ($pagina - 1)) +1 ;
            $cantidad = $cantidad * $pagina;
        }
        $query = "SELECT IdAsesor,nombre,cedula,telefono,fechanacimiento,genero,clientetrabajo,sede,userregistro,edad,fechacreacion FROM " . $this->table . " limit $inicio,$cantidad";
        $datos = parent::obtenerDatos($query);
        return ($datos);
    }

    public function obtenerAsesor($id){
        $query = "SELECT * FROM " . $this->table . " WHERE IdAsesor = '$id'";
        return parent::obtenerDatos($query);

    }

    public function obtener_edad_segun_fecha($fechanacimiento)
    {
        $nacimiento = new DateTime($fechanacimiento);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }


    public function post($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);
        
    

       if(!isset($datos['token'])){
                return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){

                if(!isset($datos['nombre']) || !isset($datos['cedula']) || !isset($datos['telefono']) || !isset($datos['fechanacimiento'])|| !isset($datos['genero'])
                || !isset($datos['clientetrabajo'])|| !isset($datos['sede'])){
                    return $_respuestas->error_400();
                }else{
                    $this->nombre = $datos['nombre'];
                    $this->cedula = $datos['cedula'];
                    $this->telefono = $datos['telefono'];
                    $this->fechanacimiento = $datos['fechanacimiento'];
                    $this->genero = $datos['genero'];
                    $this->clientetrabajo = $datos['clientetrabajo'];
                    $this->sede = $datos['sede'];
                   

                  
                    $resp = $this->insertarAsesor();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "IdAsesor" => $resp
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }


       

    }

   
   public function obtenerusuario(){
        $query1= "SELECT user.usuario from usuarios_token INNER JOIN user On user.IdUsuario = usuarios_token.UsuarioId
         where usuarios_token.Estado = 1";
        return parent::obtenerDatos($query1);

    } 

 

    private function insertarAsesor(){

    
       $this->userregistro = "Comunicaciones";
       $this->edad= $this->obtener_edad_segun_fecha($this->fechanacimiento);
        $query = "INSERT INTO " . $this->table . " (nombre,cedula,telefono,fechanacimiento,genero,clientetrabajo,sede,userregistro,edad)
        values
        ('" . $this->nombre . "','" . $this->cedula . "','" . $this->telefono ."','" . $this->fechanacimiento . "','"  . $this->genero . "','" . $this->clientetrabajo  . "','" . $this->sede  . "','" . $this->userregistro . "','" . $this->edad . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }
    
    public function put($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){
                if(!isset($datos['IdAsesor'])){
                    return $_respuestas->error_400();
                }else{
                    $this->IdAsesor = $datos['IdAsesor'];
                    if(isset($datos['nombre'])) { $this->nombre = $datos['nombre']; }
                    if(isset($datos['cedula'])) { $this->cedula = $datos['cedula']; }
                    if(isset($datos['telefono'])) { $this->telefono = $datos['telefono']; }
                    if(isset($datos['fechanacimiento'])) { $this->fechanacimiento = $datos['fechanacimiento']; 
                        $this->edad = $this->obtener_edad_segun_fecha($datos['fechanacimiento']);}
                    if(isset($datos['genero'])) { $this->genero = $datos['genero']; }
                    if(isset($datos['clientetrabajo'])) { $this->clientetrabajo = $datos['clientetrabajo']; }
                    if(isset($datos['sede'])) { $this->sede = $datos['sede']; }
                    if(isset($datos['userregistro'])) { $this->userregistro = $datos['userregistro']; }
                  
                    
        
                    $resp = $this->modificarAsesor();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "IdAsesor" => $this->IdAsesor
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

           }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }


    }


    private function modificarAsesor(){
        $query = "UPDATE " . $this->table . " SET nombre ='" . $this->nombre . "',cedula = '" . $this->cedula . "', telefono = '" . $this->telefono . "', fechanacimiento = '" .
        $this->fechanacimiento . "', genero = '" . $this->genero . "', clientetrabajo = '" . $this->clientetrabajo . "', sede = '" . $this->sede . 
         "',edad = '" . $this->edad . "' WHERE IdAsesor = '" . $this->IdAsesor . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }


    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);

        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $arrayToken =   $this->buscarToken();
            if($arrayToken){

                if(!isset($datos['IdAsesor'])){
                    return $_respuestas->error_400();
                }else{
                    $this->IdAsesor = $datos['IdAsesor'];
                    $resp = $this->eliminarAsesor();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "IdAsesor" => $this->IdAsesor
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }

            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }



     
    }


    private function eliminarAsesor(){
        $query = "DELETE FROM " . $this->table . " WHERE IdAsesor= '" . $this->IdAsesor . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }


    private function buscarToken(){
        $query = "SELECT  IdToken,UsuarioId,Estado from usuarios_token WHERE Token = '" . $this->token . "' AND Estado = 1";
        $resp = parent::obtenerDatos($query);
        if($resp){
            return $resp;
        }else{
            return 0;
        }
    }


    private function actualizarToken($IdToken){
        $date = date("Y-m-d H:i");
        $query = "UPDATE usuarios_token SET Fecha = '$date' WHERE IdToken = '$IdToken' ";
        $resp = parent::nonQuery($query);
        if($resp >= 1){
            return $resp;
        }else{
            return 0;
        }
    }



}





?>