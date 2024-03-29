<?php
    //define o fuso-horario
    date_default_timezone_set('America/Sao_Paulo');
    // mostrar erros
    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
    
    //caso nao esteja no root, coloacar o nome da subpasta exemplo: "sub/"
        $subpasta = "MVC/";
        
    /**
     * ROTAS BASE
     */
        define("DIR_PAGE","http://". $_SERVER['HTTP_HOST'].'/'.$subpasta);

        if(substr($_SERVER['DOCUMENT_ROOT'],-1) == '/'){
            define('DIR_REQ',$_SERVER['DOCUMENT_ROOT'].$subpasta);
        }else{
            define('DIR_REQ',$_SERVER['DOCUMENT_ROOT'].'/'.$subpasta);
        }
    /**
     * URL: DIRETORIOS BASE PUBLICOS (public)
     */
        define('DIR_CSS',       DIR_PAGE .'public/css/');
        define('DIR_JS',        DIR_PAGE .'public/js/');
        define('DIR_TEMPLATE',  DIR_PAGE .'public/template/');
        define('DIR_IMG',       DIR_PAGE .'public/img/');
            
    /**
     * URL: CONTROLLERS
     */
        define('PAINEL',    DIR_PAGE .'Painel/');
        define('HOME',      DIR_PAGE .'Home/');
        define('AUTH',      DIR_PAGE .'Auth/');

    /**
     *  DIRETORIOS DA APLICAÇÃO VIA CAMINHO ABSOLUTO
     */
        define('DIR_APP',        DIR_REQ .'App/');
        define('DIR_CONTROLLER', DIR_APP .'Controller/');
        define('DIR_MODEL',      DIR_APP .'Model/');
        define('DIR_VIEW',       DIR_APP .'View/');
        define('DIR_LAYOUTS',    DIR_VIEW.'Layouts/');
        define('DIR_DAO',        DIR_APP .'DAO/');
        define('DIR_SRC',        DIR_REQ .'Src/');        
    
    /**
     * DADOS DE ACESSO AO BANCO DE DADOS
     */
        define('DB_NAME','modelo_mvc');
        define('DB_HOST','localhost');
        define('DB_USER','root');
        define('DB_PW','');
    
    /**
     * DADOS DE ENVIO DE MAIL
     */
        define("MAIL_HOST",'');
        define('MAIL_ADDRESS','');
        define('MAIL_OWNER','');
        define('MAIL_PW','');
        define('MAIL_PORT','587'); 
        define('MAIL_TYPE','tls'); // ssl ou tls
        
    /**
     * CHAVE DE ENCRIPTAÇÃO
     */
        define("KEY","5E14F542A870B062256C53984EBB022FB50B9A367CC7B66C0753CB3FB9EC22AE");