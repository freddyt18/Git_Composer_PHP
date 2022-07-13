<?php

    function directVisit(){
        if(isset($_SERVER['HTTP_REFERER'])){
            return false;
        }
        return true;
    }

?>