<?php

use PHPUnit\Framework\TestCase;
use Zrnik\Menu\Menu;
use Zrnik\Menu\Url;

class MenuTest extends TestCase
{
    /**
     * This test expects that the nette/component-model is well tested and it probably is.
     */
    public function testCustomApi()
    {

        $menu = (new Menu("Example Menu"))
            ->addComponent(new Url("https://example.com/destination/1", "Example 1"), "example1")
            ->addComponent(new Url("https://example.com/destination/2", "Example 2"), "example2")
            ->addComponent(new Url("https://example.com/destination/3", "Example 3"), "example3")
            ->addComponent(new Url("https://example.com/destination/4", "Example 4"), "example4")
            ->addComponent(
                (new Menu("Search Engines"))
                    ->addComponent(new Url("https://google.com/", "Google"), "google")
                    ->addComponent(new Url("https://seznam.cz/", "Seznam"), "seznam")
                    ->addComponent(
                        (new Menu("Other"))
                            ->addComponent(new Url("https://yandex.ru/", "Yandex"), "yandex")
                            ->addComponent(new Url("https://yahoo.com/", "Yahoo"), "yahoo"),
                        "other"
                ),
                "searchengines"
            );

        $betterApiMenu = (new Menu("Example Menu"))
            ->addLink("Example 1", "https://example.com/destination/1")
            ->addLink("Example 2", "https://example.com/destination/2")
            ->addLink("Example 3", "https://example.com/destination/3")
            ->addLink("Example 4", "https://example.com/destination/4")

            ->addMenu("Search Engines")
                ->addLink("Google", "https://google.com")
                ->addLink("Seznam", "https://seznam.cz/")
                ->addMenu("Other")
                    ->addLink("Yandex", "https://yandex.ru/")
                    ->addLink("Yahoo", "https://yahoo.com/")
                ->endMenu()
            ->endMenu();

        $this->assertEquals(
            $menu,
            $betterApiMenu
        );
    }
}
