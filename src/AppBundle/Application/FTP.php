<?php

namespace AppBundle\Application;

use Symfony\Component\Config\Definition\Exception\Exception;

class FTP extends Application implements IApplication{


    public function __contructor(){

    }


    public function create($name){

        try {

            var_dump('Entering path: /home/novanet/apps/ <hr/>');
            chdir("/home/novanet/apps/");

            var_dump('Cloning repo to path: /home/novanet/apps/'.$name.'<hr/>');
            $outputs = trim(exec('git clone git@gitlab.com:lutonda/nova_erp.git '.$name));
            var_dump($outputs.'<hr/>');

            var_dump('Entering path: /home/novanet/apps/'.$name.'<hr/>');
            chdir("/home/novanet/apps/".$name);

            var_dump('checkout $(git describe --tags)<hr/>');
            var_dump('checkout $(git tag | sort -n | tail -1)<hr/>');
            $outputs = trim(exec('git checkout $(git tag | sort -n | tail -1)'));
            var_dump($outputs.'<hr/>');

            var_dump('Instaling vendors<hr/>');
            $outputs=exec('cp -r '.$this->path . 'demo/vendor/ '.$this->path .  $name . '/vendor/');
            var_dump($outputs.'<hr/>');
            var_dump('Installing packages<hr/>');
            $outputs = trim(exec('composer install'));
            var_dump($outputs.'<hr/>');
            $outputs = trim(exec('git describe --abbrev=0 --tags'));
            var_dump($outputs.'<hr/>');

            /*var_dump('creeating path: '.$this->path .  $name);
            if (!file_exists($this->path  . $name))
                mkdir($this->path .  $name, 0700,true);


            var_dump('creeating path: '.$this->path . "/" . $name . '/web');
            if (!file_exists($this->path .  $name . '/web'))
            mkdir($this->path .  $name . '/web', 0700);

            exec('cp -r '.$this->path . 'nova/app/. '.$this->path .  $name . '/');
            */
        }catch (Exception $e) {
            var_dump($e->getMessage());
        }
        print_r('<hr>');
        print_r($this->path .  $name . '/web');
        return $this->path .  $name . '/web';
    }

    public function createStach($name){

        try {

            var_dump('Instaling vendors<hr/>');
            $outputs=exec('cp -r '.$this->path . 'demo/vendor/ '.$this->path .  $name . '/vendor/');
            var_dump($outputs.'<hr/>');
            var_dump('Installing packages<hr/>');
            $outputs = trim(exec('composer install'));
            var_dump($outputs.'<hr/>');
            $outputs = trim(exec('git describe --abbrev=0 --tags'));
            var_dump($outputs.'<hr/>');

            /*var_dump('creeating path: '.$this->path .  $name);
            if (!file_exists($this->path  . $name))
                mkdir($this->path .  $name, 0700,true);


            var_dump('creeating path: '.$this->path . "/" . $name . '/web');
            if (!file_exists($this->path .  $name . '/web'))
            mkdir($this->path .  $name . '/web', 0700);

            exec('cp -r '.$this->path . 'nova/app/. '.$this->path .  $name . '/');
            */
        }catch (Exception $e) {
            var_dump($e->getMessage());
        }
        print_r('<hr>');
        print_r($this->path .  $name . '/web');
        return $this->path .  $name . '/web';
    }

    public function update(){

    }
    public function remove(){

    }
    public function get(){
        
    }
}