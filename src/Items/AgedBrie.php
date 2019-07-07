<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 12.21
 */

namespace App;


use App\Items\GildedRoseItem;

class AgedBrie extends GildedRoseItem implements ItemInterface
{

    public function doUpdateQuality()
    {
        if ($this->item->quality < 50) {
            $this->qualityUp();
        }
        $this->sellInDown();
        // degrades twice as fast in quality when < 0
        if ($this->item->sell_in < 0 && $this->item->quality < 50) {
            $this->qualityUp();
        }
    }
}