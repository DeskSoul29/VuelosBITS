<?php
class Connection
{
    function __construct(){
        $this->db = new PDOManager("desksoul", "jcrn2917", "db_vuelos");
    }
}