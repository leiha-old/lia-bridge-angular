<?php

namespace Lia\Bridge\AngularBundle\Core\Node;

use Lia\KernelBundle\Bag\CollectionBag;
use Lia\KernelBundle\Tools\BuildableInterface;

class AttributesBag
    extends CollectionBag
    implements BuildableInterface
{

    public function build()
    {
        $ret = $this->iterate(function($itemValue, $itemName){
            if(is_array($itemValue)){
                $itemValue = json_encode($itemValue);
            }
            return $itemName.'="'.$itemValue.'"';
        }, 'array');

        return ' '.implode(' ', $ret);
    }
}