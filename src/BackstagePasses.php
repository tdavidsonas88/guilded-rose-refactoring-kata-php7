<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 19.36
 */

namespace App;


class BackstagePasses implements ItemInterface
{
    /** @var Item */
    private $item;

    /**
     * BackstagePasses constructor.
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
            if ($this->item->sell_in < 11) {
               $this->item->quality += 1;
            }
            if ($this->item->sell_in < 6) {
                $this->item->quality += 1;
            }
        }

        $this->item->sell_in -= 1;

        if ($this->item->sell_in < 0) {
            // after concert drops to zero
            $this->item->quality = 0;
        }
    }
}