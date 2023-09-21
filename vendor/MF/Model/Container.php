<?php

namespace MF\Model;
use App\Connection;

class Container {
    public static function getModel($model) {
        
        $class = "\\App\\Models\\".ucfirst($model);
        //new \App\Models\Info($conn)
        
        $conn = Connection::getDB();

        return new $class($conn);

    }
}