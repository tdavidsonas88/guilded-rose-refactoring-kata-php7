<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 12.21
 */

namespace App;


class AgedBrie implements ItemInterface
{
    /** @var Item */
    private $item;

    /**
     * AgedBrie constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function doUpdateQuality()
    {
        if ($this->item->quality < 50) {
            $this->item->quality += 1;
        }
        $this->item->sell_in -= 1;
        // degrades twice as fast in quality when < 0
        if ($this->item->sell_in < 0 && $this->item->quality < 50) {
            $this->item->quality += 1;
        }
    }
}