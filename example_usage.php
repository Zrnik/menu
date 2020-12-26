<?php

include __DIR__.'/vendor/autoload.php';

/*
 * Example definition
 */

$menu = new \Zrnik\Menu\Menu();
$menu->addLink("Home", "/home/");
$menu->addLink("Blog", "/blog/");
$support = $menu->addMenu("Support");
$support->addLink("Contact us!", "/support/contact");
$support->addLink("FAQ", "/support/faq");


/*
 * Example usage
 */

function menuItem(\Zrnik\Menu\Menu $menu, int $level = 0)
{
    foreach($menu->getComponents() as $item)
    {
        if($item instanceof \Zrnik\Menu\Menu)
        {
            echo str_repeat(" ",$level).$item->label.":".PHP_EOL;
            menuItem($item, $level+1);
        }

        if($item instanceof \Zrnik\Menu\Url)
        {
            echo str_repeat(" ",$level).
                sprintf('<a href="%s">%s</a>', $item->getAbsoluteUrl(), $item->label);

            echo PHP_EOL;
        }
    }
}

menuItem($menu);
