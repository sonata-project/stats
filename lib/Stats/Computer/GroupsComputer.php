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
use Stats\Event\DataEvent;
use Stats\Event\ComputeEvent;
use Stats\Results;
use Stats\State;
use Stats\Entry;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GroupsComputer implements ComputerInterface
{
    protected $computers;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * @param array           $computers
     * @param EventDispatcher $dispatcher
     */
    public function __construct(array $computers = array(), EventDispatcher $dispatcher = null)
    {
        $this->dispatcher = $dispatcher ?: new EventDispatcher();

        foreach ($computers as $computer) {
            $this->addComputer($computer);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function supports(CollectionInterface $collection)
    {
        foreach ($this->computers as $computer) {
            if (!$computer->supports($collection)) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function init(State $state, CollectionInterface $collection)
    {
        $state->groups = array();
        $state->collection =& $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Entry $entry, State $state)
    {
        $this->initGroup($state, $entry->name);

        foreach ($this->computers as $code => $computer) {
            $computer->handle($entry, $state->groups[$entry->name][$code]);

            if ($this->dispatcher) {
                $this->dispatcher->dispatch('stats.handle', new DataEvent($this));
            }

        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(State $state, CollectionInterface $collection)
    {
        $results = new Results();

        foreach ($state->groups as $name => $childStates) {
            $r = array();
            foreach ($childStates as $code => $childState) {
                $r[$code] = $this->computers[$code]->get($childState, $collection);
            }

            $results->addGroup($name, $r);
        }

        if ($this->dispatcher) {
            $this->dispatcher->dispatch('stats.compute.post', new ComputeEvent($state, $collection, $results));
        }

        return $results;
    }

    /**
     * Initialize a new group with a state from the different computers
     *
     * @param State  $state
     * @param string $name
     */
    protected function initGroup(State $state, $name)
    {
        if (isset($state->groups[$name])) {
            return;
        }

        $state->groups[$name] = array();

        foreach ($this->computers as $code => $computer) {
            $childState = new State;

            $computer->init($childState, $state->collection);

            $state->groups[$name][$code] = $childState;
        }
    }

    /**
     * @param ComputerInterface $computer
     */
    public function addComputer(ComputerInterface $computer)
    {
        $this->computers[$computer->getName()] = $computer;

        if ($this->dispatcher) {
            $this->dispatcher->addSubscriber($computer);
        }
    }
}