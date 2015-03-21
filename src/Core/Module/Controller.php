<?php

namespace Lia\Bridge\AngularBundle\Core\Module;

use Lia\KernelBundle\Bag\CollectionBag;

class Controller
    implements ControllerInterface
{
    /**
     * @var string
     */
    protected $controllerName;

    /**
     * @var CollectionBag
     */
    public $scopeVars;

    /**
     * @var ControllerNode
     */
    public $node;

    /**
     * @var ModuleInterface
     */
    protected $parentModule;

    public function __construct(ModuleInterface $parentModule, $controllerName)
    {
        $this->parentModule    = $parentModule;
        $this->controllerName  = $controllerName;
        $this->node            = new ControllerNode($controllerName);
        $this->scopeVars       = new CollectionBag();
    }

    public function build()
    {
        $a  = ['$scope'];
        return $this->parentModule->getName()
            .'.controller("'.$this->getName().'", ["'
                .implode('","', $a).'", function ('.implode(',', $a).') {'."\n"
                    .$this->buildScopeVars()
                ."\n".'}'
        .   ']);'."\n"
        ;
    }

    protected function buildScopeVars()
    {
        return implode("\n", $this->scopeVars->iterate(function($var, $varName){
            return "\t".'$scope.'.$varName.' = '.json_encode($var).';';
        }, 'array'));
    }

    public function render()
    {
        return $this->node->render();
    }

    public function getName()
    {
        return $this->controllerName;
    }
}