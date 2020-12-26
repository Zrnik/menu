# Menu 

With this you can define your menu, and then draw it somewhere.

It uses `nette/component-model` package.

It contains 2 classes:

- **Zrnik\Menu\Url** - this is a `Nettte\Http\Url`, but implementing `Nette\ComponentModel\IComponent`.
- **Zrnik\Menu\Menu** - this is a container (extending `Nette\ComponentModel\Container`), but 
  changed, so it only takes `Url` or `Menu` as a child.
  
Thats all.

### Example usage:

```php
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
```

### Result:

```html
<a href="/home/">Home</a>
<a href="/blog/">Blog</a>
Support:
 <a href="/support/contact">Contact us!</a>
 <a href="/support/faq">FAQ</a>
```

