<%php

namespace AppBundle\Application;

class Domain extends Application implements IApplication{

    public function __contructor()

    
    public function create($subdomain, $folder):bool{
        
        $response = $cPanel->api2->SubDomain->addsubdomain(['rootdomain' => $this->rootdomain, 'domain' => $subdomain,'dir'=>$folder]);

        return $response;
    };
    
    public function update():bool{

    };
    public function remove():bool{

    };
    public function get(){

    };

}