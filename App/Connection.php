<?php 

    namespace App;

    class Connection {
        public static function getDB() {
            try {
                
                $conn = new \PDO(//colocando a barra invertida pq ele fica no namespace raiz
                    "mysql:host=localhost;dbname=jvrb;charset=utf8",
                    "root",
                    ""
                );

                return $conn;

            } catch (\PDOException $e) {
                //tratar de alguma forma
                echo $e->getMessage();
            }
        }
    }