<?php

namespace AppBundle\Application;

class MySql extends Application implements IApplication{


    public function __contructor(){

    }
    
    
    public function create($name){

        $name=join('_',array_reverse(explode('.',$name)));

        //create database
        $response=$this->cPane->uapi->Mysql->create_database(['name'=> $this->prefix.'_'.$name]);
        var_dump($response);
        print_r('<hr>');
        //create user
        $response=$this->cPane->uapi->Mysql->create_user(['name'=> $this->prefix.'_'.$name,'password'=>'12!"qwASzx_'.$name.'_MYSQL']);
        var_dump($response);
        print_r('<hr>');
        //Granting users privileges to database
        $response=$this->cPane->uapi->Mysql->set_privileges_on_database([
        'user'       => $this->prefix.'_'.$name,
        'database'   => $this->prefix.'_'.$name,
        'privileges' => 'ALTER,ALTER ROUTINE,CREATE,CREATE ROUTINE,CREATE TEMPORARY TABLES,CREATE VIEW,DELETE,DROP,EVENT,EXECUTE,INDEX,INSERT,LOCK TABLES,REFERENCES,SELECT,SHOW VIEW,TRIGGER,UPDATE']);
        var_dump($response);
        print_r('<hr>');
        //create database backup file
        exec('cp '.$this->path.'../database/initial_db.sql '.$this->path.'../database/temp/'.$this->prefix.'_'.$name.'.sql');
        print_r('cp '.$this->path.'../database/initial_db.sql '.$this->path.'../database/temp/'.$this->prefix.'_'.$name.'.sql');
        //exec('mysql -u username -p '.$this->prefix.'_'.$name.' < '.$this->path.'nova/db/initial.sql');

        //restore database backup
        $response=$this->cPane->uapi->Backup->restore_databases([
        'backup'                 => $this->path.'../database/temp/'.$this->prefix.'_'.$name.'.sql',
        'verbose'                => '1',
        'timeout'                => '3600']);

        var_dump($response);
        print_r('<hr>');
        return  $response;
    }
    public function update(){

    }
    public function remove(){

    }
    public function get(){
        
    }
}