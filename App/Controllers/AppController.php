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

        $this->view->info_usuario = $_SESSION;

    }

    public function listaProdutos() {

        $this->validaAutenticacao();
        $cliente = Container::getModel('cliente');
        $cliente->__set('id_cliente', $_SESSION['id']);

        $carrinho = Container::getModel('carrinho');
        echo '<pre>';
        print_r($carrinho->getCarrinhoCompras($cliente->__get('id_cliente')));
        echo '</pre>';
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

        $this->render('item','layout_item');
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