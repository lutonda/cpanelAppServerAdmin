<?php


namespace AppBundle\Twig;

use AppBundle\Application\Application as App;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('app_version', [$this, 'appVersion']),
        ];
    }

    public function appVersion()
    {

        $version = App::currentVersion();

        return $version;
    }
}