<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 16/9/8
 * Time: 15:47
 */

namespace cdcchen\util\ds;

use OutOfBoundsException;
use OutOfRangeException;

/**
 * Class CList
 * @package cdcchen\util\ds
 */
class ListArray extends Collection
{
    /**
     * CList constructor.
     * @param CollectionInterface|array $items
     */
    final public function __construct($items = [])
    {
        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }
        $this->container = array_values($items);
    }

    /**
     * @param int $index
     * @param $item
     * @return bool
     */
    final public function insert(int $index, $item): bool
    {
        if ($index < 0 || $index > $this->count()) {
            throw new OutOfBoundsException('index value is out of range.');
        }

        $chunks = array_chunk($this->container, $index);
        $chunks[0][] = $item;
        $this->container = array_merge(...$chunks);

        return true;
    }

    /**
     * @param int $index
     * @param $items
     * @return bool
     */
    final public function insertAll(int $index, $items): bool
    {
        if ($index < 0 || $index > $this->count()) {
            throw new OutOfBoundsException('index value is out of range.');
        }

        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }

        if (!empty($items)) {
            $chunks = array_chunk($this->container, $index);
            $chunks[0] = array_merge($chunks[0], array_values($items));
            $this->container = array_merge(...$chunks);
        }

        return true;
    }

    /**
     * @param mixed $item
     * @return bool
     */
    final public function add($item): bool
    {
        $this->container[] = $item;
        return true;
    }

    /**
     * @param $items
     * @return bool
     */
    final public function addAll($items): bool
    {
        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }

        if (!empty($items)) {
            $this->container = array_merge($this->container, array_values($items));
        }

        return true;
    }

    /**
     * @param int $index
     * @return mixed|null
     */
    final public function get(int $index)
    {
        if ($index < 0 || $index > $this->count()) {
            throw new OutOfBoundsException('index value is out of range.');
        }

        return $this->container[$index];
    }

    /**
     * @param int $index
     * @param mixed $item
     * @return mixed
     * @throws OutOfRangeException
     */
    final public function set(int $index, $item)
    {
        if ($index < 0 || $index > $this->count()) {
            throw new OutOfBoundsException('index value is out of range.');
        }

        $oldItem = $this->container[$index];
        $this->container[$index] = $item;

        return $oldItem;
    }

    /**
     * @param mixed $item
     * @param bool $strict
     * @return int Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element.
     */
    final public function indexOf($item, $strict = true): int
    {
        $key = array_search($item, $this->container, $strict);
        return $key === false ? -1 : $key;
    }

    /**
     * @param mixed $item
     * @param bool $strict
     * @return int Returns the index of the last occurrence of the specified element in this list, or -1 if this list does not contain the element.
     */
    final public function lastIndexOf($item, $strict = true): int
    {
        $keys = array_keys($this->container, $item, $strict);
        if (empty($keys)) {
            return -1;
        } else {
            return end($keys);
        }
    }

    /**
     * @param mixed $item
     * @param bool $strict
     * @return bool
     */
    final public function remove($item, $strict = true): bool
    {
        $container = $this->container;
        while (($index = array_search($item, $container, $strict)) !== false) {
            array_splice($container, $index, 1);
        }

        $this->container = $container;

        return true;
    }

    /**
     * @param CollectionInterface|array $items
     * @param bool $strict
     * @return bool
     */
    final public function removeAll($items, $strict = true): bool
    {
        if ($items instanceof CollectionInterface) {
            $items = $items->toArray();
        }

        if (!empty($items)) {
            $container = $this->container;
            foreach ($items as $item) {
                while (($index = array_search($item, $container, $strict)) !== false) {
                    unset($container[$index]);
                }
            }

            $this->container = array_values($container);
        }

        return true;
    }

    /**
     * @param int $index
     * @return bool
     */
    final public function removeIndex(int $index)
    {
        return $this->removeSlice($index, 1);
    }

    /**
     * @param int $offset
     * @param int $length
     * @return bool
     */
    final public function removeSlice(int $offset, int $length): bool
    {
        array_splice($this->container, $offset, $length);
        return true;
    }

    /**
     * @param int $offset
     * @param int $length
     * @return bool
     */
    final public function retainSlice(int $offset, int $length): bool
    {
        array_splice($this->container, $offset + $length);
        array_splice($this->container, 0, $offset);

        return true;
    }

    /**
     * @param int $offset
     * @param int $length
     * @return self
     * @throws OutOfBoundsException
     */
    final public function subList(int $offset, int $length): self
    {
        $list = new static();
        $list->addAll(array_slice($this->container, $offset, $length));

        return $list;
    }
}