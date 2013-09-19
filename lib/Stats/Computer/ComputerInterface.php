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

interface ComputerInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param CollectionInterface $collection
     * @return mixed
     */
    public function supports(CollectionInterface $collection);

    /**
     * Initialize a State to be used by the handle
     *
     * @param State               $state
     * @param CollectionInterface $collection
     *
     * @return mixed
     */
    public function init(State $state, CollectionInterface $collection);

    /**
     * @param Entry $entry
     * @param State $state
     */
    public function handle(Entry $entry, State $state);

    /**
     * Compute the result
     *
     * @param State               $state
     * @param CollectionInterface $collection
     *
     * @return mixed
     */
    public function get(State $state, CollectionInterface $collection);
}