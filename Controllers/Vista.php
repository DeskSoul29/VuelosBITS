<?php
    class Vista extends Controllers{
        
        function login(){
            require VW . DF . "head.html";
            $this->view->render($this, "login");
            require VW . DF . "footer.html";
        }
        
        function main(){
            require VW . DF . "head.html";
            $this->view->render($this, "main");
            require VW . DF . "footer.html";
        }
    }