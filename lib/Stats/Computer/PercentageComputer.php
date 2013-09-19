<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stats\Computer;

use Stats\State;
use Stats\Entry;

class PercentageComputer implements ComputerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'percent';
    }

    /**
     * {@inheritdoc}
     */
    public function init(State $state)
    {
        $state->groups = array();
        $state->total = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Entry $entry, State $state)
    {
        if (!isset($state->groups[$entry->name])) {
            $state->groups[$entry->name] = 0;
        }

        $state->groups[$entry->name] += $entry->value;
        $state->total += $entry->value;
    }

    /**
     * {@inheritdoc}
     */
    public function get(State $state)
    {
        $results = array();

        foreach($state->groups as $name => $total) {
            $results[$name] = $total / $state->total;
        }

        return $results;
    }
}