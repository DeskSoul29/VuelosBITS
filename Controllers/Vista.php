<?php
    class Vista extends Controllers{
        
        function index(){
            require VW . DF . "head.html";
            $this->view->render($this, "index");
            require VW . DF . "footer.html";
        }
    }