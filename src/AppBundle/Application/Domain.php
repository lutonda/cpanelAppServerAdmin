<?php

namespace AppBundle\Application;

class Domain extends Application implements IApplication {

    public function __contructor(){

    }

    
    public function create($subdomain, $folder){
        
        $response = $this->cPane->uapi->SubDomain->addsubdomain(['rootdomain' => $this->rootdomain, 'domain' => $subdomain,'dir'=>$folder]);

        return $response;
    }
    
    public function update(){

    }
    public function remove(){

    }
    public function get(){

    }

}