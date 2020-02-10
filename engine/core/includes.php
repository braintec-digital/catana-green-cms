<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
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
    'primaryMenu',
    'simple_html_dom',
    'isMobile',
    'request',
    'content',
    'magic',
    'main-config'
];
$paths = [
    'engine/',
    'engine/core/',
    'engine/core/controllers/',
    'engine/core/functions/',
    'engine/core/database/'
];

foreach($includes as $include) {
    foreach($paths as $path) {
        if(file_exists($path.$include.'.php')) {
            include($path.$include.'.php');
        }
    }
}