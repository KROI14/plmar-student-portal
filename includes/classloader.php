<?php

spl_autoload_register(function($file){
    include '../db-helper/' . $file . '.php';
});