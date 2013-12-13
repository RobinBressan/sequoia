<?php

use Sequoia\Node;
use Sequoia\Tree;

class TreeTest extends \PHPUnit_Framework_TestCase
{
    public function testTreeInstanciatedWithARootNodeReturnTheSameRootNode()
    {
        $rootNode = new Node('root');
        $tree = new Tree($rootNode);
        $this->assertSame($tree->getRootNode(), $rootNode);
    }
}
