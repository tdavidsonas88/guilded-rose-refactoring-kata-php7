<?php

namespace App;

final class GildedRose {

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
        if ($item->name =='Aged Brie') {

            if ($item->quality < 50) {
                $item->quality = $item->quality + 1;
            }

            $item->sell_in = $item->sell_in - 1;

            if ($item->sell_in < 0) {

                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
            }
        } else {

            if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
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
            } else {
                if ($item->name == 'Sulfuras, Hand of Ragnaros') {
                    if ($item->quality > 0) {
                        $item->quality = 80;
                    }

                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->sell_in = $item->sell_in - 1;
                    }

                    if ($item->sell_in < 0) {
                        if ($item->quality > 0) {
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    }
                } else {
                    if ($item->quality > 0) {
                        if ($item->name == 'Sulfuras, Hand of Ragnaros') {
                            $item->quality = 80;
                        } else {
                            $item->quality = $item->quality - 1;
                        }
                    }

                    if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                        $item->sell_in = $item->sell_in - 1;
                    }

                    if ($item->sell_in < 0) {
                        if ($item->quality > 0) {
                            if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    }
                }
            }


        }


    }
}

