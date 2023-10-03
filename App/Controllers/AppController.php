<?php 
    namespace App\Controllers;

    use App\Models\Cliente;
    use MF\Controller\Action;
    use MF\Model\Container;

class AppController extends Action {

    public function index(){

        if($this->taLogado()) {
            $cliente = Container::getModel('cliente');
            $cliente->__set('id_cliente', $_SESSION['id']);
            $cliente->__set('nome', $_SESSION['nome']);
            $this->view->logado = true;

            $this->view->info_usuario = $_SESSION;
        } else {

            $this->view->logado = false;
        }

        $this->render('index','layout_index');
    }

    public function exposicao() {
        $this->render('exposicao', 'layout_exposicao');
    }

    public function adicionarCarrinho() {

        $this->validaAutenticacao();

        $cliente = Container::getModel('cliente');
        $cliente->__set('id_cliente', $_SESSION['id']);
        $cliente->__set('nome', $_SESSION['nome']);

        $id_cliente = $_SESSION['id'];
        $id_produto = $_POST['id_produto']? $_POST['id_produto'] : '';

        $carrinho = Container::getModel('carrinho');

        try {
            $carrinho->adicionaProduto($id_produto, $id_cliente);
            header('location: /carrinho');
        } catch(\PDOException $e) {

            echo $e->getMessage();
        }

    }

    public function carrinho() {

        $this->validaAutenticacao();
        
        $cliente = Container::getModel('cliente');
        $cliente->__set('id_cliente', $_SESSION['id']);
        $cliente->__set('nome', $_SESSION['nome']);
        $this->view->logado = true;

        $this->view->info_usuario = $_SESSION;

        $this->render('carrinho','layout_carrinho');
    }

    public function listaProdutos() {

        $this->validaAutenticacao();
        $cliente = Container::getModel('cliente');
        $cliente->__set('id_cliente', $_SESSION['id']);

        $carrinho = Container::getModel('carrinho');
        
        $lista = $carrinho->getCarrinhoCompras($cliente->__get('id_cliente'));
        echo json_encode($lista);
    }

    public function mostrarProduto() {

        if($this->taLogado()) {
            $cliente = Container::getModel('cliente');
            $cliente->__set('id_cliente', $_SESSION['id']);
            $cliente->__set('nome', $_SESSION['nome']);
            $this->view->logado = true;

            $this->view->info_usuario = $_SESSION;
        } else {

            $this->view->logado = false;
        }

        $id_produto = $_GET['id_produto'];

        $produto = Container::getModel('produto');
        $produto = $produto->getProduto($id_produto);
        $this->view->nome_tenis = $produto['nome'];
        $this->view->preco_tenis = $produto['preço'];
        $this->view->img_tenis = $produto['img_produto'];
        $this->view->id_produto = $produto['id_produto'];

        $this->render('item','layout_item');
    }

    public function removerProduto() {

        $this->validaAutenticacao();
        
        $id_produto = $_POST['id_produto'];
        print_r($id_produto);
        $carrinho = Container::getModel('carrinho');
        $carrinho->removerProduto($id_produto, $_SESSION['id']);
        header('location: /carrinho');
    }

    public function validaAutenticacao() { //só deixa ele tomar determinada ação se ele tiver logado
        session_start();

        if(empty($_SESSION['id']) || $_SESSION['id'] == '' || empty($_SESSION['nome']) || $_SESSION['nome'] == '') {

            header('location: /login?login=erro');
        }
        return true;
    }

    public function taLogado() { //checa se o usuário está logado para enviar informações para a página principal;

        session_start();
        if(empty($_SESSION['id']) || $_SESSION['id'] == '' || empty($_SESSION['nome']) || $_SESSION['nome'] == '') {

            return false;
        }
        return true;
    }
}