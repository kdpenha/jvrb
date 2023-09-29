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

    public function getProduto($id_produto) {

        $query = 'SELECT id_produto, nome, preço, img_produto FROM produto WHERE id_produto = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $id_produto);
        $stmt->execute();
    
        $dados = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $dados;
    } 
}