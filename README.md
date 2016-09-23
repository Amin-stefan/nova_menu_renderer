# Nova Menu Renderer

A quick and easy way to create multilingual and multi-level (Bootstrap)menu for Nova v3.

## Usage
 * Copy folder `Helpers` into your template folder, then open `Menu.php` and correct the namespace and edit it as you like.
 * Copy folder `Configs` into your app folder, then customize your menu.

At the end of `Config/App.php` add `'Menu'    => App\Templates\Bootstrap\Helpers\Menu'` to the `$aliases` array:

```php
<?php

'aliases' => array(
    // The Helpers.
    'Mail'          => 'Helpers\Mailer',
    'Assets'        => 'Helpers\Assets',
    ...
    
    'Menu'          => 'App\Templates\Bootstrap\Helpers\Menu',

),
?>
```

### View:
```php
<?php

$main = Menu::render('main');

$secondary = Menu::render('secondary');

?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url() ?>"><?= Config::get('app.name', SITETITLE) ?> </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <?= $main ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?= $secondary ?>
            </ul>
        </div>
    </div>
</nav>
```

### CSS:
```css
.navbar-login {
    width: 305px;
    padding: 10px;
    padding-bottom: 0px;
}

.navbar-login-session {
    padding: 10px;
    padding-bottom: 0px;
    padding-top: 0px;
}

@media (max-width: 767px) { 

    .navbar-login {
        color: #9d9d9d;
    }

    .navbar-login-session {
        color: #9d9d9d;
    }
}


.dropdown-submenu,
.dropdown-submenu-right {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu,
.dropdown-submenu-right:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}



.dropdown-submenu-right>.dropdown-menu {
    top: 0;
    right: 100%;
    margin-top: -6px;
    margin-right: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu-right>a:after {
    display: block;
    content: " ";
    float: left;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 5px 5px 0;
    border-right-color: #ccc;
    margin-top: 5px;
    margin-left: -10px;
}

.dropdown-submenu-right:hover>a:after {
    border-right-color: #fff;
}
```
