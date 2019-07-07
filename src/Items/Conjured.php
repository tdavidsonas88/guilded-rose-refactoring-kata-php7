<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 20.44
 */

namespace App;


use App\Items\GildedRoseItem;

class Conjured extends GildedRoseItem
{
    /**
     * "Conjured" items degrade in Quality twice as fast as normal items
     */
    public function doUpdateQuality()
    {
        $this->degradeInQualityTwiceAsFast();

        $this->sellInDown();

        if ($this->item->sell_in < 0) {
            $this->degradeInQualityTwiceAsFast();
        }
    }

    /**
     * @param Item $this->item
     */
    private function degradeInQualityTwiceAsFast(): void
    {
        if ($this->item->quality > 1) {
            $this->qualityDown();
            $this->qualityDown();
        } else if ($this->item->quality == 1) {
            $this->qualityDown();
        }
    }
}