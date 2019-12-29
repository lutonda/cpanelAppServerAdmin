<?php

namespace AppBundle\Application;

class Domain extends Application implements IApplication {

    public function __contructor(){

    }

    
    public function create($subdomain){
        
        $response = $this->cPane->uapi->SubDomain->addsubdomain(['rootdomain' => $this->rootdomain, 'domain' => $subdomain,'dir'=>$this->path . "/" . $subdomain . '/web']);

        return $response;
    }

    public function autossl($subdomain){
        $response = $this->cPane->uapi->SSL->set_autossl_excluded_domains(['domains'  =>   $subdomain.'.'.$this->rootdomain]);

        return $response;
    }
    public function update(){

    }
    public function remove(){

    }
    public function get(){

    }

}