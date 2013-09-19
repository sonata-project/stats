<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stats\Event;

use Stats\Collection\CollectionInterface;
use Stats\Results;
use Stats\State;
use Symfony\Component\EventDispatcher\Event;

/**
 * This event is used when the final computation has been done. This event
 * can be used when events required other values computed by anothers computers
 */
class ComputeEvent extends Event
{
    protected $state;

    protected $collection;

    protected $results;

    /**
     * @param State               $state
     * @param CollectionInterface $collection
     * @param Results             $results
     */
    public function __construct(State $state, CollectionInterface $collection, Results $results)
    {
        $this->state = $state;
        $this->collection = $collection;
        $this->results = $results;
    }

    /**
     * @return \Stats\Collection\CollectionInterface
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param Results $results
     */
    public function setResults(Results $results)
    {
        $this->results = $results;
    }

    /**
     * @return Results
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return \Stats\State
     */
    public function getState()
    {
        return $this->state;
    }
}
