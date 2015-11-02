<?php
namespace Del\Entity;


interface HydratableInterface
{
    /**
     * @param array $array
     * @return mixed
     */
    public function setFromArray(array $array);

    /**
     * @return array
     */
    public function toArray();
}