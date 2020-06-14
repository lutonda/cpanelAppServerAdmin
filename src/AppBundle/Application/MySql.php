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

    public function backUp($name){


        $app = (new Application());

        $path=$app->path;
        $prefix=$app->prefix;

        $name = join('_',array_reverse(explode('.', $name)));

        $dir=new \DateTime();
        $path.='../database/backup/'.$name.'/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $path.=$dir->format('Y_m_d').'/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $path.=$dir->format('H').'/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Return schema for the username_example_db database.
        $data = $response=$this->cPane->uapi->Mysql->dump_database_schema(['dbname'       => $prefix.'_'.$name]);
        var_dump($data->data);
        $file_name=$path.$prefix.'_'.$name.'.sql';
        //criando o ficheiro inical
        $myfile = fopen($file_name, "w") or die("Unable to open file!");
        //escrevendo no ficheiro incial
        fwrite($myfile, $data->data);
        fclose($myfile);
    }
    public function update(){

    }
    public function remove(){

    }
    public function get(){
        
    }
}