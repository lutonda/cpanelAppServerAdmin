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
        $currentVersion= trim(exec('git describe --tags'));
        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        ///return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:i:s'));

        return $currentVersion;
    }

    public static function lastesVersion($name){
        chdir("/home/novanet/apps/".$name);
        $lastes = trim(exec('git tag | sort -n | tail -1'));

        return $lastes;
    }

    public static function upgrade(){
        $commands = array(
            'echo $PWD',
            'whoami',
            'git checkout -- .',
            'git pull',
            'git fetch --tags',
            'git status',
            'git submodule sync',
            'git submodule update',
            'git submodule status',
            'composer install',
            'rm -rf var/',
        );

        chdir("/home/novanet/apps/admin/");
        // exec commands
        $output = [];
        foreach($commands AS $command){
            $tmp = shell_exec($command);

            //$output []= "<span style=\"color: #6BE234;\">\$</span><span style=\"color: #729FCF;\">{$command}\n</span><br />";
            $output []= htmlentities(trim($tmp));
        }

         return $output;
    }
}

?>