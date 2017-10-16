<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 2016/11/9
 * Time: 18:00
 */

namespace cdcchen\util\ds;

/**
 * Class ImmutableArray
 * @package cdcchen\util\ds
 */
class ImmutableArray implements Arrayable, \Countable, \ArrayAccess, \IteratorAggregate
{
    use ArrayTrait;

    /**
     * @var array
     */
    protected $container = [];


    /**
     * @param mixed $value
     * @param null|int|string $key
     * @return $this
     */
    public function add($value, $key = null)
    {
        if ($key === null) {
            $this->container[] = $value;
        } else {
            $this->container[$key] = $value;
        }

        return $this;
    }

    /**
     * @param $value
     * @param bool $strict
     * @return $this
     */
    public function remove($value, $strict = false)
    {
        $key = array_search($value, $this->container, $strict);
        if ($key !== false) {
            unset($this->container[$key]);
        }

        return $this;
    }

    /**
     * @param $value
     * @param bool $strict
     * @return $this
     */
    public function removeAll($value, $strict = false)
    {
        while ($key = array_search($value, $this->container, $strict) !== false) {
            unset($this->container[$key]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->container = [];
        return $this;
    }

    /**
     * @param $array
     * @return $this
     */
    public function extend($array)
    {
        if ($array instanceof self) {
            $array = $array->toArray();
        }
        if (!is_array($array)) {
            throw new \InvalidArgumentException('extend(x): x not a array');
        }

        $this->container = array_merge($this->container, $array);
        return $this;
    }


    /**
     * @param int $flags
     * @return bool
     */
    public function sort($flags = SORT_REGULAR)
    {
        return sort($this->container, $flags);
    }

    /**
     * @param int $flags
     * @return bool
     */
    public function reverseSort($flags = SORT_REGULAR)
    {
        return rsort($this->container, $flags);
    }

    /**
     * @param int $flags
     * @return bool
     */
    public function keySort($flags = SORT_REGULAR)
    {
        return ksort($this->container, $flags);
    }

    /**
     * @param int $flags
     * @return bool
     */
    public function keyReverseSort($flags = SORT_REGULAR)
    {
        return krsort($this->container, $flags);
    }

    /**
     * @param int $flags
     * @return bool
     */
    public function assocSort($flags = SORT_REGULAR)
    {
        return asort($this->container, $flags);
    }

    /**
     * @param int $flags
     * @return bool
     */
    public function assocReverseSort($flags = SORT_REGULAR)
    {
        return arsort($this->container, $flags);
    }

    /**
     * @param callable $callback
     * @return bool
     */
    public function userSort(callable $callback)
    {
        return usort($this->container, $callback);
    }

    /**
     * @param callable $callback
     * @return bool
     */
    public function userAssocSort(callable $callback)
    {
        return uasort($this->container, $callback);
    }

    /**
     * @param callable $callback
     * @return bool
     */
    public function userReverseSort(callable $callback)
    {
        return uksort($this->container, $callback);
    }

    /**
     * @return bool
     */
    public function natCaseSort()
    {
        return natcasesort($this->container);
    }

    /**
     * @return bool
     */
    public function natSort()
    {
        return natsort($this->container);
    }

    /**
     * @return bool
     */
    public function shuffle()
    {
        return shuffle($this->container);
    }

    /**
     * @param int $case
     * @return array
     */
    public function changeKeyCase($case = CASE_LOWER)
    {
        return $this->container = array_change_key_case($this->container, $case);
    }

    /**
     * @param $size
     * @param bool $preserveKeys
     * @return array
     */
    public function chunk($size, $preserveKeys = false)
    {
        return array_chunk($this->container, $size, $preserveKeys);
    }

    /**
     * @param $columnKey
     * @param null $indexKey
     * @return array
     */
    public function column($columnKey, $indexKey = null)
    {
        if ($indexKey) {
            return array_column($this->container, $columnKey, $indexKey);
        } else {
            return array_column($this->container, $columnKey);
        }
    }

    /**
     * @param $startIndex
     * @param $num
     * @param $value
     * @return $this
     */
    public function fill($startIndex, $num, $value)
    {
        $this->container = array_fill($startIndex, $num, $value);
        return $this;
    }

    /**
     * @param $keys
     * @param $value
     * @return $this
     */
    public function fillKeys($keys, $value)
    {
        $this->container = array_fill_keys($keys, $value);
        return $this;
    }

    /**
     * @return $this
     */
    public function flip()
    {
        $this->container = array_flip($this->container);
        return $this;
    }

    /**
     * @param callable|null $callback
     * @param int $flag
     * @return $this
     */
    public function filter(callable $callback = null, $flag = 0)
    {
        if ($callback === null) {
            $this->container = array_filter($this->container);
        } else {
            $this->container = array_filter($this->container, $callback, $flag);
        }

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function map(callable $callback)
    {
        $this->container = array_map($callback, $this->container);
        return $this;
    }

    /**
     * @param callable $callback
     * @param null $userData
     * @return $this
     */
    public function walk(callable $callback, $userData = null)
    {
        array_walk($this->container, $callback, $userData);
        return $this;
    }

    /**
     * @param array ...$array
     * @return $this
     */
    public function merge(...$array)
    {
        $this->container = array_merge($this->container, ...$array);
        return $this;
    }

    /**
     * @param array ...$array
     * @return $this
     */
    public function recursiveMerge(...$array)
    {
        $this->container = array_merge_recursive($this->container, ...$array);
        return $this;
    }

    /**
     * @param $size
     * @param $value
     * @return $this
     */
    public function pad($size, $value)
    {
        $this->container = array_pad($this->container, $size, $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->container);
    }

    /**
     * @param $value1
     * @param array ...$value
     * @return int
     */
    public function push($value1, ...$value)
    {
        return array_push($this->container, $value1, ...$value);
    }

    /**
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->container);
    }

    /**
     * @param $value1
     * @param array ...$value
     * @return int
     */
    public function unshift($value1, ...$value)
    {
        return array_unshift($this->container, $value1, ...$value);
    }

    /**
     * @param int $num
     * @return mixed
     */
    public function rand($num = 1)
    {
        return array_rand($this->container, $num);
    }

    /**
     * @param callable $callback
     * @param null $initial
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->container, $callback, $initial);
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return $this
     */
    public function replace($array1, ...$array)
    {
        $this->container = array_replace($this->container, $array1, ...$array);
        return $this;
    }

    /**
     * @param $array1
     * @param array ...$array
     * @return $this
     */
    public function recursiveReplace($array1, ...$array)
    {
        $this->container = array_replace_recursive($this->container, $array1, ...$array);
        return $this;
    }

    /**
     * @param bool $preserveKeys
     * @return $this
     */
    public function reverse($preserveKeys = false)
    {
        $this->container = array_reverse($this->container, $preserveKeys);
        return $this;
    }

    /**
     * @param $offset
     * @param null $length
     * @param bool $preserveKeys
     * @return array
     */
    public function slice($offset, $length = null, $preserveKeys = false)
    {
        return array_slice($this->container, $offset, $length, $preserveKeys);
    }

    /**
     * @param $offset
     * @param int $length
     * @param null $replacement
     * @return array
     */
    public function splice($offset, $length = 0, $replacement = null)
    {
        return array_slice($this->container, $offset, $length, $replacement);
    }

    /**
     * @param int $flag
     * @return $this
     */
    public function unique($flag = SORT_STRING)
    {
        $this->container = array_unique($this->container, $flag);
        return $this;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException('ImmutableArray does not support offsetSet.');
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        throw new \RuntimeException('ImmutableArray does not support offsetUnset.');
    }
}