<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 19.41
 */

namespace App;


/**
 * Just for clarification,
 * an item can never have its Quality increase above 50,
 * however "Sulfuras" is a legendary item and as such its Quality is 80 and it never alters.
 *
 * Class Sulfuras
 * @package App
 */
class Sulfuras implements ItemInterface
{
    const SULFURAS_VALUE = 80;

    /** @var Item */
    private  $item;

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
        $this->item->quality = self::SULFURAS_VALUE;
    }
}