<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
$fields = [
    'admin_id' => ['hidden',''],
    'id' => ['hidden',''],
    'parent_id' => ['hidden',''],
    'main' => ['hidden',''],
    'login' => ['hidden',''],
    'public' => ['hidden',''],
    'del' => ['hidden',''],
    'sys' => ['hidden',''],
    'type' => ['hidden',''],
    'multitype' => ['hidden',''],
    'img' => ['hidden',''],
    'gallery' => ['hidden',''],

    '1' => [
        'menu' => ['input','mdi-menu'],
        'view' => ['input','mdi-link-variant green']
    ],
    
    'title' => ['input','mdi-format-header-1'],
    'descript' => ['textarea','mdi-format-header-2'],
    'text' => ['bigtext',''],
    'seo_title' => ['input','mdi-note'],
    'seo_descript' => ['textarea','mdi-note-outline'],
    'keywords' => ['textarea','mdi-file-word-box'],
    'tags' => ['input','mdi-tag-text-outline'],
    
    '2' => [
        'video' => ['input','mdi-youtube-tv'],
        'icon' => ['input','mdi-file-image'],
        'unit' => ['input','mdi-cube-outline'],
        'outlink' => ['input','mdi-link']
    ]
];