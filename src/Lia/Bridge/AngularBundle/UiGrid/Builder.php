<?php

namespace Lia\Bridge\AngularBundle\UiGrid;

use Lia\Bridge\AngularBundle\Core\Builder as AngularBuilder;
use Lia\Bridge\AngularBundle\Core\Module\Controller;
use Lia\Bridge\AngularBundle\Core\Module\Module;
use Lia\Bridge\AngularBundle\UiGrid\Bag\ConfigurationBag;
use Lia\Bridge\AngularBundle\UiGrid\Bag\FieldConfigurationBag;
use Lia\Bridge\AngularBundle\UiGrid\Node\GridNode;
use Lia\KernelBundle\Tools\NamableInterface;

class Builder
    extends     AngularBuilder
    implements  NamableInterface
{
    /**
     * @var string
     */
    protected $gridName;

    /**
     * @var GridNode
     */
    protected $node;

    /**
     * @var ConfigurationBag
     */
    public $config;

    /**
     * @var Module
     */
    public $module;

    /**
     * @var Controller
     */
    public $controller;

    public function __construct($gridName, array $dependencies = [])
    {
        parent::__construct();

        $this->gridName = $gridName;

        // Create a new custom angular node (gridNode) for content grid
        $this->node = new GridNode($this->getName(), $this->getConfigName());

        // Create a new custom CollectionBag for store the grid config
        $this->config = new ConfigurationBag();

        // Add an Angular Module root
        $this->module = $this->addModule($gridName . 'UiGridApp', ['ui.grid']);

        // Add an Angular Controller to Module root
        $this->controller = $this->module->addController($this->getName() . 'UiGridCtrl');

        // Add GridNode as a child of controller node
        $this->controller->node->children->add($gridName, $this->node);

        // Add Grid Configuration into a controller scope vars
        $this->controller->scopeVars->add($this->getConfigName(), $this->config);
    }

    public function addConfigurationField($fieldName, array $fieldConfig=[], $returnAdded=false)
    {
        if(!isset($fieldConfig['name'])){
            $fieldConfig['name'] = $fieldName;
        }

        return $this->config->fields->add($fieldName,
            new FieldConfigurationBag($fieldConfig),
            $returnAdded
        );
    }

    public function getName()
    {
        return $this->gridName;
    }

    public function getConfigName()
    {
        return $this->getName().'Config';
    }

    public function setData(array $data)
    {
        $this->config->setData($data);
    }
}