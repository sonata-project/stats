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

class AvgComputer implements ComputerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'avg';
    }

    /**
     * {@inheritdoc}
     */
    public function init(State $state)
    {
        $state->count = 0;
        $state->total = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Entry $entry, State $state)
    {
        $state->total += $entry->value;
        $state->count++;
    }

    /**
     * {@inheritdoc}
     */
    public function get(State $state)
    {
        return $state->total / $state->count;
    }
}