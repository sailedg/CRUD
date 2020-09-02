<?php


class consultas extends dbconexion{

    public function listadoAlumnos()
    {
        $sqlAll = dbconexion::conexion()->prepare("SELECT * FROM alumnos");
        $sqlAll->execute();
        return $array = $sqlAll->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertAlumno($nombres,$apellidos,$ciclo,$sexo)
    {
        $sql = dbconexion::conexion()->prepare("INSERT INTO alumnos(nombres,apellidos,ciclo,sexo)VALUES('$nombres', '$apellidos', '$ciclo', '$sexo')");
        if($sql->execute()){
            $result = self::listadoAlumnos();
            return $result;
        }
    }

    public function getAlumno($id)
    {
        $sql = dbconexion::conexion()->prepare("SELECT * FROM alumnos WHERE id='".$id."'");
        if($sql->execute()){
            return $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return "Hubo un error";
        }
    }

    public function updateAlumno($id,$nombres,$apellidos,$ciclo,$sexo)
    {
        $sql = dbconexion::conexion()->prepare("UPDATE alumnos SET nombres='".$nombres."', apellidos='".$apellidos."', ciclo='".$ciclo."', sexo='".$sexo."' WHERE id='".$id."' ");
        if($sql->execute()){
            $result = self::listadoAlumnos();
            return $result;
        }else{
            return "Hubo un error";
        }
    }

    public function deletAlumno($id)
    {
        $sql = dbconexion::conexion()->prepare("DELETE FROM alumnos WHERE id='".$id."' ");
        if($sql->execute()){
            $result = self::listadoAlumnos();
            return $result;
        }else{
            return "Hubo un error";
        }
    }
}





?>