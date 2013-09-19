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

use Stats\Event\ComputeEvent;
use Stats\Exception\MissingAggregateValueException;

class StandardDeviationComputer extends BaseComputer
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'standard_deviation';
    }

    /**
     * @param ComputeEvent $event
     *
     * @throws \Stats\Exception\MissingAggregateValueException
     */
    public function compute(ComputeEvent $event)
    {
        $results = $event->getResults();

        $total = 0;
        $data = array();
        foreach ($results->getGroups() as $group => $aggregatedData) {
            if (!isset($aggregatedData['avg'])) {
                throw new MissingAggregateValueException('The average aggregate value is missing');
            }

            $total += $aggregatedData['avg'];
            $data[] =  $aggregatedData['avg'];

            unset($aggregatedData['standard_deviation']);

            $results->addGroup($group, $aggregatedData);
        }

        $avg = $total / count($data);

        $total = 0;
        foreach ($data as $v) {
            $total += ($v - $avg)^2;
        }

        $result = sqrt($total / count($data));

        $results->addMeta($this->getName(), $result === NAN ? 0 : $result);
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