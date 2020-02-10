<?php
/**
* © LeoCRAFT Digital, "Catana CMS" https://catana.leocraft.digital
* @author D.A. Cherepanov <info@leocraft.com>
* @copyright LeoCRAFT Digital <catana.leocraft.digital>
* @version 1.0
**/
?>
<div class="title">
    <i class='mdi mdi-drag-vertical fs-6x'></i>
    <h1>SlipWI Editor v 1.1 Catana</h1>
</div>
<ul class="slipwi-toolbar">
    <div class="temp"></div>
    <li class="always">
        <a href="#" help="Maximize" class="max"><i class='mdi mdi-fullscreen fs-4x'></i></a>
        <a href="#" help="Restore" class="min"><i class='mdi mdi-fullscreen-exit fs-4x'></i></a>
    </li>
    <li>
        <div class="wrapper"><i class='mdi mdi-dots-vertical fs-5x'></i>
            <div>
                <a href="#" data-command='undo' help="Undo"><i class='mdi mdi-undo fs-4x'></i></a>
                <a href="#" data-command='redo' help="Redo"><i class='mdi mdi-redo fs-4x'></i></a>
                <a href="#" data-command='cut' help="Cut"><i class='mdi mdi-content-cut fs-4x'></i></a>
                <a href="#" data-command='copy' help="Copy"><i class='mdi mdi-content-copy fs-4x'></i></a>
                <a href="#" data-command='paste' help="Paste"><i class='mdi mdi-content-paste fs-4x'></i></a>
                <a href="#" data-command='selectAll' help="Select All"><i class='mdi mdi-select-all fs-4x'></i></a>
                <a href="#" data-command='removeFormat' help="Remove Format"><i class='mdi mdi-eraser fs-4x'></i></a>
                <a href="#" data-command="insertText" help="Convert To Text"><i class="mdi mdi-note-outline fs-4x"></i></a>
            </div>
        </div>
    </li>
    <p>HTML Editor Mode<i class="mdi mdi-xml fs-4x"></i></p>
    <li>
        <div class="wrapper" help="Format Text"><i class='mdi mdi-format-align-left fs-4x'></i>
            <div>
                <a href="#" data-command='justifyLeft' help="Left"><i class='mdi mdi-format-align-left fs-3x'></i></a>
                <a href="#" data-command='justifyCenter' help="Center"><i class='mdi mdi-format-align-center fs-3x'></i></a>
                <a href="#" data-command='justifyRight' help="Right"><i class='mdi mdi-format-align-right fs-3x'></i></a>
                <a href="#" data-command='justifyFull' help="Justify"><i class='mdi mdi-format-align-justify fs-3x'></i></a>
            </div>
        </div>
    </li>
    <li>
        <div class="fore-wrapper" help="Style Text"><i class='mdi mdi-format-font fs-4x'></i>
            <div>
                <a href="#" data-command='bold' help="Bold"><i class='mdi mdi-format-bold fs-3x'></i></a>
                <a href="#" data-command='italic' help="Italic"><i class='mdi mdi-format-italic fs-3x'></i></a>
                <a href="#" data-command='underline' help="Underline"><i class='mdi mdi-format-underline fs-3x'></i></a>
                <a href="#" data-command='strikeThrough' help="Strikethrough"><i class='mdi mdi-format-strikethrough-variant fs-2x'></i></a>
                <a href="#" data-command='superscript' help="Superscript"><i class='mdi mdi-format-superscript fs-3x'></i></a>
                <a href="#" data-command='subscript' help="Subscript"><i class='mdi mdi-format-subscript fs-3x'></i></a>
            </div>
        </div>

        <div class="fore-wrapper" help="Format Block"><i class='mdi mdi-format-text fs-4x'></i>
            <div>
                <a href="#" data-command='p' help="Normal"><i class='mdi mdi-format-paragraph fs-3x'></i></a>
                <a href="#" data-command='h1' help="Heading 1"><i class='mdi mdi-format-header-1 fs-3x'></i></a>
                <a href="#" data-command='h2' help="Heading 2"><i class='mdi mdi-format-header-2 fs-3x'></i></a>
                <a href="#" data-command='h3' help="Heading 3"><i class='mdi mdi-format-header-3 fs-3x'></i></a>
                <a href="#" data-command='h4' help="Heading 4"><i class='mdi mdi-format-header-4 fs-3x'></i></a>
                <a href="#" data-command='h5' help="Heading 5"><i class='mdi mdi-format-header-5 fs-3x'></i></a>
                <a href="#" data-command='h6' help="Heading 6"><i class='mdi mdi-format-header-6 fs-3x'></i></a>
                <a href="#" data-command='section' help="Section"><i class='mdi mdi-code-brackets fs-3x'></i></a>
                <a href="#" data-command='blockquote' help="Blockquote"><i class='mdi mdi-format-quote-open fs-3x'></i></a>
                <a href="#" data-command='article' help="Article"><i class='mdi mdi-message-outline fs-3x'></i></a>
                <a href="#" data-command='pre' help="Pre"><i class='mdi mdi-format-section fs-3x'></i></a>
            </div>
        </div>

        <div class="wrapper" help="Font Size"><i class='mdi mdi-format-size fs-4x'></i>
            <div style="left: -15px">
                <a href="#" data-command='fontSize' data-value="10px"><b>10px</b></a>
                <a href="#" data-command='fontSize' data-value="12px"><b>12px</b></a>
                <a href="#" data-command='fontSize' data-value="16px"><b>16px</b></a>
                <a href="#" data-command='fontSize' data-value="24px"><b>24px</b></a>
                <a href="#" data-command='fontSize' data-value="36px"><b>36px</b></a>
                <a href="#" data-command='fontSize' data-value="48px"><b>48px</b></a>
                <a href="#" data-command='fontSize' data-value="60px"><b>60px</b></a>
                <a href="#" data-command='fontSize' data-value="72px"><b>72px</b></a>
                <a href="#" data-command='fontSize' data-value="96px"><b>96px</b></a>
            </div>
        </div>

        <div class="wrapper" help="Line Spacing"><i class='mdi mdi-format-line-spacing fs-4x'></i>
            <div style="left: -15px">
                <a href="#" data-command='lineSpacing' data-value="0.5"><b>0.5</b></a>
                <a href="#" data-command='lineSpacing' data-value="0.75"><b>0.75</b></a>
                <a href="#" data-command='lineSpacing' data-value="1.0"><b>1.0</b></a>
                <a href="#" data-command='lineSpacing' data-value="1.25"><b>1.25</b></a>
                <a href="#" data-command='lineSpacing' data-value="1.5"><b>1.5</b></a>
                <a href="#" data-command='lineSpacing' data-value="1.75"><b>1.75</b></a>
                <a href="#" data-command='lineSpacing' data-value="2.0"><b>2.0</b></a>
            </div>
        </div>
    
        <a href="#" data-command='indent'><i class='mdi mdi-format-indent-increase fs-4x'></i></a>
        <a href="#" data-command='outdent'><i class='mdi mdi-format-indent-decrease fs-4x'></i></a>
    </li>
    <li>
        <div class="fore-wrapper" help="Listing Format"><i class='mdi mdi-format-list-bulleted-type fs-4x'></i>
            <div>
                <a href="#" data-command='insertUnorderedList' help="Unordered List"><i class='mdi mdi-format-list-bulleted fs-4x'></i></a>
                <a href="#" data-command='insertOrderedList' help="Ordered List"><i class='mdi mdi-format-list-numbers fs-4x'></i></a>
            </div>
        </div>
    </li>
    <li>
        <a href="#" data-command='insertHorizontalRule' help="Horizontal Rule"><i class='mdi mdi-minus-box-outline fs-4x'></i></a>
    </li>
    <li class="table">
        <a href="#" data-command='insertHTML' data-value="table" help="Insert Table"><i class='mdi mdi-table-large fs-4x'></i>
            <div class="seltable"></div>
        </a>
    </li>
    <li class="table">
        <a href="#" data-command='insertHTML' data-value="table" help="Insert Blocks"><i class='mdi mdi-grid-large fs-4x'></i>
            <div class="selblock"></div>
        </a>
    </li>
    <li>
        <div class="wrapper" help="Format Link"><i class='mdi mdi-link-variant fs-4x'></i>
            <div>
                <a href="#" data-command='createlink' help="Crate Link"><i class='mdi mdi-link fs-3x'></i></a>
                <a href="#" data-command='unlink' help="UnLink"><i class='mdi mdi-link-off fs-3x'></i></a>
            </div>
        </div>
    </li>
    <li>
        <a href="#" data-command='insertimage' help="Insert Image"><i class='mdi mdi-image fs-4x'></i></a>
        <a href="#" data-command='insertHTML' data-value="video" help="Insert Video"><i class='mdi mdi-video fs-4x'></i></a>
        <a href="#" data-command='insertHTML' data-value="audio" help="Insert Audio"><i class='mdi mdi-music fs-4x'></i></a>
        <a href="#" data-command='insertHTML' data-value="iframe" help="Insert Iframe"><i class='mdi mdi-format-page-break fs-4x'></i></a>
    </li>
    <li>
        <div class="wrapper" help="Text Color"><i class='mdi mdi-format-color-text fs-5x'></i>
            <div class="color"></div>
        </div>
        <div class="wrapper" help="Marker Color"><i class='mdi mdi-marker fs-3x'></i>
            <div class="marker"></div>
        </div>
        <div class="wrapper td-fill" help="Background Color" style="display: none"><i style="margin-top: 7px" class='mdi mdi-format-color-fill fs-5x'></i>
            <div class="fill"></div>
        </div>
    </li>

    <li class="always">
        <a href="#" data-command='clearFormat' help="Hard Clear"><i class='mdi mdi-box-cutter fs-4x'></i></a>
        <a href="#" data-command='viewHtml' help="View HTML"><i class='mdi mdi-language-html5 fs-4x'></i></a>
    </li>
</ul>