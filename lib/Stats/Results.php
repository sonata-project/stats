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

class Results
{
    protected $groups = array();

    protected $metas = array();

    /**
     * @param $name
     * @param $value
     */
    public function addMeta($name, $value)
    {
        $this->metas[$name] = $value;
    }

    /**
     * @param $name
     * @param $value
     */
    public function addGroup($name, $value)
    {
        $this->groups[$name] = $value;
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @return array
     */
    public function getMetas()
    {
        return $this->metas;
    }

    public function getMeta($name)
    {
        return $this->metas[$name];
    }

    public function getGroup($name)
    {
        return $this->groups[$name];
    }
}