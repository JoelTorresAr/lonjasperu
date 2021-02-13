<?php

    require_once '../datos/conexion.php';

    class Marca extends Conexion {
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

        
        public function obtenerMarcas(){
            try {
                $sql = "select 
                        codigo_marca, 
                        descripcion
                    from
                        marca
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