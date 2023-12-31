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

        return $lista_produtos;
    }

    public function adicionaProduto($id_produto, $id_cliente) {
        $query = 'INSERT INTO carrinho (id_produto, id_cliente) VALUES (?, ?)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $id_produto);   
        $stmt->bindValue(2, $id_cliente);   
        $stmt->execute();

        return $this;
    }

    public function removerProduto($id_produto, $id_cliente) {

        $q1 = 'SELECT * FROM carrinho WHERE id_produto = ? AND id_cliente = ? ';
        $stmt = $this->db->prepare($q1);
        $stmt->bindValue(1, $id_produto);   
        $stmt->bindValue(2, $id_cliente);   
        $stmt->execute();
        
        $itens_repetidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        print_r($itens_repetidos[0]['id_carrinho']);

        if(count($itens_repetidos) > 1) {
            foreach($itens_repetidos as $key => $value) {
                $query = 'DELETE FROM carrinho WHERE id_carrinho= ?';
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(1, $itens_repetidos[0]['id_carrinho']);
                $stmt->execute();   
            }
        } else {
            $query = 'DELETE FROM carrinho WHERE id_produto = ? AND id_cliente = ?';
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $id_produto);   
            $stmt->bindValue(2, $id_cliente);   
            $stmt->execute();
        }
        return $this;
    }
    
    public function zeraCarrinho($id_cliente) {
        $q = 'DELETE FROM carrinho WHERE id_cliente = ?';
        $stmt = $this->db->prepare($q);
        $stmt->bindValue(1, $id_cliente);
        $stmt->execute();
        return $this;
    }

}