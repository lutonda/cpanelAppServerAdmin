<?php
namespace AppBundle\Application;

use AppBundle\Entity\Application as EntityApplication;
use AppBundle\Entity\Payment;
use AppBundle\Entity\Plan;
use DateTime;
use Symfony\Component\Yaml\Yaml;


class Application{

    public $rootdomain;
    protected $prefix;
    protected $user;
    protected $password;
    protected $server;

    public $cPane;

    protected $path;

    protected function load(){
        $string = file_get_contents($_SERVER['DOCUMENT_ROOT']."/config.json");
        $json = json_decode($string, true);

        $this->rootdomain=$json['rootdomain'];
        $this->prefix=$json['prefix'];
        $this->user=$json['user'];
        $this->password=$json['password'];
        $this->server=$json['server'];
        $this->path=$json['path'];
    }
    public function __construct()
    {
        $this->load();
        $this->cPane=new cpanelAPI($this->user, $this->password, $this->server);
    }


    public static function build($name){


        $ftp=new FTP();
            $path=$ftp->create($name);
            var_dump($path);
            print_r('<hr>');
        $domain=new Domain();
            $domain=$domain->create($name);
            var_dump($domain);

        print_r('<hr>');
        $mysql=new MySql();
            $mysql=$mysql->create($name);
            var_dump($mysql);

        print_r('<hr>');

        $domain=new Domain();
            $domain=$domain->autossl($name);
            var_dump($domain);
        print_r('<hr>');

        $path=$ftp->createStach($name);
            var_dump($path);
        print_r('<hr>');
        return $path;
    }

    public function sysInformation(){
        $response = $this->cPane->uapi->ServerInformation->get_information();

        return $response;
    }

    const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;


    public static function currentVersion($name='admin'){


        $path = (new Application())->path;
        if($name=='admin')
            $path.='../';
        else if (strpos($name, 'free'))
        {
            $name = str_replace('.free', '', $name);
            $path.='../free/';
        }

        try{

        chdir($path.$name);

        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));
        $currentVersion= trim(exec('git describe --abbrev=0 --tags'));
        $commitDate = new DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        ///return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:i:s'));
        $v=new \stdClass();
        $v->version=explode('-',$currentVersion)[0];
        $v->build=explode('-',$currentVersion)[1];
        $v->date=$commitDate;
        }catch(\Exception $e){
            
            $v=new \stdClass();
            $v->version='';
            $v->build='';
            $v->date='';
        }
        return $v;
    }

    public static function lastesVersion(){

        try{
        //chdir("/home/dev/Lab/php/cpanelAppServerAdmin/");
        chdir((new Application())->path."demo");

        exec('git fetch --tags');
        $version = trim(exec('git tag | sort -n | tail -1'));
        $commitDate=exec('git log -1 --format=%ai $(git describe --tags)');

        $v=new \stdClass();
        $v->version=explode('-',$version)[0];
        $v->build=explode('-',$version)[1];
        $v->date=$commitDate;

        
        }catch(\Exception $e){
            
            $v=new \stdClass();
            $v->version='';
            $v->build='';
            $v->date='';
        }
        return $v;

    }

    public static function upgrade($name='admin'){

        $commands = array(
            'git reset --hard',
            'git fetch --tags',
            'git checkout $(git tag | sort -n | tail -1)',
            'rm -rf var/',
            //'php bin/console doctrine:schema:update --force',
        );

        $path = (new Application())->path;

        if (strpos($name, 'free'))
        {
            $name = str_replace('.free', '', $name);
            $path.='../free/';
        }

        chdir($path.$name);
        // exec commands
        $output = [];
        foreach($commands AS $command){
            $tmp = exec($command);
            $a=new \stdClass();
            $a->command=$command;
            $a->result=trim($tmp);
            $output []= $a;
        }
         return $output;
    }

    public static function sendLicense(Payment $payment){

        $url='http://'.$payment->getApplication()->getDomain().'/app/api/init/license/v9.0.1';
        $url='http://0.0.0.0:8000/app/api/init/license/v9.0.1';

        $final=RestClient::post($url,['license'=>$payment->getLicense()]);
    }
}

?>