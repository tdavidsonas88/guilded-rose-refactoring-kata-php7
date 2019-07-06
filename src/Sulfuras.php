<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 19.41
 */

namespace App;


class Sulfuras implements ItemInterface
{
    /** @var Item */
    private $item;

    /**
     * Sulfuras constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function doUpdateQuality()
    {
        if ($this->item->quality > 0) {
            $this->item->quality = 80;
        }
    }
}