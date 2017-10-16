<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 16/9/8
 * Time: 15:47
 */

namespace cdcchen\util\ds;


/**
 * Class CSet
 * @package cdcchen\util\ds
 */
class SetArray extends Collection
{
    /**
     * CSet constructor.
     * @param array $items
     */
    final public function __construct($items = [])
    {
        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }
        $this->container = array_unique(array_values($items), SORT_REGULAR);
    }

    /**
     * @param mixed $item
     * @return bool
     */
    final public function add($item): bool
    {
        if (in_array($item, $this->container, true)) {
            return false;
        }
        $this->container[] = $item;

        return true;
    }

    /**
     * @param array|CollectionInterface $items
     * @return bool
     */
    final public function addAll($items): bool
    {
        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }
        if (!empty($items)) {
            $this->container = array_unique(array_merge($this->container, array_values($items)), SORT_REGULAR);
        }

        return true;
    }

    /**
     * @param mixed $item
     * @param bool $strict
     * @return bool
     */
    final public function remove($item, $strict = true): bool
    {
        if (($index = array_search($item, $this->container, $strict)) !== false) {
            array_splice($this->container, $index, 1);
        }

        return true;
    }

    /**
     * @param CollectionInterface|array $items
     * @param bool $strict
     * @return bool
     */
    final public function removeAll($items, $strict = true): bool
    {
        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }

        if (!empty($items)) {
            $container = $this->container;
            foreach ($items as $item) {
                if (($index = array_search($item, $container, $strict)) !== false) {
                    unset($container[$index]);
                }
            }
            $this->container = array_values($container);
        }

        return true;
    }
}