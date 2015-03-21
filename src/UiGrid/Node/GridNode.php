<?php

namespace Lia\Bridge\AngularBundle\UiGrid\Node;

use Lia\Bridge\AngularBundle\Core\Node\BaseNode;
use Lia\KernelBundle\Bag\CollectionBag;

class GridNode
    extends BaseNode
{
    public function __construct($nodeName, $configName)
    {
        parent::__construct($nodeName);
        $this->attributes->add('id'     , $this->getName());
        $this->attributes->add('ui-grid', $configName);
    }

    protected function setTemplateVars(CollectionBag $vars)
    {

    }

    public function build()
    {
        return $this->buildNode();
    }
}