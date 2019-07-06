<?php

namespace App;

final class GildedRose {

    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes';
    const SULFURAS = 'Sulfuras';
    const CONJURED = 'Conjured';

    private $items = [];

    public function __construct($items) {
        $this->items = $items;
    }

    /**
     * @param $item
     */

    public function updateQuality() {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case self::AGED_BRIE:
                    $item = new AgedBrie($item);
                    break;
                case self::BACKSTAGE_PASSES:
                    $item = new BackstagePasses($item);
                    break;
                case self::SULFURAS:
                    $item = new Sulfuras($item);
                    break;
                case self::CONJURED:
                    $item = new Conjured($item);
                    break;
                default:
                    $item = new Unknown($item);
            }
            $item->doUpdateQuality();
        }
    }
}

