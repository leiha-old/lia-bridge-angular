<?php

namespace Lia\Bridge\AngularBundle\DependencyInjection;

use Lia\Kernel\ThemeBundle\Core\AssetBag;
use Lia\Kernel\ThemeBundle\Core\SubscriberBase;

class ThemeSubscriberAutoService
    extends SubscriberBase
{
    /**
     * @return string
     */
    public function getPathOfAsset()
    {
        return '/bundles/liabridgeangular/';
    }

    /**
     * Allows to set the assets for the bundle
     * They will be on the top of the page
     * @param AssetBag $bag
     */
    public function setTop(AssetBag $bag)
    {
        $bag->styleSheet->files->set([
            'components/angular-ui-grid/ui-grid.css',
        ]);
    }

    /**
     * Allows to set the assets for the bundle
     * They will be on the bottom of the page
     * @param AssetBag $bag
     */
    public function setBottom(AssetBag $bag)
    {
        $bag->javascript->files->set([
            'components/angular/angular.min.js',
            'components/angular-animate/angular-animate.min.js',
            'components/angular-touch/angular-touch.min.js',
            'components/angular-ui-grid/ui-grid.min.js',
        ]);
    }
}