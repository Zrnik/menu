<?php


namespace Zrnik\Menu;


use InvalidArgumentException;
use Nette\ComponentModel\Container;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Strings;

class Menu extends Container
{

    public final function __construct(public ?string $label = null)
    {
    }

    private static function nameFromLabel(?string $label): ?string
    {
        if($label !== null)
            return Strings::replace(Strings::webalize($label), "/-/", "");

        return null;
    }

    public function addComponent(IComponent $component, ?string $name, string $insertBefore = null): static
    {

        if (
            !($component instanceof Menu)
            &&
            !($component instanceof Url)
        )
            throw new InvalidArgumentException(
                sprintf(
                    "Component argument expected to be '%s' or '%s', got '%s' instead.",
                    Menu::class, Url::class, get_debug_type($component)
                )
            );

        return parent::addComponent($component, $name, $insertBefore);
    }

    public function addLink(string $label, string $url): static
    {
        $this->addComponent(
            new Url($url,$label), static::nameFromLabel($label)
        );

        return $this;
    }

    public function addMenu(?string $label = null): static
    {
        $subMenu = new static($label);

        $this->addComponent($subMenu,static::nameFromLabel($label));

        return $subMenu;
    }

    public function endMenu(): ?Menu
    {
        if($this->parent === null)
            return null;

        if(!($this->parent instanceof Menu))
            return null;

        return $this->parent;
    }


}
