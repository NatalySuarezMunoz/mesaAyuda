<?php
class bd {
    public function __construct(){
        $this->host="localhost";
        $this->user="admin";
        $this->pass="Proyecto21";
        $this->db="mesaayuda";
    }

    private function conexion(){
        $conectar=new mysqli($this->host,$this->user,$this->pass,$this->db);
        if($conectar->connect_errno){
            echo "error de conexion";
        }else{
           $this->conectar=$conectar;
           echo "conectado";
        }
        
    }

    public function consultar($query=''){
        $this->conexion();
        $resultado=$this->conectar->query($query);
        return $resultado;
    }

    public function insertar($query=''){
        $this->conexion();
        $resultado=$this->conectar->query($query);
        $id=$this->conectar->insert_id;
        return $id;
    }
}