<?php

namespace App;

final class GildedRose {

    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    /**
     * @param $item
     */

    public function updateQuality() {
        foreach ($this->items as $item) {
            $this->doUpdateQuality($item);
        }
    }

    /**
     * @param $item
     */
    private function doUpdateQuality($item): void
    {
        switch ($item->name) {
            case self::AGED_BRIE :
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
                $item->sell_in = $item->sell_in - 1;

                if ($item->sell_in < 0) {

                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
                break;
            case self::BACKSTAGE_PASSES:
               if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->sell_in < 11) {
                        if ($item->quality < 50) {
                            $item->quality = $item->quality + 1;
                        }
                    }
                    if ($item->sell_in < 6) {
                        if ($item->quality < 50) {
                            $item->quality = $item->quality + 1;
                        }
                    }
                }

                $item->sell_in = $item->sell_in - 1;

                if ($item->sell_in < 0) {
                    $item->quality = $item->quality - $item->quality;
                }
                break;
            case self::SULFURAS:
                if ($item->quality > 0) {
                    $item->quality = 80;
                }
                break;
            default:
                if ($item->quality > 0) {
                    $item->quality = $item->quality - 1;
                }

                $item->sell_in = $item->sell_in - 1;

                if ($item->sell_in < 0) {
                    if ($item->quality > 0) {
                        if (true) {
                            $item->quality = $item->quality - 1;
                        }
                    }
                }
        }

    }
}

