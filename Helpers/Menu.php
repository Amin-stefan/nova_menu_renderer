<?php
/**
 * Menu - a simple but powerful helper for rendering multi level menu (bootstrap)
 *
 * @author Amirhossein Loghat - amiroperator@gmail.com
 * @version 1.0
 */
 
namespace App\Templates\Bootstrap\Helpers;

use Auth;
use Cache;
use Config;
use Request;
use Language;


class Menu
{
    public static function bootstrap($menu, $parameters, $level = 1) {

        $result = null;

        if ($level > 1) {
            $result .= '<ul class="dropdown-menu multi-level">';
        } else if ($level > 2) {
            $result .= '<ul class="dropdown-menu">';
        }

        foreach ($menu as $key => $item) {
            
            if ($item['loggedin'] === true && ! Auth::check()) {
                continue;
            } else if ($item['loggedin'] === false && ! Auth::guest()) {
                continue;
            }

            if (Auth::check()) {
                $user = Auth::user();
            }

            if ($item['label'] == '%separator%') {
                $result .= '<li class="divider"></li>';
                continue;
            } else if ($item['label'] == '%panel%') {
                $result .= '
                    <li class="dropdown">
                        <a href="' .site_url('account') .'" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="' .$user->avatar .'" class="img-rounded" style="height: 18px;" />
                            <strong>' .$user->display_name .'</strong>
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="' .$user->avatar .'" class="img-circle img-responsive" style="height: 86px;" />
                                        </div>
                                        <div class="col-lg-8">
                                            <p class="text-left text-capitalize"><strong>' .$user->first_name . ' ' .$user->last_name .'</strong></p>
                                            <p class="text-left small text-uppercase">' .$user->displayname .'</p>
                                            <p class="text-left">
                                                <a href="' .site_url('profile') .'">' .__('Profile') .'</a> - 
                                                <a href="' .site_url('account') .'">' .__('Account') .'</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="navbar-login navbar-login-session">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <a href="' .site_url('add-account') .'" class="btn btn-default btn-outline btn-sm pull-left">' .__('Add account') .'</a>
                                                <a href="' .site_url('logout') .'" class="btn btn-danger btn-outline btn-sm pull-right">' .__('Logout') .'</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>';
                continue;
            }

            $class = array();
            $children = null;

            if (Request::path() == $item['url']) {
                $class[] = "active";
            }

            if ($item['children'] !== null) {
                if ($level > 1) {

                    // Determine menu place
                    if (! $parameters[0] && $level >= 2) {
                        $class[] = "dropdown-submenu";
                    } else if ($parameters[0] && $level >= 2) {
                        $class[] = "dropdown-submenu-right";
                    }
                }
                $level++;

                $children = self::bootstrap($item['children'], $parameters, $level);
            }

            $classes = ! empty($class) ? ' class="'.implode(' ', $class) .'"' : '';

            $result .= '<li' .$classes .'>';
            $result .= '<a href="' .$item['url'] .'"'.($item['children'] ? ' class="dropdown-toggle" data-toggle="dropdown"' : '') .'>';
            $result .= ($item['icon'] ? '<i class="' .$item['icon'] .'"></i>' : '') .' ' .$item['label'] .''.($children && $level == 2 ? ' <span class="caret"></span>' : '');
            $result .= '</a>';
            $result .= $children;
            $result .= '</li>';
        }

        if (array_key_exists($key, $menu)) {
            $result .= '</ul>';
        }

        return $result;
    }

    public static function render($name)
    {
        $locale = Language::getLocale();

        if (CONFIG_STORE == 'files') {
            $menu = Config::get("menu.$name.$locale");
        } else {
            $menu = Cache::remember('menu', 10, function() use ($name, $locale) {
                return Config::get("menu.$name.$locale");
            });
        }
        
        $items      = $menu['items'];
        $type       = $menu['type'];
        $parameters = $menu['parameters'];

        return self::{$type}($items, $parameters);
    }
}
