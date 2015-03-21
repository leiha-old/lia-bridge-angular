<?php

namespace Lia\Bridge\AngularBundle\Core\Module;

use Lia\KernelBundle\Bag\CollectionBag;

class Module
    implements ModuleInterface
{
    /**
     * @var string
     */
    protected $moduleName;

    /**
     * @var CollectionBag
     */
    public $extensions;

    /**
     * @var ModuleNode
     */
    public $node;

    /**
     * @var CollectionBag
     */
    protected $controllers;

    public function __construct($moduleName)
    {
        $this->moduleName  = $moduleName;
        $this->node        = new ModuleNode($moduleName);
        $this->extensions  = new CollectionBag();
        $this->controllers = new CollectionBag();
    }

    public function build()
    {
        $name = $this->getName();
        return '<script type="text/javascript">'."\n"
            .'var '.$name.' = angular.module("'.$name.'", '.$this->extensions->getAll('json').');'."\n"

            .$this->controllers->iterate(function(Controller $controller){
                return $controller->build();
            })
        .'</script>';
    }

    /**
     * @param string $controllerName
     * @return Controller
     */
    public function addController($controllerName)
    {
        /** @var ControllerInterface $controller */
        $controller = $this->controllers->add($controllerName, new Controller($this, $controllerName), true);
        return $controller;
    }

    public function render()
    {
        $nodes = $this->controllers->iterate(function(Controller $controller){
            return $controller->node;
        }, 'array');

        $this->node->children->set($nodes);
        return $this->build().$this->node->render();
    }

    public function getName()
    {
        return $this->moduleName;
    }
}