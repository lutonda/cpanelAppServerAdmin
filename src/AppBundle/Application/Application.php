<?php
namespace AppBundle\Application;

use DateTime;
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

        //chdir("/home/dev/Lab/php/cpanelAppServerAdmin/");
        chdir((new Application())->path.$name);
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));
        $currentVersion= trim(exec('git describe --abbrev=0 --tags'));
        $commitDate = new DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        ///return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:i:s'));
        $v=new \stdClass();
        $v->version=explode('-',$currentVersion)[0];
        $v->build=explode('-',$currentVersion)[1];
        $v->date=$commitDate;
        return $v;
    }

    public static function lastesVersion(){
        //chdir("/home/dev/Lab/php/cpanelAppServerAdmin/");
        chdir((new Application())->path."demo");

        exec('git fetch --tags');
        $version = trim(exec('git tag | sort -n | tail -1'));
        $commitDate=exec('git log -1 --format=%ai $(git describe --tags)');

        $v=new \stdClass();
        $v->version=explode('-',$version)[0];
        $v->build=explode('-',$version)[1];
        $v->date=$commitDate;
        return $v;

    }

    public static function upgrade($name='admin'){
        $commands = array(
            'echo $PWD',
            'whoami',
            'git resert --hard',
            'git checkout -- .',
            'git pull',
            'git fetch --tags',
            'git checkout $(git tag | sort -n | tail -1)',
            'git status',
            'git submodule sync',
            'git submodule update',
            'git submodule status',
            'php bin/console doctrine:schema:update --force',
            'rm -rf var/',
        );

        chdir((new Application())->path.$name);
        // exec commands
        $output = [];
        foreach($commands AS $command){
            $tmp = shell_exec($command);
            $a=new \stdClass();
            $a->command=$command;
            $a->result=trim($tmp);
            $output []= $a;
        }
         return $output;
    }
}

?>