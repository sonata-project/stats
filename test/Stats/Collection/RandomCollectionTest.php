<?php

namespace Stats\Test;

use Stats\Collection\RandomCollection;

class RandomCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $collection = new RandomCollection('myname.%s', 20);

        $pos = 0;
        foreach ($collection as $entry) {
            $this->assertInstanceOf('Stats\Entry', $entry);
            $pos++;
        }

        $this->assertEquals(20, $pos);
        $this->assertEquals(20, $collection->length());
    }
}
