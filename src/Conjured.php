<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 20.44
 */

namespace App;


class Conjured implements ItemInterface
{
    private $item;

    /**
     * Conjured constructor.
     * @param $item
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * "Conjured" items degrade in Quality twice as fast as normal items
     */
    public function doUpdateQuality()
    {
        if ($this->item->quality > 0) {
            $this->item->quality -= 2;
        }

        $this->item->sell_in -= 1;

        if ($this->item->sell_in < 0 && $this->item->quality > 0) {
            $this->item->quality -= 2;
        }
    }
}