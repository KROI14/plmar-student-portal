<?php

class Connection{
    public function connect(){
        $connect = new mysqli('localhost', 'root', '', 'plmar');

        try{
            if($connect->ping()){
                return $connect;
            }   
            else{
                throw new Exception("Disconnected to the server");
            }
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
}