<?php

namespace Zrnik\Menu;

use Nette\ComponentModel\IComponent;
use Nette\ComponentModel\IContainer;

class Url extends \Nette\Http\Url implements IComponent
{
    public function __construct(string $url, public string $label)
    {
        parent::__construct($url);
    }

    /**
     * @var mixed|IContainer|null
     */
    private $parent;
    /**
     * @var mixed|string|null
     */
    private $name;

    function getName(): ?string
    {
        return $this->name;
    }

    function getParent(): ?IContainer
    {
        return $this->parent;
    }

    function setParent(?IContainer $parent, string $name = null): static
    {
        $this->parent = $parent;
        $this->name = $name;
        return $this;
    }
}
