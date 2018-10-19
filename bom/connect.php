<?php

error_reporting(E_ALL & ~E_NOTICE);


class Connect{

    // private $db_serverName = "TARELCOII\SQLENTERPRISE";
    private $db_serverName = "ANA";
    private $db_user = "sa";
    private $db_password = "P@ssw0rd";
    public  $db_name = "BIGLOAD";
    private $connect_db;
    private $connectionInfo;

    public function Open(){
        //$this->connectionInfo = array("Database"=>db_name, "UID"=>db_user, "PWD"=>db_password);
        //$this->connect_db = sqlsrv_connect($this->db_serverName,$this->connectionInfo);

        $this->connectionInfo = array('Database'=>$this->db_name, "UID"=>$this->db_user, "PWD"=>$this->db_password);
        $this->connect_db = sqlsrv_connect($this->db_serverName,$this->connectionInfo);
        
        if($this->connect_db){
           //echo "success";
        }else{
            echo "Connection to database failed.</br>Contact Database Administrator.</br>";
           // throw new Exception("<script>alert('Connection to database failed. Contact Database Administrator.')</script>");
            die( print_r( sqlsrv_errors(), true));
        }
        return $this->connect_db;
    }

    public function Close(){
//        sqlsrv_close($this->connect_db) OR die("There was a problem disconnecting from the database.");
        if(sqlsrv_close($this->connect_db)){
            
        }else{
            throw new Exception("<script>alert('There was a problem disconnecting from the database. Contact Database Administrator.')</script>");
        }
    }
}