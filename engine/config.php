<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
// Base Connection
$host = [
    'base' => 'catana-green',
    'user' => 'admin_trone',
    'pass' => '!9&7TreeMind%0@',
    'addr' => '127.0.0.1'
];
// Template
$get['tpl'] = [
    'template' => 'views/templates/Catana/index.html',
    'blocks' => 'views/blocks',
    'blockType' => 'html',
    'style' => true,

    'https' => true, // true/false
    'www' => false, // true/false
    'compress' => true, // true/false
    'breadcrumbs' => true,
    'adminlink' => 'Admin',
    
    // Site Fonts
    'fontHead' => 'Exo 2',
    'fontText' => 'Ubuntu',
    'fontAlt' => '',
    // Images
    'favicon' => 'userfiles/ruleztech-icon.png',
    'appicon' => 'userfiles/ruleztech-icon.png',
    'logo' => '',
    'img' => '',
    'placeholder' => 'assets/img/placeholder.svg',
    // Colors
    'colors' => [
        'color1A' => '#01ca7a',
        'color1B' => '#009e5f',
        'color1C' => '',

        'color2A' => '#555',
        'color2B' => '#333',
        'color2C' => '',

        'color3A' => '',
        'color3B' => '',
        'color3C' => '',

        'color4A' => '',
        'color4B' => '',
        'color4C' => '',

        'colorBody' => '#f9f9f9',
        'colorText' => '#333',
        'colorAhover' => '#00ff97',
        'colorHead' => '#f9f9f9',
        'colorFooter' => '#555',
        'colorScroll' => '#009e5f',
        'colorScrollH' => '#555',
        'colorH' => '#333',
        'colorA' => '#01ca7a'
    ]
];
// Modules
$mods = [
    '',
    ''
];
// Extantion
$extantion = [
    'MaterialDesign' => true,
    // 'FontAwesome' => true,
    // 'Micons' => true,

    'Magic' => '<script src="assets/js/slite.js"></script><script src="assets/js/magic.js"></script>',
    // 'Vue' => '<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>',
    // 'Magic+Jquery' => '<script src="assets/js/jquery-3.3.1.min.js"></script><script src="assets/js/magic.jquery.js"></script>',
    // 'Jquery' => '<script src="assets/js/jquery-3.3.1.min.js"></script>',
    // 'jQueryPlugins' => '<script src="assets/js/plugins.js"></script>',
    // 'Modernizr' => '<script src="assets/js/modernizr.js"></script>',
    // 'Pace' => '<script src="assets/js/pace.min.js"></script>',
];
session_start();