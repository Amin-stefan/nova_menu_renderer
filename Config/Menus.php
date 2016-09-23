<?php
/**
 * Menu
 *
 * @author Amirhossein Loghat - amiroperator@gmail.com
 * @version 1.0
 */

use Config\Config;


Config::set('menu', array(

    /**
     * Main Menu
     */
    'main' => array(
        'en' => array(
            'name'       => 'Main Menu',
            'type'       => 'bootstrap',
            'parameters' => [false],
            'items' => array(
                'home' => array(
                    'url'      => site_url(),
                    'label'    => 'Home',
                    'icon'     => null,
                    'loggedin' => null,
                    'children' => null,
                ),
                'forums' => array(
                    'url'      => site_url('forums'),
                    'label'    => 'Forum',
                    'icon'     => null,
                    'loggedin' => null,
                    'children' => null,
                ),
                'support' => array(
                    'url'      => site_url('support'),
                    'label'    => 'Support',
                    'icon'     => null,
                    'loggedin' => null,
                    'children' => array(
                        'contact' => array(
                            'url'      => site_url('support/contact'),
                            'label'    => 'Contact US',
                            'icon'     => null,
                            'loggedin' => null,
                            'children' => null,
                        ),
                        'about' => array(
                            'url'      => site_url('support/about'),
                            'label'    => 'About',
                            'icon'     => null,
                            'loggedin' => null,
                            'children' => null,
                        ),
                    ),
                ),
            ),
        ),
    ), 

    /**
     * Secondary Menu
     */
    'secondary' => array(
        'en' => array(
            'name'       => 'Secondary Menu',
            'type'       => 'bootstrap',
            'parameters' => [true],
            'items' => array(
                'login' => array(
                    'url'      => site_url('login'),
                    'label'    => 'Login',
                    'icon'     => null,
                    'loggedin' => false,
                    'children' => null,
                ),
                'register' => array(
                    'url'      => site_url('register'),
                    'label'    => 'Register',
                    'icon'     => null,
                    'loggedin' => false,
                    'children' => null,
                ),
                'panel' => array(
                    'url'      => null,
                    'label'    => '%panel%',
                    'icon'     => '%userAvatar%',
                    'loggedin' => true,
                    'children' => null,
                ),
            ),
        ),
    ),
));
