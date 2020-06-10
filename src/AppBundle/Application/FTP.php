<?php

namespace AppBundle\Application;

use Symfony\Component\Config\Definition\Exception\Exception;

class FTP extends Application implements IApplication{


    public function __contructor(){

    }


    public function create($name)
    {

        $path = $this->path;

        if (strpos($name, 'free'))
        {
            $name = str_replace('.free', '', $name);
            $path.='../free/';
        }

        try {

            var_dump('Entering path: /home/novanet/apps/ <hr/>');
            chdir($path);

            var_dump('Cloning repo to path: '.$path.'<hr/>');
            $outputs = trim(exec('git clone git@gitlab.com:lutonda/nova_erp.git '.$name));
            var_dump($outputs.'<hr/>');

            var_dump('Entering path: '.$path.$name.'<hr/>');
            chdir($path.$name);

            var_dump('checkout $(git describe --tags)<hr/>');
            var_dump('checkout $(git tag | sort -n | tail -1)<hr/>');
            $outputs = trim(exec('git checkout $(git tag | sort -n | tail -1)'));
            var_dump($outputs.'<hr/>');
            var_dump(exec('rm web/img/demo_template.png'));

        }catch (Exception $e) {
            var_dump($e->getMessage());
        }
        print_r('<hr>');
        print_r($this->path .  $name . '/web');
        return $path .  $name . '/web';
    }

    public function createStach($name){
        $path = $this->path;

        if (strpos($name, 'free'))
        {
            $name = str_replace('.free', '', $name);
            $path.='../free/';
        }
        try {

            var_dump('Instaling vendors<hr/>');
            $outputs=exec('cp -r '.$this->path . 'demo/vendor/ '.$path .  $name . '/vendor/');
            var_dump($outputs.'<hr/>');
            var_dump('Installing packages<hr/>');
            $outputs = trim(exec('composer install'));
            var_dump($outputs.'<hr/>');
            $outputs = trim(exec('git describe --abbrev=0 --tags'));
            var_dump($outputs.'<hr/>');

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