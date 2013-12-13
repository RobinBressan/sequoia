<?php

namespace Sequoia;

class Collection
{
    private $items = array();

    private $count = 0;

    public function __construct(\Traversable $items = null)
    {
        if (!is_null($items)) {
            foreach ($items as $item) {
                $this->add($item);
            }
        }
    }

    public function add(CollectionItemInterface $item)
    {
        if (!array_key_exists($item->getLocalName(), $this->items)) {
            $this->items[$item->getLocalName()] = array();
        }

        $this->items[$item->getLocalName()][] = $item;
        $this->count++;
    }

    public function count($localName = null)
    {
        if (is_null($localName)) {
            return $this->count;
        }

        return count($this->items[$localName]);
    }

    public function get($localName)
    {
        if (!array_key_exists($localName, $this->items)) {
            return null;
        }

        if (count($this->items[$localName]) > 1) {
            return $this->items[$localName];
        } else {
            return $this->items[$localName][0];
        }
    }

    public function has($localName)
    {
        return array_key_exists($localName, $this->items);
    }

    public function remove(CollectionItemInterface $item)
    {
        if (!array_key_exists($localName, $this->items)) {
            throw new \InvalidArgumentException('The collection does not contain the item');
        }

        foreach ($this->items[$item->getLocalName()] as $key=>$localItem) {
            if ($localItem == $item) {
                unset($this->items[$item->getLocalName()][$key]);
                $this->count--;

                return true;
            }
        }

        throw new \InvalidArgumentException('The collection does not contain the item');
    }
}
