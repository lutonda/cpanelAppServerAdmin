<?php
namespace AppBundle\Application;



class Application{

    protected $rootdomain='nova-erp.com';
    protected $prefix="novanet";
    protected $user='novanet';
    protected $password="Z8XE1Yi4*-ko8)";
    protected $server="cpanel.nova-erp.com";

    protected $cPane;

    protected $path='/home/dev/Lab/apps/';//'/home/novanet/';

    public function __construct()
    {
        $this->cPane=new cpanelAPI($this->user, $this->password, $this->server);
    }

    public static function new($name){

        $ftp=new FTP();
            $path=$ftp->create($name);
        /*$domain=new Domain();
            $domain->create($name,$path);
        $mysql=new MySql();
            $mysql->create($name);
*/
            return $path;
    }
}

?>