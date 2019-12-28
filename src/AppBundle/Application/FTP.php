<?php

namespace AppBundle\Application;

use Symfony\Component\Config\Definition\Exception\Exception;

class FTP extends Application implements IApplication{


    public function __contructor(){

    }
    
    
    public function create($name){

        try {
            if (!file_exists($this->path . "/" . $name))
            mkdir($this->path .  $name, 0700,true);
                if (!file_exists($this->path . "/" . $name . '/web'))
            mkdir($this->path .  $name . '/web', 0700);

            exec('cp -r '.$this->path . 'nova/. '.$this->path .  $name . '/');
            return $this->path .  $name . '/web';
        }catch (Exception $e) {
            return '';
        }
    }
    public function update(){

    }
    public function remove(){

    }
    public function get(){
        
    }
}