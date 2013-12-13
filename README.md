Sequoia
=============

Basic object model to deal with tree

Installation
------------

The recommended way to install `sequoia` is through Composer. Just create a
``composer.json`` file, and run the ``composer install`` command to
install it:

```json
{
    "require": {
        "robinbressan/sequoia": "dev-master"
    }
}
```
Usage
-----

```php
$tree = new Tree(new Node('root'));

$foo = new Node('foo');
$tree->getRootNode()->appendChild($foo);

$bar = new Node('bar');
$foo->appendChild($bar);

// Returns $bar
$tree->getRootNode()->find('foo/bar');

```

License
-------

This library is available under the MIT License.
