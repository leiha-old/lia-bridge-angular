<?php

namespace Lia\Bridge\AngularBundle\Core\Node;

use Lia\KernelBundle\Template\TemplateInterface;
use Lia\KernelBundle\Tools\NamableInterface;

interface NodeInterface
    extends NamableInterface,
            TemplateInterface
{

}