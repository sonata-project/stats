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

use Stats\Collection\CollectionInterface;
use Stats\State;
use Stats\Entry;

class MinComputer extends BaseComputer
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'min';
    }

    /**
     * {@inheritdoc}
     */
    public function init(State $state, CollectionInterface $collection)
    {
        $state->min = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Entry $entry, State $state)
    {
        if ($state->min > $entry->value) {
            $state->min = $entry->value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(State $state, CollectionInterface $collection)
    {
        return $state->min;
    }
}