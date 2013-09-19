<?php

namespace Stats\Test;

use Stats\Entry;
use Stats\State;
use Stats\Computer\SumComputer;
use Stats\Computer\MinComputer;
use Stats\Computer\AvgComputer;
use Stats\Computer\GroupsComputer;
use Stats\Computer\PercentageComputer;

use Stats\Aggregator;

class ComputeTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $state = new State;
        $state->data = 1;

        $this->assertEquals(1, $state->data);

        $sum = new SumComputer();
        $min = new MinComputer();
        $avg = new AvgComputer();
        $group = new GroupsComputer(array('sum' => $sum, 'min' => $min, 'avg' => $avg));

        $collection = new Aggregator();
        $collection->addComputer('sum', $sum);
        $collection->addComputer('min', $min);
        $collection->addComputer('avg', $avg);
        $collection->addComputer('percent', new PercentageComputer());
        $collection->addComputer('groups', $group);

        for ($i = 0; $i < 250000; $i++) {
            $collection->addEntry(Entry::create('stat.value.' . rand(1, 10), rand(1, 100)));
        }

        foreach ($collection->getComputers() as $name => $meta) {
            list($computer, $state) = $meta;

            var_dump(sprintf("%s => %s", $name, json_encode($computer->get($state))));
        }
    }
}
