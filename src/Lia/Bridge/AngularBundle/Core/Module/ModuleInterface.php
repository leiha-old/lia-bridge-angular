<?php

namespace Lia\Bridge\AngularBundle\Core\Module;


use Lia\KernelBundle\Tools\BuildableInterface;
use Lia\KernelBundle\Tools\NamableInterface;
use Lia\KernelBundle\Tools\RenderableInterface;

interface ModuleInterface
    extends RenderableInterface,
            NamableInterface,
            BuildableInterface
{

}