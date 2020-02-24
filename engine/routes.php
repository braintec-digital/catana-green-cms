<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital

This is a file for connecting blocks to site pages.
Blocks are created and stored in a folder /views/blocks/

The folder name for the block and the files in it must match
SAMPLE:
/views/blocks/MyBlock/
/views/blocks/MyBlock/MyBlock.html
/views/blocks/MyBlock/MyBlock.css
/views/blocks/MyBlock/MyBlock.js

I recommend that any CSS property for a block start with the value .blockName,
which will be replaced later by the engine itself with the corresponding block name.
*/
switch ($get['view']) {
    case '': // home page
        $blocks = ['PageContent','CallBack'];
    break;
    case 'about':
        $blocks = ['PageContent','CallBack'];
    break;
    case 'catalog':
        $blocks = ['PageContent','ShopCat','CallBack'];
    break;
    case 'news':
        $blocks = ['PageContent','NewsTape','CallBack'];
    break;
    case 'gallery':
        $blocks = ['PageContent','Gallery','CallBack'];
    break;
    case 'services':
        $blocks = ['PageContent','Services','CallBack'];
    break;
    case 'contact':
        $blocks = ['ContactsOne','CallBack'];
    break;
}