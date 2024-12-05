<?php 

require 'config.php';

class BD_PDO{

    public $tot_reg;
    public $ultimo_id;
    public $data = array();

    public function getConection ()  
    {
        try {
               $conexion = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";",DB_USER,DB_PASS);                    
               }
            catch(PDOException $e){
                          echo "Failed to get DB handle: " . $e->getMessage();
                           exit;    
                                    }
            return $conexion;
    }   

    public function Ejecutar_Instruccion($consulta_sql)
    {
        $conexion = $this->getConection();
        $rows = array();
        
        $query=$conexion->prepare($consulta_sql);
        if(!$query)
        {
            return "Error al mostrar";
        }
        else
        {           
            $query->execute(); 
            $this->ultimo_id = $conexion->lastInsertId();   
            $this->tot_reg = $query->rowCount();       
            while ($result = $query->fetch())
            {
                $rows[] = $result;
            }           
            return $rows;
        }
    }

    public function Ejecutar_Instruccion_parametros($consulta_sql, $parametros)
    {
        $conexion = $this->getConection();
        $rows = array();        
        $query=$conexion->prepare($consulta_sql);
        if(!$query)
        {
            return "Error al mostrar";
        }
        else
        {           
            $query->execute($parametros);   
            $this->tot_reg = $query->rowCount();      
            if (strpos($consulta_sql, 'token') !== false) {
                // Si la consulta SQL contiene la palabra 'token', devolvemos el valor del token
                return $query->fetchColumn();
            } else {
                // Si no contiene 'token', devolvemos los resultados como lo hacíamos antes
                while ($result = $query->fetch())
                {
                    $rows[] = $result;
                }           
                return $rows;
            }
        }
    }

    public function Tot_registros()
    {
        return $this->tot_reg;
    }

    public function Ultimo_id()
    {
        return $this->ultimo_id;
    }

    public function Llenar_Combo($tabla_foranea,$id_foraneo, $campo_foraneo,$tabla_combo,$campo_id_primario)
    {
        $conexion = $this->getConection();       
        $query=$conexion->prepare("SELECT * FROM ".$tabla_foranea."
         WHERE ".$campo_foraneo."=:id");
        $query->bindParam(':id',$id_foraneo);
        if(!$query)
        {
             return "Error al mostrar";
        }
        else
        {
            $query->execute();          
            $foranea = $query->fetch();        
        }           
        $query2=$conexion->prepare("SELECT * FROM ".$tabla_combo);
        $query2->execute(); 
        while ($result = $query2->fetch())
        {
            if($foranea[$campo_id_primario]==$result[$campo_id_primario])
                $select = "selected";
            else
                $select = "";
            $cadena = $cadena.'<option value="'.$result[0].'" '.$select.'>'.$result[1].'</option>';     
        }   
        return $cadena;        
    }
    
    public function Llenar_Combo2($tabla_combo,$llave_primaria, $campo_visualizar)
    {   
        $cadena='';
        $conexion = $this->getConection();       
        $query=$conexion->prepare("SELECT * FROM ".$tabla_combo);
        $query->execute(); 
        while ($result = $query->fetch())
        {
            $cadena = $cadena.'<option value="'.$result[$llave_primaria].'">'.$result[$campo_visualizar].'</option>';     
        }   
        return $cadena;                
    }
}
?>
