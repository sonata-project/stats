<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stats;

final class Entry
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $value;

    /**
     * @var int
     */
    public $timestamp;

    private function __construct()
    {}

    /**
     * @param string $name
     * @param float  $value
     * @param int    $timestamp
     *
     * @return Entry
     */
    static public function create($name, $value, $timestamp = null)
    {
        $entry = new Entry;
        $entry->name = $name;
        $entry->value = $value;
        $entry->timestamp = $timestamp ?: time();

        return $entry;
    }
}
