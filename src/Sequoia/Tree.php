<?php

namespace Sequoia;

class Tree implements TreeInterface
{
    private $rootNode;

    public function __construct(NodeInterface $rootNode)
    {
        $this->rootNode = $rootNode;
    }

    public function getRootNode()
    {
        return $this->rootNode;
    }
}
