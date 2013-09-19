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

class GroupsComputer implements ComputerInterface
{
    protected $computers;

    /**
     * @param array $computers
     */
    public function __construct(array $computers = array())
    {
        foreach ($computers as $name => $computer) {
            $this->addComputer($name, $computer);
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
    public function init(State $state)
    {
        $state->groups = array();
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Entry $entry, State $state)
    {
        $this->initGroup($state, $entry->name);

        foreach ($this->computers as $code => $computer) {
            $computer->handle($entry, $state->groups[$entry->name][$code]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get(State $state)
    {
        return $state->groups;
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

            $computer->init($childState);

            $state->groups[$name][$code] = $childState;
        }
    }

    public function addComputer($code, ComputerInterface $listener)
    {
        $this->computers[$code] = $listener;
    }
}