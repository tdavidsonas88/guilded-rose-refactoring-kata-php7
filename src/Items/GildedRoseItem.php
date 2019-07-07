<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.7
 * Time: 10.02
 */

namespace App\Items;


use App\Item;
use App\ItemInterface;

abstract class GildedRoseItem
{
    /** @var Item */
    protected $item;

    /**
     * GildedRoseItem constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    public function qualityUp()
    {
        $this->item->quality += 1;
    }

    public function qualityDown()
    {
        $this->item->quality -=1;
    }

    public function sellInDown()
    {
        $this->item->sell_in -= 1;
    }

}