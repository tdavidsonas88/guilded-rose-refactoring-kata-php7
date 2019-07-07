<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 19.36
 */

namespace App;


use App\Items\GildedRoseItem;

class BackstagePasses extends GildedRoseItem
{

    public function doUpdateQuality()
    {
        if ($this->item->quality < 50) {
            $this->qualityUp();
            if ($this->item->sell_in < 11) {
                $this->qualityUp();
            }
            if ($this->item->sell_in < 6) {
                $this->qualityUp();;
            }
        }

        $this->sellInDown();

        if ($this->item->sell_in < 0) {
            // after concert drops to zero
            $this->item->quality = 0;
        }
    }
}