<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author Dmitry Brain (D.A.Cherepanov) <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
$includes = [
    'redirects',
    'settings',
    'connection',
    'ajaxUrl',
    'viewRecordLogs',
    'changeDate',
    'translit',
    'backTranslit',
    'wordsLang',
    'siteData',
    'simple_html_dom',
    'isMobile',
    'request',
    'content',
    'magic'
];
$paths = [
    '/engine/',
    '/engine/core/',
    '/engine/core/controllers/',
    '/engine/core/functions/',
    '/engine/core/database/'
];

foreach($includes as $include) {
    foreach($paths as $path) {
        if(file_exists($_SERVER['DOCUMENT_ROOT'].$path.$include.'.php')) {
            include($_SERVER['DOCUMENT_ROOT'].$path.$include.'.php');
        }
    }
}