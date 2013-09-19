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

interface ComputerInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * Initialize a State to be used by the handle
     *
     * @param State $state
     *
     * @return mixed
     */
    public function init(State $state);

    /**
     * @param Entry $entry
     * @param State $state
     */
    public function handle(Entry $entry, State $state);

    /**
     * @param State $state
     *
     * @return float
     */
    public function get(State $state);
}