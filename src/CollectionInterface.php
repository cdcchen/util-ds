<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 2017/10/13
 * Time: 12:08
 */

namespace cdcchen\util\ds;


/**
 * Interface CollectionInterface
 * @package cdcchen\util\ds
 */
interface CollectionInterface extends Arrayable, \Countable, \IteratorAggregate, \Serializable, \JsonSerializable
{
    /**
     * @param $item
     * @return bool
     */
    public function add($item): bool;

    /**
     * @param CollectionInterface|array $items
     * @return bool
     */
    public function addAll($items): bool;

    /**
     *
     */
    public function clear(): void;

    /**
     * @param $item
     * @return bool
     */
    public function contains($item): bool;

    /**
     * @paramCollectionInterface|array $items
     * @return bool
     */
    public function containsAll($items): bool;

    /**
     * @param CollectionInterface $c
     * @return bool
     */
    public function equals(CollectionInterface $c): bool;

    /**
     * @return string
     */
    public function hashCode(): string ;

    /**
     * @return bool
     */
    public function isEmpty(): bool ;

    /**
     * @param $item
     * @param bool $strict
     * @return bool
     */
    public function remove($item, $strict = true): bool;

    /**
     * @paramCollectionInterface|array $items
     * @param bool $strict
     * @return bool
     */
    public function removeAll($items, $strict = true): bool;

    /**
     * @paramCollectionInterface|array $items
     * @return bool
     */
    public function retainAll($items): bool;
}