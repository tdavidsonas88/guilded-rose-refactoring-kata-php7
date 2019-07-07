<?php
/**
 * Created by PhpStorm.
 * User: tadas
 * Date: 19.7.6
 * Time: 19.41
 */

namespace App;
use App\Items\GildedRoseItem;


/**
 * Just for clarification,
 * an item can never have its Quality increase above 50,
 * however "Sulfuras" is a legendary item and as such its Quality is 80 and it never alters.
 *
 * Class Sulfuras
 * @package App
 */
class Sulfuras extends GildedRoseItem implements ItemInterface
{
    const SULFURAS_VALUE = 80;

    public function doUpdateQuality()
    {
        $this->getItem()->quality = self::SULFURAS_VALUE;
    }
}