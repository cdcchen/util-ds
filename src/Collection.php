<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 16/9/8
 * Time: 15:47
 */

namespace cdcchen\util\ds;

use OutOfBoundsException;

/**
 * Class CBaseList
 * @package cdcchen\util\ds
 */
abstract class Collection implements CollectionInterface
{
    /**
     * @var array
     */
    protected $container = [];


    /**
     * Clear all items
     */
    public function clear(): void
    {
        $this->container = [];
    }

    /**
     * @param mixed $item
     * @param bool $strict
     * @return bool
     */
    final public function contains($item, $strict = true): bool
    {
        return in_array($item, $this->container, $strict);
    }

    /**
     * @param CollectionInterface|array $items
     * @param bool $strict
     * @return bool
     */
    final public function containsAll($items, $strict = true): bool
    {
        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }
        foreach ($items as $item) {
            if (!in_array($item, $this->container, $strict)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param CollectionInterface|array $items
     * @param bool $strict
     * @return bool
     */
    final public function retainAll($items, $strict = true): bool
    {
        if ($items instanceof Arrayable) {
            $items = $items->toArray();
        }

        if (empty($items)) {
            $this->clear();
            return true;
        }

        $container = $this->container;
        foreach ($container as $index => $item) {
            if (!in_array($item, $items, $strict)) {
                unset($container[$index]);
            }
        }

        $this->container = array_values($container);

        return true;
    }

    /**
     * @param CollectionInterface $c
     * @return bool
     */
    final public function equals(CollectionInterface $c): bool
    {
        return $this->hashCode() === $c->hashCode();
    }

    /**
     * @return string
     */
    final public function hashCode(): string
    {
        return spl_object_hash($this);
    }

    /**
     * @return bool
     */
    final public function isEmpty(): bool
    {
        return empty($this->container);
    }

    /**
     * @return \ArrayIterator
     */
    final public function getIterator()
    {
        return new \ArrayIterator($this->container);
    }

    /**
     * @return int
     */
    final public function count(): int
    {
        return count($this->container);
    }

    /**
     * @return array
     */
    final public function toArray(): array
    {
        return $this->container;
    }

    /**
     * @param int $fromIndex
     * @param int $toIndex
     * @return bool
     */
    protected function removeByIndexRange(int $fromIndex, int $toIndex): bool
    {
        if ($fromIndex > $toIndex) {
            throw new OutOfBoundsException('An illegal endpoint index value');
        }

        array_splice($this->container, $fromIndex, $toIndex - $fromIndex + 1);
        return true;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize($this->container);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->container = unserialize($serialized);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->container;
    }
}