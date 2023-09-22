<?php 
namespace App\Models;

use MF\Model\Model;

class Cliente extends Model {

    private $id_cliente;
    private $nome;
    private $endereco;
    private $email;
    private $telefone;
    private $senha;

    public function __get($attr) {
        return $this->$attr;
    }

    public function __set($attr, $value ) {
        $this->$attr = $value;
    }

    public function salvar() {

        $query = 'INSERT INTO cliente(nome, email, senha) VALUES (?,?,?)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $this->__get('nome'));
        $stmt->bindValue(2, $this->__get('email'));
        $stmt->bindValue(3, $this->__get('senha'));
        $stmt->execute();

        return $this;
    }

    public function validarCadastro() {

        $valido = true;
        if($this->__get('nome') < 3) {
            $valido = false;
        } 
        if($this->__get('email') < 3) {
            $valido = false;
        } 
        if($this->__get('senha') < 3) {
            $valido = false;
        }
        if(!filter_var($this->__get('email'), FILTER_VALIDATE_EMAIL)) {
            $valido = false;
        }

        return $valido;
    }

    public function getClientePorEmail() {

        $query = "select nome,email from cliente where email = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $this->__get('email'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function autenticar() {

        $query = 'SELECT ID_cliente,nome,email FROM cliente where email = ? AND senha = ?';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $this->__get('email'));
        $stmt->bindValue(2, $this->__get('senha'));

        $stmt->execute();
        $cliente = $stmt->fetch(\PDO::FETCH_ASSOC);

        var_dump($cliente);
        if(!empty($cliente['ID_cliente']) && !empty($cliente['nome'])) {
            $this->__set('id_cliente', $cliente['ID_cliente']);
            $this->__set('nome', $cliente['nome']);
        }

        return $this;
    }

    public function adicionarCarrinho($id_produto) {

        
    }
}