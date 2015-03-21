<?php

namespace Lia\Bridge\AngularBundle\Core\Node;

use Lia\KernelBundle\Template\Template;
use Lia\KernelBundle\Bag\CollectionBag;

abstract class BaseNode
    extends    Template
    implements NodeInterface
{
    protected $name;

    protected $nodeType;

    /**
     * @var AttributesBag
     */
    public $attributes;

    /**
     * @var CollectionBag
     */
    public $children;

    public function __construct($nodeName, $nodeType='div')
    {
        parent::__construct();
        $this->name       = $nodeName;
        $this->nodeType   = $nodeType;
        $this->attributes = new AttributesBag();
        $this->children      = new CollectionBag();
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return string
     */
    protected function buildNode()
    {
        $this->vars->set([
            'node_name'   => $this->getName(),
            'node_content'=> $this->children->iterate(function(NodeInterface $item){
                return $item->render();
            })
        ]);

        return $this->renderString('<'.$this->nodeType
            .$this->attributes->build()
            .'>{{ node_content }}</'.$this->nodeType.'>');
    }

    public function render(){
        return $this->build();
    }
}