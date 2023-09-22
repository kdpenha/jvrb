<?php 
namespace App\Models;

use MF\Model\Model;

class Produto extends Model {
    
    private $id_produto;
    private $nome;
    private $preco;
    private $quant_estoque;
    private $img_produto;

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value ) {
        $this->$attr = $value;
        return $this;
    }

}