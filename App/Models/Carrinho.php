<?php 
namespace App\Models;

use MF\Model\Model;

class Carrinho extends Model {
    
    private $id_carrinho;
    private $id_produto;
    private $id_cliente;

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value ) {
        $this->$attr = $value;
        return $this;
    }

    public function getCarrinhoCompras($id_cliente) {

        $query = 'SELECT produto.id_produto, produto.nome, produto.preço, produto.img_produto, cc.id_produto, cc.id_cliente, cc.id_produto FROM carrinho as cc LEFT JOIN produto ON cc.id_produto = produto.id_produto WHERE cc.id_cliente = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $id_cliente);
        $stmt->execute();
        $lista_produtos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return json_encode($lista_produtos);
    }

}