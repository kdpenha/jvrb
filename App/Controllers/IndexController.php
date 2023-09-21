<?php 
    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action {

        public function login() {
            $this->view->erroCadastro = false;
            $this->render('login', 'layout_login');
        }

        public function contato() {
            $this->render('contato', 'layout_contato');
        }

        public function produto() {
            $this->render('produto', 'layout_produto');
        }

        public function cadastrar() {

            $cliente = Container::getModel('cliente');

            $cliente->__set('nome', $_POST['nome']);
            $cliente->__set('email', $_POST['email']);
            $cliente->__set('senha', md5($_POST['senha']));

            if($cliente->validarCadastro() && count($cliente->getClientePorEmail()) == 0) {

                $cliente->salvar();
                header('location:/login?registro=sucesso');
            } else {
                
                $this->view->erroCadastro = true;
                $this->render('/login','layout_login');
            }
        }
    }
