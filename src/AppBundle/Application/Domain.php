<?php

namespace AppBundle\Application;

class Domain extends Application implements IApplication {

    public function __contructor(){

    }

    
    public function create($subdomain){
        $path=$this->path;
        $rootDomain=$this->rootdomain;
        if(strpos($subdomain,'.free')) {
            $subdomain=str_replace('.free','',$subdomain);
            $path .= '../free/';
            $rootDomain='free.'.$rootDomain;
        }

        $response = $this->cPane->uapi->SubDomain->addsubdomain(['rootdomain' => $rootDomain, 'domain' => $subdomain,'dir'=>$path . '/web']);

        return $response;
    }

    public function autossl($subdomain){
        $rootDomain=$this->rootdomain;
        if(strpos($subdomain,'.free')) {
            $subdomain=str_replace('.free','',$subdomain);
            $subdomain=$subdomain.'.free.'.$rootDomain;
        }
        $response = $this->cPane->uapi->SSL->set_autossl_excluded_domains(['domains'  =>   $subdomain]);

        return $response;
    }
    public function update(){

    }
    public function remove(){

    }
    public function get(){

    }

}