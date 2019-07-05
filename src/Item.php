<?php

namespace App;

/**
 *  do not alter the Item class or Items property as those belong to the
    goblin in the corner who will insta-rage and one-shot you as he doesn't believe in shared code
    ownership (
 *  you can make the UpdateQuality method and Items property static if you like, we'll cover
    for you).
 *
 * Class Item
 * @package App
 */
final class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name    = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
}

