<?php
/**
* © LeoCRAFT Digital, "Catana"
* Website: https://catana.leocraft.digital

*---[ Information and Terms of Use ]----------------------------------------------------------------------*
*    "Catana CMS" was developed by LeoCRAFT Digital in 2020.
*    "Сatana CMS" is a stripped down version of the "TRONE Engine" platform that I developed in feb 2017
*    The author of the platform is Dmytro Cherepanov, Ukraine, Mariupol.
*    This platform is free for open and commercial use.
*    Exceptions are:
*        An attempt to sell the platform itself or its code fragments;
*        Assignment of copyright or extradition of the platform for
*        its development in any of its modifications.
*    You can develop sites, modify code or modules, but you must always refer to the source.
*    When developing any project using this platform, you must mention that you are using "Catana CMS"
*    You should not remove from the code any mention of the platform and its developer. 
*--------------------------------------------------------------------------------------------------------*
*
* For site adaptability, our development of "magic.css" & "magic.js" is used.
* As a WYSIWYG editor, our development "SlipWI Editor" is used.
*
* The only third-party module that is used in "Сatana CMS" is the parser [simple_html_dom.php].
* Third-party frameworks are also connected to the admin panel: jquery.3.3.1, jquery-ui.
*
* Enjoy Your Development!
* Sincerely, Dmytro Cherepanov.
*
* Facebook: https://www.facebook.com/treemindlc
* GitHub: https://github.com/leocraftdigital
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
* @package PlaceLocalInclude
**/

// The platform runs on PHP 5.5 -> 7.2
// phpinfo();die;

// Config Site -> /engine/config.php
include($_SERVER['DOCUMENT_ROOT'].'/engine/config.php');
// Plug-in Configuration -> /engine/core/includes.php
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/includes.php');
// Main Body Generator -> /engine/core/main.php
include($_SERVER['DOCUMENT_ROOT'].'/engine/core/main.php');

/*
Important:
Page Routing is -> /engine/routes.php
Page redirects are configured in -> /engine/redirects.php

Login to admin panel yoursite.domain/Admin
Default login: Admin
Default password: admin
*/