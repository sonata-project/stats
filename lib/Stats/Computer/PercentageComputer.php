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
use Stats\Event\ComputeEvent;
use Stats\Exception\MissingAggregateValueException;
use Stats\State;
use Stats\Entry;

class PercentageComputer extends BaseComputer
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
    public function init(State $state, CollectionInterface $collection)
    {
        $state->total = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Entry $entry, State $state)
    {
        $state->total += $entry->value;
    }

    /**
     * {@inheritdoc}
     */
    public function get(State $state, CollectionInterface $collection)
    {
        return 0;
    }

    /**
     * @param ComputeEvent $event
     */
    public function compute(ComputeEvent $event)
    {
        $results = $event->getResults();

        $total = 0;
        foreach ($results->getGroups() as $group => $aggregatedData) {
            if (!isset($aggregatedData['sum'])) {
                throw new MissingAggregateValueException('The sum aggregate is missing');
            }

            $total += $aggregatedData['sum'];
        }

        foreach ($results->getGroups() as $group => $aggregatedData) {
            $aggregatedData['percent'] = $aggregatedData['sum'] / $total;

            $results->addGroup($group, $aggregatedData);
        }

        $event->setResults($results);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'stats.compute.post' => array('compute', 1)
        );
    }
}