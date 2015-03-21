<?php

namespace Lia\Bridge\AngularBundle\Core\Module;

use Lia\Bridge\AngularBundle\Core\Node\BaseNode;
use Lia\KernelBundle\Bag\CollectionBag;

class ModuleNode
    extends BaseNode
{
    public function __construct($nodeName)
    {
        parent::__construct($nodeName);
        $this->attributes->add('ng-app', $this->getName());
    }

    protected function setTemplateVars(CollectionBag $vars)
    {

    }

    public function build()
    {
        return $this->buildNode();
    }
}