<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stats\Collection;

use Stats\Entry;

/**
 * This class is used to generated random value only
 */
class RandomCollection implements FixedCollectionInterface
{
    protected $length;

    protected $value;

    protected $pos;

    protected $keyname;

    /**
     * @param string $keyname
     * @param int $length
     */
    public function __construct($keyname = 'sonata.data', $length = 20000)
    {
        $this->length = $length;
        $this->kename = $keyname;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->value = Entry::create(sprintf($this->kename, rand(1, 20)), rand(1, 10000));
        $this->pos++;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->pos;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->pos < $this->length;
    }

    /**
    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->value = Entry::create(sprintf($this->kename, rand(1, 20)), rand(1, 10000));
        $this->pos = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function length()
    {
        return $this->length;
    }
}