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
            echo '<br><br><br><br><br><br><br><br>';
            print_r($_SESSION);
            echo'TA LOGADO';
        }
        $this->render('index','layout_index');

    }

    public function adicionarCarrinho() {

        $this->validaAutenticacao();

        $cliente = Container::getModel('cliente');
        $cliente->__set('id_cliente', $_SESSION['id']);
        $cliente->__set('nome', $_SESSION['nome']);


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