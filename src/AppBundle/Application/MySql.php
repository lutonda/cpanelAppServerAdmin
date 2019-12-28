<?php

namespace AppBundle\Application;

class MySql extends Application implements IApplication{


    public function __contructor(){

    }
    
    
    public function create($name){

        $response=$this->cPane->uapi->Mysql->create_database(['name'=> $this->prefix.'_'.$name]);
        $response=$this->cPane->uapi->Mysql->create_user(['name'=> $this->prefix.'_'.$name,'password'=>'12!"qwASzx_'.$name.'_MYSQL']);

        $response=$this->cPane->uapi->Mysql->set_privileges_on_database([
        'user'       => $this->prefix.'_'.$name,
        'database'   => $this->prefix.'_'.$name,
        'privileges' => 'ALTER,ALTER ROUTINE,CREATE,CREATE ROUTINE,CREATE TEMPORARY TABLES,CREATE VIEW,DELETE,DROP,EVENT,EXECUTE,INDEX,INSERT,LOCK TABLES,REFERENCES,SELECT,SHOW VIEW,TRIGGER,UPDATE']);

        return  $response;
    }
    public function update(){

    }
    public function remove(){

    }
    public function get(){
        
    }
}