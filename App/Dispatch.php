<?php
    namespace App;
    
    use Src\Classes\ClassRoutes;
    use App\Routes;
    
    /**
     * Class Dispatch
     * res responsavel por instanciar a Controller requisitada 
     * e chamar seu metodo passando os atributos (se houver) 
     */
    class Dispatch extends ClassRoutes{

        /**
         * @var Controller $obj
         * é a variavel onde será instanciado a class Controller
         */
        private $obj;

        /**
         * @var string $method
         * guarda o nome do método que será chamado
         */
        private $method;

        /**
         * @var string[] $param
         * guarda um array de parametros recebidos via URL
         */
        private $param = [];

        /**
         * @var int paramStartAt
         * guarda o indice onde os parametros começam
         * a URL é quebrada em um array separando os "/"
         * esta variavel indica onde os parametros iniciam
         * por padrão os parametros iniciam no indice 2
         * @example https://www.exemplo.com/controller/method/param1/param2
         * mas podem ter casos onde iniciam no indice 1:
         * @example https://www.exemplo.com/method/param1/param2
         */
        private $paramStartAt = 2;

        /**
         * @method string getMethod()
         * retorna o nome do método que foi definido
         */
        protected function getMethod(){ return $this->method; }

        /**
         * @method void setMethod(string $method)
         * define o nome do método que será chamado
         */
        protected function setMethod($method){
            $method = str_replace("-","_",$method);
            $this->method = $method;
        }

        /**
         * @method string[] getParam()
         * retorma o array de strings que foram definidas como parametros
         */
        protected function getParam(){ return $this->param; }

        /**
         * @method void setParam(string[] $param)
         * define um array de strings que serão passados como parametros
         */
        protected function setParam($param){ $this->param = $param; }
        
        /**
         * @method __construct()
         * chama o método AddController()
         * chama o método addParam()
         */
        public function __construct(){
            self::AddController();
            self::addParam();
        }
        
        /**
         * @method void AddController()
         * instancia o Controller e chama o metodo addMethod()
         */
        public function AddController(){
            
            if( is_array( $this->getRoute() ) ){
                $routeController = $this->getRoute()['Controller'];
                $action = $this->getRoute()['Action'];
            }else{
                $routeController = "Controller";
                $action = "Error";
            }
            
            $controller = "App\\Controller\\". $routeController;
           
            $this->obj = new $controller;       
            $this->addMethod($action);
        }
        
        /**
         * @method void addMethod(string $action)
         * chama o metodo da classe
         * se o metodo nao existir chama um metodo de errors
         */
        private function addMethod($action = null){

            if(!empty($action)){
                $this->setMethod($action);
                $this->paramStartAt = 1;
            }else{
                if(isset($this->parseUrl()[1]) && !empty($this->parseUrl()[1])){
                
                    $action = str_replace('-','_',$this->parseUrl()[1]);
                    if( method_exists($this->obj,$action) ) $this->setMethod($action);

                }else{
                    if( method_exists($this->obj,'index') ) 
                        $this->setMethod('index');
                    else
                        $this->setMethod('Error');
                }
            }

            call_user_func_array([$this->obj,$this->getMethod()],$this->getParam());
        }
        
        /**
         * @method void addParam()
         * armazena no atributo $param o array de parametros pegos da URL
         */
        private function addParam(){
            
            $arrayCount = count($this->parseUrl());
            
            if($arrayCount > $this->paramStartAt){
                
                foreach($this->parseUrl() as $key => $value){
                    if($key >= $this->paramStartAt) $this->setParam($this->param += [$key => $value]);
                }

            }
        }
    }