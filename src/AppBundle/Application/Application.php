<?php
namespace AppBundle\Application;

use Symfony\Component\Yaml\Yaml;


class Application{

    protected $rootdomain='nova-erp.com';
    protected $prefix="novanet";
    protected $user='novanet';
    protected $password="Z8XE1Yi4*-ko8)";
    protected $server="cpanel.nova-erp.com";

    public $cPane;

    protected $path='/home/novanet/apps/';

    public function __construct()
    {
        $this->cPane=new cpanelAPI($this->user, $this->password, $this->server);
    }

    public static function build($name){


        $domain=new Domain();
            $domain=$domain->create($name);
            var_dump($domain);

        print_r('<hr>');
        $mysql=new MySql();
            $mysql=$mysql->create($name);
            var_dump($mysql);

        print_r('<hr>');
        $ftp=new FTP();
            $path=$ftp->create($name);
            var_dump($path);
        print_r('<hr>');

        $domain=new Domain();
            $domain=$domain->autossl($name);
            var_dump($domain);
        print_r('<hr>');
        return $path;
    }

    public function sysInformation(){
        $response = $this->cPane->uapi->ServerInformation->get_information();

        return $response;
    }
    public static function appVersion($source_app, $a, $v){
    
        //$source_app=__DIR__.'/../../../';

        $file=Yaml::parse(file_get_contents($source_app. $a . '/app/config/config.yml'));
        return $file['twig']['globals'][$v];
    }

    const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;
    

    public static function currentVersion($name){
        chdir("/home/novanet/apps/".$name);
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));
        $tagVersion = trim(exec('git tag | sort -V | tail -1'));
        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('v%s-dev.%s (%s)', $tagVersion, $commitHash, $commitDate->format('Y-m-d His'));
    }

    
}

?>