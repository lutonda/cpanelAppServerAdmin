<?php


namespace AppBundle\Twig;

use AppBundle\Application\Application as App;
use AppBundle\Entity\Payment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('app_version', [$this, 'appVersion']),
            new TwigFilter('payment_status', [$this, 'paymentStatus']),
            new TwigFilter('less_than', [$this, 'lessThan']),
        ];
    }

    public function lessThan($date){
        return $date<new \DateTime();
    }
    public function paymentStatus(Payment $payment,$i=true){

        $icon=['check','times','calendar'];
        $color=['success','danger','default'];
        $now=new \DateTime();
        if($payment->getDueDate() > $now ){
            $final=2;
        }
        else if($payment->getDueDate() < $now){
            $final=1;
        }
        else{
            $final=0;
        }

        return $i ? $icon[$final] : $color[$final];
    }
    public function appVersion($name)
    {

        $version = App::currentVersion($name);

        return $version->version;
    }
}