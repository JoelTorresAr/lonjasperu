<?php

    require_once '../datos/conexion.php';

    class Linea extends Conexion {
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

        
        public function obtenerLineas(){
            try {
                $sql = "select 
                        codigo_linea, 
                        descripcion
                    from
                        linea
                    order by
                        descripcion
                ";
            
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                return $resultado;
                
            } catch (Exception $exc) {
                throw $exc;
            }
            
        }
        
    }