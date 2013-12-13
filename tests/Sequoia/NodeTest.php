<?php

use Sequoia\Node;
use Sequoia\Tree;

class NodeTest extends \PHPUnit_Framework_TestCase
{
    public function testNodeGettersShouldReturnSettedValues()
    {
        $foo = new Node('foo', new Node('root'));
        $this->assertSame($foo->getLocalName(), 'foo');
        $this->assertSame($foo->getParent()->getLocalName(), 'root');
        $this->assertSame($foo->getPath(), 'root/foo');
    }

    public function testFindWithNullArgumentShouldReturnTheNode(){
    	 $foo = new Node('foo', new Node('root'));
    	 $this->assertSame($foo->find(null),$foo);
    }

    public function testFindWithSingleRelativePath(){
    	 $foo = new Node('foo', new Node('root'));
    	 $this->assertSame($foo->getParent()->find('foo'),$foo);
    }

    public function testFindWithPluralRelativePath(){
    	 $bar = new Node('bar', new Node('root'));
    	 $foo = new Node('foo', $bar);
    	 $fuu = new Node('fuu', $foo);
    	 $fii = new Node('fii', $bar);
    	 $this->assertSame($foo->getParent()->find('foo'),$foo);
    	 $this->assertSame($foo->getParent()->getParent()->find('bar'),$bar);
    	 $this->assertSame($foo->getParent()->getParent()->find('bar/foo'),$foo);
    	 $this->assertSame($foo->getParent()->getParent()->find('bar/fii'),$fii);
    	 $this->assertSame($foo->getParent()->getParent()->find('bar/foo/fuu'),$fuu);
    }

     public function testAppendSetParent(){
    	 $root = new Node('root');
    	 $foo = new Node('foo');
    	 $root->appendChild($foo);
    	 $this->assertSame($foo->getParent()->getLocalName(),'root');
    }
}
