<?php
/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
function backTranslit($str) {
    $tr = array(
        "swh"=>"щ",
        "ghe"=>"ґ",
        "yo"=>"ё",
        "zh"=>"ж",
        "cs"=>"ц",
        "ch"=>"ч",
        "sw"=>"ш",
        "y"=>"ы",
        "ae"=>"э",
        "yu"=>"ю",
        "ya"=>"я",
        "jy"=>"ї",
        "ue"=>"є",

        "a"=>"а",
        "b"=>"б",
        "v"=>"в",
        "g"=>"г",
        "d"=>"д",
        "e"=>"е",
        "z"=>"з",
        "i"=>"и",
        "yi"=>"й",
        "k"=>"к",
        "l"=>"л",
        "m"=>"м",
        "n"=>"н",
        "o"=>"о",
        "p"=>"п",
        "r"=>"р",
        "s"=>"с",
        "t"=>"т",
        "u"=>"у",
        "f"=>"ф",
        "h"=>"х",
        "."=>"ъ",
        "q"=>"ь",
        "-"=>" ",
        "\\"=>""
    );
    return strtr($str,$tr);
}