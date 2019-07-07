<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 19.46
 */

namespace App;


use App\Items\GildedRoseItem;

class Unknown extends GildedRoseItem implements ItemInterface
{

    public function doUpdateQuality()
    {
        if ($this->item->quality > 0) {
            $this->item->quality -= 1;
        }

        $this->item->sell_in -= 1;

        if ($this->item->sell_in < 0 && $this->item->quality > 0) {
            $this->item->quality -= 1;
        }
    }
}