<?php
    class Vista extends Controllers{
        
        function login(){
            require VW . DF . "head.html";
            $this->view->render($this, "login");
            require VW . DF . "footer.html";
        }
        
        function viewUser(){
            require VW . DF . "mainH.html";
            $this->view->render($this, "viewUser");
            require VW . DF . "footer.html";
        }

        function viewReception(){
            require VW . DF . "mainH.html";
            $this->view->render($this, "viewReception");
            require VW . DF . "footer.html";
        }

        function viewReservation(){
            require VW . DF . "mainH.html";
            $this->view->render($this, "viewReservation");
        }

        function payments(){
            require VW . DF . "payHead.html";
            $this->view->render($this, "payments");
        }

        function reserves(){
            require VW . DF . "mainH.html";
            $this->view->render($this, "reserves");
        }

        function financialBalance(){
            require VW . DF . "mainH.html";
            $this->view->render($this, "fnalBalan");
        }
    }