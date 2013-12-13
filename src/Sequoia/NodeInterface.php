<?php

namespace Sequoia;

interface NodeInterface extends FinderInterface
{
    public function appendChild(NodeInterface $node);

    public function getChild($name);

    public function getLocalName();

    public function getParent();

    public function getPath();

    public function removeChild(NodeInterface $node);
}
