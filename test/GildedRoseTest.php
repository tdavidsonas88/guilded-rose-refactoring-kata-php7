<?php

namespace App;

use \PHPUnit\Framework\TestCase;

/**
 * Class GildedRoseTest
 * @package App
 */
class GildedRoseTest extends TestCase {


    private function runUpdateQuality(string $name, int $sellIn, int $quality)
    {
        /** @var Item[] $items */
        $items = [new Item($name, $sellIn, $quality)];
        $gildedRoseApp = new GildedRose($items);
        $gildedRoseApp->updateQuality();
        return $items[0]->__toString();
    }
    
    // At the end of each day our system lowers both values for every item
    function testAtTheEndOfEachDaySystemLowersValuesForEveryItem() {
        $itemString = $this->runUpdateQuality('foo', 2, 5);
        $this->assertSame('foo, 1, 4', $itemString);
    }
    // - Once the sell by date has passed, Quality degrades twice as fast
    function testOnceTheSellByDateHasPassedQualityDegradesTwiceAsFast(){
        $items = array(new Item("foo", 2, 5));
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(4, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(3, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(1, $items[0]->quality);
    }
    // The Quality of an item is never negative
    function testTheQualityOfItemIsNeverNegative(){
        $items = array(new Item("foo", 2, 5));
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(4, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(3, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(1, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }
    //- "Aged Brie" actually increases in Quality the older it gets
    function testAgeBrieQualityIncreasesTheOlderItGets() {
        $items = array(new Item("Aged Brie", 2, 5));
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(6, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(7, $items[0]->quality);
        //  'Aged Brie' increases by Two in quality after sell_in finished
        // nothing mentioned in the task but this is how it behaves
        $gildedRose->updateQuality();
        $this->assertEquals(9, $items[0]->quality);
    }
    // The Quality of an item is never more than 50
    function testQualityOfAnItemIsNeverMoreThan50() {
        $items = array(
            new Item("foo", 2, 50),
            new Item("Aged Brie", 2, 50),
            new Item("Sulfuras, Hand of Ragnaros", 2, 80),
            new Item("Backstage passes to a TAFKAL80ETC concert", 2, 50),
            new Item("Conjured Mana Cake", 2, 50),
        );
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(49, $items[0]->quality);
        $this->assertEquals(50, $items[1]->quality);
        $this->assertEquals(80, $items[2]->quality);
        $this->assertEquals(50, $items[3]->quality);
        $this->assertEquals(49, $items[4]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[1]->quality);
        $this->assertEquals(80, $items[2]->quality);
        $this->assertEquals(50, $items[3]->quality);
        $this->assertEquals(48, $items[4]->quality);
    }
    // - "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
    function testSulfurasNeverSoldOrDecreaseInQuality(){
        $items = array(
            new Item("Sulfuras, Hand of Ragnaros", 2, 30)
        );
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
        $gildedRose->updateQuality();
        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(2, $items[0]->sell_in);
    }
    /**
     * - "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
    Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but
    Quality drops to 0 after the concert
     */

    function testBackstagePasses(){
        $items = array(
            new Item("Backstage passes to a TAFKAL80ETC concert", 11, 30),
        );
        $gildedRose = new GildedRose($items);
        // 11
        $gildedRose->updateQuality();
        $this->assertEquals(10, $items[0]->sell_in);
        $this->assertEquals(31, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(9, $items[0]->sell_in);
        $this->assertEquals(33, $items[0]->quality);

        $gildedRose->updateQuality();
        $this->assertEquals(8, $items[0]->sell_in);
        $this->assertEquals(35, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(7, $items[0]->sell_in);
        $this->assertEquals(37, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(6, $items[0]->sell_in);
        $this->assertEquals(39, $items[0]->quality);
        // 6
        $gildedRose->updateQuality();
        $this->assertEquals(5, $items[0]->sell_in);
        $this->assertEquals(41, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(4, $items[0]->sell_in);
        $this->assertEquals(44, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(3, $items[0]->sell_in);
        $this->assertEquals(47, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(2, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(1, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->sell_in);
        $this->assertEquals(50, $items[0]->quality);
        // concert
        $gildedRose->updateQuality();
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(0, $items[0]->quality);
    }
    // 	- "Conjured" items degrade in Quality twice as fast as normal items
    function testConjuredItemsDegradeInQualityTwiceAsFast(){
        $items = array(
            new Item("Conjured Mana Cake", 2, 30)
        );
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(28, $items[0]->quality);

        $gildedRose->updateQuality();
        $this->assertEquals(26, $items[0]->quality);
    }
}
