<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stats;

use Stats\Computer\ComputerInterface;
use Stats\Entry;

class Aggregator
{
    protected $computers = array();

    /**
     * @param string            $code
     * @param ComputerInterface $listener
     */
    public function addComputer($code, ComputerInterface $listener)
    {
        $state = new State;
        $listener->init($state);

        $this->computers[$code] = array($listener, $state);
    }

    /**
     * @param Entry $entry
     */
    public function addEntry(Entry $entry)
    {
        foreach ($this->computers as $code => $meta) {
            list($listener, $state) = $meta;

            $listener->handle($entry, $state);
        }
    }

    /**
     * @return array
     */
    public function getComputers()
    {
        return $this->computers;
    }
}