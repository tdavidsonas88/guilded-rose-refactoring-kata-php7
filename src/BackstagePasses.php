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
                if ($this->item->quality < 50) {
                    $this->item->quality += 1;
                }
            }
            if ($this->item->sell_in < 6) {
                if ($this->item->quality < 50) {
                    $this->item->quality += 1;
                }
            }
        }

        $this->item->sell_in -= 1;

        if ($this->item->sell_in < 0) {
            // todo: kazkaip keistai kodas atrodo!
            $this->item->quality = $this->item->quality - $this->item->quality;
        }
    }
}