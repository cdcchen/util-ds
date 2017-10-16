<?php
/**
 * Created by PhpStorm.
 * User: chendong
 * Date: 2017/10/15
 * Time: 23:19
 */

namespace cdcchen\util\ds;


/**
 * Interface Arrayable
 * @package cdcchen\util\ds
 */
interface Arrayable
{
    /**
     * @return array
     */
    public function toArray(): array;
}