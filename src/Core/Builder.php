<?php

namespace Lia\Bridge\AngularBundle\Core;

use Lia\Bridge\AngularBundle\Core\Module\Module;
use Lia\KernelBundle\Bag\CollectionBag;
use Lia\KernelBundle\Tools\RenderableInterface;

class Builder
    implements RenderableInterface
{
    /**
     * @var CollectionBag
     */
    protected $modules;

    public function __construct()
    {
        $this->modules = new CollectionBag();
    }

    /**
     * @param $moduleName
     * @param array $extensions
     * @return Module
     */
    public function addModule($moduleName, array $extensions=[])
    {
        /** @var Module $module */
        $module = $this->modules->add($moduleName, new Module($moduleName), true);
        $module->extensions->set($extensions);
        return $module;
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->modules->iterate(function(Module $module){
            return $module->render();
        });
    }
}