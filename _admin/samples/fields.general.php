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

    'title' => ['input','mdi-format-header-1 green'],
    'descript' => ['textarea','mdi-format-header-2'],
    'offer' => ['input','mdi-format-align-left'],
    'copyright' => ['input','mdi-copyright'],
    
    '1' => [
        'zip' => ['input','mdi-barcode'],
        'country' => ['input','mdi-earth-box'],
        'city' => ['input','mdi-map'],
        'addr' => ['input','mdi-map-marker'],
    ],
    
    '2' => [
        'tel:1' => ['input','mdi-phone'],
        'tel:2' => ['input','mdi-phone'],
        'tel:3' => ['input','mdi-phone']
    ],

    '3' => [
        'mail:1' => ['input','mdi-email'],
        'mail:2' => ['input','mdi-email-variant'],
        'mail:3' => ['input','mdi-cart']
    ],

    '4' => [
        'social=telegram' => ['input','mdi-telegram'],
        'social=skype' => ['input','mdi-skype'],
        'social=whatsapp' => ['input','mdi-whatsapp']
    ],
    '5' => [
        'social=facebook' => ['input','mdi-facebook'],
        'social=facebook-id' => ['input','mdi-facebook-box']
    ],
    '6' => [
        'social=youtube' => ['input','mdi-youtube-play'],
        'social=vimeo' => ['input','mdi-vimeo'],
        'social=twitch' => ['input','mdi-twitch']
    ],
    '7' => [
        'social=twitter' => ['input','mdi-twitter'],
        'social=instagram' => ['input','mdi-instagram'],
        'social=vk' => ['input','mdi-vk']
    ],
    '8' => [
        'social=behance' => ['input','mdi-behance'],
        'social=linkedin' => ['input','mdi-linkedin'],
        'social=github-circle' => ['input','mdi-github-circle']
    ]
];