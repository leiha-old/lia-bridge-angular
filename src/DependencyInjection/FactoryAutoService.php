<?php

namespace Lia\Bridge\AngularBundle\DependencyInjection;

use Lia\Bridge\AngularBundle\Core\Builder;
use Lia\Bridge\AngularBundle\UiGrid\Builder as UiGridBuilder;
use Lia\KernelBundle\Service\ServiceBase;

class FactoryAutoService
    extends ServiceBase
{
    /**
     * @return Builder
     */
    public function builder(){
        return new Builder();
    }

    /**
     * @param string $gridName
     * @return UiGridBuilder
     */
    public function gridBuilder($gridName){
        return new UiGridBuilder($gridName);
    }
}