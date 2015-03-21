<?php

namespace Lia\Bridge\AngularBundle\UiGrid\Bag;

use Lia\KernelBundle\Bag\CollectionBag;
use Lia\KernelBundle\Bag\CollectionBagInterface;

class ConfigurationBag
    extends CollectionBag
{
    /**
     * @var FieldConfigurationBag[]
     */
    public $fields;

    public function __construct(array $items=[]){
        parent::__construct($items);
        $this->fields = $this->add('columnDefs', new FieldConfigurationBag(), true);
    }

    public function setData(array $data)
    {
        return $this->add('data', $data);
    }

    /**
     * @param bool $enable
     * @return $this
     */
    public function enableUserSorting($enable){
        return $this->add('enableSorting', $enable);
    }

    /**
     * @param string $fieldName
     * @param string $direction
     * @param int $priority
     * @return $this
     */
    public function enableInitialSort($fieldName, $direction='ASC', $priority=0){
        /** @var FieldConfigurationBag $field */
        $field = $this->fields->get($fieldName);
        $field->enableInitialSort($direction, $priority);
        return $this;
    }



    public function jsonSerialize()
    {
        $items = $this->items;
        $items['columnDefs'] = $this->fields->iterate(function(CollectionBagInterface $field){
            return $field;
        }, 'array[]');

        return $items;
    }
}