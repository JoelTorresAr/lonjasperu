<?php

    require_once '../datos/conexion.php';

    class Categoria extends Conexion {
        private $codigo;
        private $descripcion;
        
        public function getCodigo() {
            return $this->codigo;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }

        public function setCodigo($codigo) {
            $this->codigo = $codigo;
        }

        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        
        public function obtenerCategorias($codigoLinea){
            try {
                $sql = "select 
                        codigo_categoria, 
                        descripcion
                    from
                        categoria
                    where
                        codigo_linea = :cod_lin
                    order by
                        descripcion
                ";
            
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":cod_lin", $codigoLinea);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                return $resultado;
                
            } catch (Exception $exc) {
                throw $exc;
            }
            
        }
        
    }