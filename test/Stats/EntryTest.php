<?php

namespace Stats\Test;

use Stats\Entry;

class EntryTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $time = time();

        $entry = Entry::create('sonata.user.created.daily', 1, $time);

        $this->assertEquals('sonata.user.created.daily', $entry->name);
        $this->assertEquals(1, $entry->value);
        $this->assertEquals($time, $entry->timestamp);
    }
}
