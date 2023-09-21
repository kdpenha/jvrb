<?php 

    namespace MF\Init;

    abstract class Bootstrap { //a classe abstrata n pode ser instanciada, apenas
        private $routes;

        abstract protected function initRoutes(); //se eu coloquei aqui, a herdeira tem que colocar tbm
        
        public function __construct(){
            $this->initRoutes();
            $this->run($this->getUrl()); //parametro com a URL (PATH)
        }

        public function getRoutes(){
            return $this->routes;
        }

        public function setRoutes(array $routes){
            $this->routes = $routes;
        }

        protected function getUrl(){
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //'REQUEST_URI'pega somente a URL
        }

        protected function run($url){
            foreach($this->getRoutes() as $path => $route){
                if($url == $route['route']){//verifica se a url é igual a variável route no índice route
                    $class = "App\\Controllers\\".ucfirst($route['controller']); //a contrabarra é pra escapar a outra barra

                    $controller = new $class;
                    
                    $action = $route['action'];
                    
                    $controller->$action();
                }
            }
        }
    }