<?php

namespace Sequoia;

class Node implements NodeInterface, CollectionItemInterface
{
	private $localName;

	private $parent;

	private $children;

	public function __construct($localName, NodeInterface $parent = null){
		$this->localName = $localName;
		$this->parent = $parent;
		if(!is_null($this->parent)){
			$this->parent->appendChild($this);
			$this->path = sprintf('%s/%s',$this->parent->getPath(), $this->localName);
		}else{
			$this->path = $this->localName;
		}

		$this->children = new Collection();
	}

	public function appendChild(NodeInterface $node){
		$node->setParent($this);
		$this->children->add($node);

		return $this;
	}

	public function find($relativePath = null){
		if(is_null($relativePath)){
			return $this;
		}elseif(strpos($relativePath,'/') === false){
			return $this->getChild($relativePath);
		}else{
			$chain = explode('/', $relativePath);
			$child = $this->getChild($chain[0]);

			if(is_null($child)){
				throw new \InvalidArgumentException('The node does not exist');
			}

			array_shift($chain);

			if(count($chain) == 0){
				$chain = null;
			}else{
				$chain = implode('/', $chain);
			}

			if(is_array($child)){
				$return = array();

				foreach($child as $subChild){
					$return[] = $subChild->find($chain);
				}

				return $return;
			}else{
				return $child->find($chain);
			}
		}
	}

	public function getChild($name){
		return $this->children->get($name);
	}

	public function getLocalName(){
		return $this->localName;
	}

	public function setLocalName($localName){
		$this->localName = $localName;

		return $this;
	}

	public function getParent(){
		return $this->parent;
	}

	public function setParent(NodeInterface $parent){
		$this->parent = $parent;

		return $this;
	}

	public function getPath(){
		return $this->path;
	}

	public function removeChild(NodeInterface $node){
		return $this->children->remove($node);
	}
}
