<?php 
    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action {

        public function autenticar() {

            print_r($_POST);
            $cliente = Container::getModel('cliente');
            $cliente->__set('email', $_POST['email']);
            $cliente->__set('senha', md5($_POST['senha']));

            $cliente->autenticar();

            if(!empty($cliente->__get('id_cliente')) && !empty($cliente->__get('nome'))) {
                
                session_start();

                $_SESSION['id'] = $cliente->__get('id_cliente');
                $_SESSION['nome'] = $cliente->__get('nome');

                header('location: /');
            } else {

                header('location: /login?login=erro');
            }
        }
    }