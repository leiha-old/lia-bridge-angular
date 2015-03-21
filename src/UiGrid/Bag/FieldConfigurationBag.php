<?php

namespace Lia\Bridge\AngularBundle\UiGrid\Bag;

use Lia\KernelBundle\Bag\CollectionBag;

class FieldConfigurationBag
    extends CollectionBag
{
    /**
     * @param bool $enable
     * @return $this
     */
    public function enableSorting($enable){
        return $this->add('enableSorting', $enable);
    }

    /**
     * @param string $direction
     * @param int    $priority
     * @return $this
     */
    public function enableInitialSort($direction='ASC', $priority=0){
        return $this->add('sort', [
            'direction' => 'uiGridConstants.'.$direction,
            'priority'  => $priority

        ]);
    }
}