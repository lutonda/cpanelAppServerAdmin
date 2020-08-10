<?php



namespace AppBundle\Application;
use  Firebase\JWT\JWT as j;

class Encrypt
{
    protected $pubkey = '...public key here...';
    protected $privkey = '...private key here...';
    protected $key;
    /**
     * Encrypt constructor.
     */
    public function __construct()
    {
        $this->privkey = file_get_contents("./../app/keys/v9.0.1/myprivkey.pem");
        $this->pubkey = file_get_contents("./../app/keys/v9.0.1/mypubkey.pem");
    }
    public static function JWT():Jwt{
        return new Jwt();
    }
}

class Jwt extends Encrypt {

    /*protected $pubkey = '...public key here...';
    protected $privkey = '...private key here...';*/
    protected $key;

    public function __costructor(){

    }
    public function encode($payload):string{

        $jwt = j::encode($payload, $this->privkey, 'RS256');

        return $jwt;

    }
    public function decode($encoded):object{

        $decoded = j::decode($encoded, $this->pubkey, array('RS256'));

        return $decoded;
    }
}