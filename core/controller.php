<?php

class Controller{
    public $vars = array('menu'=>array('adminarticle'=>'Articles', 'admincommentaire'=>'Commentaires', 'adminuser'=>'Users'));
    
    function set($d){
        $this->vars = array_merge($this->vars, $d);
    }
    
    function render($view){
        extract($this->vars);
        require(ROOT.'views/header.php');
        //remove the "controller" part of the class name
        $controller = strtolower(substr(get_class($this), 0, -10));
        if(file_exists(ROOT.'views/'.$controller.'/'.$view.'.php')){
            require(ROOT.'views/'.$controller.'/'.$view.'.php');
        }else{
            echo '404 - view not found';
            die();
        }
        require(ROOT.'views/footer.php');
    }
}