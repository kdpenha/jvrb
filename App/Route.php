<?php 

namespace App;

use MF\Init\Bootstrap; //não precisou colocar namespace pq o autoload ja carrega

class Route extends Bootstrap{
    protected function initRoutes(){ 
        // é criado uma variável com duas rotas
        $routes['home'] = array( //caso a rota/PATH seja raiz(/ ou index)
            'route' => '/',
            'controller' => 'AppController',
            'action' => 'index' // qual açao que sera disparada quando a rota for requisitada
        );
        $routes['login'] = array( //caso a rota/PATH seja raiz(/ ou index)
            'route' => '/login',
            'controller' => 'indexController',
            'action' => 'login' // qual açao que sera disparada quando a rota for requisitada
        );
        $routes['contato'] = array( //caso a rota/PATH seja raiz(/ ou index)
            'route' => '/contato',
            'controller' => 'indexController',
            'action' => 'contato' // qual açao que sera disparada quando a rota for requisitada
        );
        $routes['produto'] = array( //caso a rota/PATH seja raiz(/ ou index)
            'route' => '/produto',
            'controller' => 'indexController',
            'action' => 'produto' // qual açao que sera disparada quando a rota for requisitada
        );
        $routes['cadastrar'] = array( //caso a rota/PATH seja raiz(/ ou index)
            'route' => '/cadastrar',
            'controller' => 'indexController',
            'action' => 'cadastrar' // qual açao que sera disparada quando a rota for requisitada
        );
        $routes['autenticar'] = array( //caso a rota/PATH seja raiz(/ ou index)
            'route' => '/autenticar',
            'controller' => 'AuthController',
            'action' => 'autenticar' // qual açao que sera disparada quando a rota for requisitada
        );

        $this->setRoutes($routes);
    }
    
}