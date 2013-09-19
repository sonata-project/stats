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
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class BaseComputer implements ComputerInterface, EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(CollectionInterface $collection)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function init(State $state, CollectionInterface $collection)
    {}

    /**
     * {@inheritdoc}
     */
    public function handle(Entry $entry, State $state)
    {}

    /**
     * {@inheritdoc}
     */
    public function get(State $state, CollectionInterface $collection)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array();
    }
}