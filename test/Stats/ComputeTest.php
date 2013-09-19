<?php

namespace Stats\Test;

use Stats\Collection\RandomCollection;
use Stats\Computer\MaxComputer;
use Stats\Computer\StandardDeviationComputer;
use Stats\State;
use Stats\Computer\SumComputer;
use Stats\Computer\MinComputer;
use Stats\Computer\AvgComputer;
use Stats\Computer\GroupsComputer;
use Stats\Computer\PercentageComputer;

class ComputeTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $aggregator = new GroupsComputer(array(
            new SumComputer(),
            new MinComputer(),
            new MaxComputer(),
            new AvgComputer(),
            new PercentageComputer(), // required the SumComputer,
            new StandardDeviationComputer(),
        ));

        $collection = new RandomCollection("sonata.data.%s", 250000);

        $this->assertTrue($aggregator->supports($collection));

        $aggregator->init($state = new State, $collection);

        foreach ($collection as $entry) {
            $aggregator->handle($entry, $state);
        }

        foreach ($aggregator->get($state, $collection)->getGroups() as $name => $meta) {
            var_dump(sprintf("group: %s => %s", $name, json_encode($meta)));
        }

        foreach ($aggregator->get($state, $collection)->getMetas() as $name => $meta) {
            var_dump(sprintf("meta: %s => %s", $name, json_encode($meta)));
        }
    }
}