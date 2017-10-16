<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 2017/10/13
 * Time: 13:44
 */

namespace cdcchen\util\ds;


trait ArrayTrait
{
    /**
     * constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->container = $items;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->container);
    }

    /**
     * @param $value
     * @param bool $strict
     * @return bool
     */
    public function contains($value, $strict = false)
    {
        return in_array($value, $this->container, $strict);
    }

    /**
     * @return array
     */
    public function keys()
    {
        return array_keys($this->container);
    }

    /**
     * @return array
     */
    public function values()
    {
        return array_values($this->container);
    }

    /**
     * @return array
     */
    public function valuesCount()
    {
        return array_count_values($this->container);
    }

    /**
     * @param $value
     * @return int
     */
    public function valueCount($value)
    {
        $counters = array_count_values($this->container);
        return $counters[$value] ?? 0;
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function diff($array1, ...$array)
    {
        return array_diff($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function diffAssoc($array1, ...$array)
    {
        return array_diff_assoc($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function diffKey($array1, ...$array)
    {
        return array_diff_key($this->container, $array1, ...$array);
    }

    /**
     * @param callable $callback
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function diffUserKey(callable $callback, $array1, ...$array)
    {
        $array[] = $callback;
        return array_diff_ukey($this->container, $array1, ...$array);
    }

    /**
     * @param callable $callback
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function diffUserAssoc(callable $callback, $array1, ...$array)
    {
        $array[] = $callback;
        return array_diff_uassoc($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param callable $callback
     * @param array ...$array
     * @return array
     */
    public function userDiff($array1, callable $callback, ...$array)
    {
        $array[] = $callback;
        return array_udiff($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param callable $callback
     * @param array ...$array
     * @return array
     */
    public function userDiffAssoc($array1, callable $callback, ...$array)
    {
        $array[] = $callback;
        return array_udiff_assoc($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param callable $dataCompareCallback
     * @param callable $keyCompareCallback
     * @param array ...$array
     * @return array
     */
    public function userDiffUserAssoc($array1, callable $dataCompareCallback, callable $keyCompareCallback, ...$array)
    {
        $array[] = $dataCompareCallback;
        $array[] = $keyCompareCallback;
        return array_udiff_uassoc($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function intersect($array1, ...$array)
    {
        return array_intersect($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function intersectAssoc($array1, ...$array)
    {
        return array_intersect_assoc($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function intersectKey($array1, ...$array)
    {
        return array_intersect_key($this->container, $array1, ...$array);
    }

    /**
     * @param callable $callback
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function intersectUserKey(callable $callback, $array1, ...$array)
    {
        $array[] = $callback;
        return array_intersect_ukey($this->container, $array1, ...$array);
    }

    /**
     * @param callable $callback
     * @param $array1
     * @param array ...$array
     * @return array
     */
    public function intersectUserAssoc(callable $callback, $array1, ...$array)
    {
        $array[] = $callback;
        return array_intersect_uassoc($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param callable $callback
     * @param array ...$array
     * @return array
     */
    public function userIntersect($array1, callable $callback, ...$array)
    {
        $array[] = $callback;
        return array_uintersect($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param callable $callback
     * @param array ...$array
     * @return array
     */
    public function userIntersectAssoc($array1, callable $callback, ...$array)
    {
        $array[] = $callback;
        return array_uintersect_assoc($this->container, $array1, ...$array);
    }

    /**
     * @param $array1
     * @param callable $dataCompareCallback
     * @param callable $keyCompareCallback
     * @param array ...$array
     * @return array
     */
    public function userIntersectUserAssoc(
        $array1,
        callable $dataCompareCallback,
        callable $keyCompareCallback,
        ...$array
    ) {
        $array[] = $dataCompareCallback;
        $array[] = $keyCompareCallback;
        return array_uintersect_uassoc($this->container, $array1, ...$array);
    }

    /**
     * @param $key
     * @return bool
     */
    public function keyExist($key)
    {
        return array_key_exists($key, $this->container);
    }

    /**
     * @return number
     */
    public function product()
    {
        return array_product($this->container);
    }

    /**
     * @return number
     */
    public function sum()
    {
        return array_sum($this->container);
    }

    /**
     * @param $value
     * @param bool $strict
     * @return mixed
     */
    public function search($value, $strict = false)
    {
        return array_search($value, $this->container, $strict);
    }


    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->container);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->container);
    }

    /**
     * @return mixed
     */
    public function prev()
    {
        return prev($this->container);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->container);
    }

    /**
     * @return mixed
     */
    public function end()
    {
        return end($this->container);
    }

    /**
     * @return mixed
     */
    public function reset()
    {
        return reset($this->container);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset];
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->container);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->container);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->container;
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