<?php

return [
    define('IH_AND_FIRE', 1),
    define('FIRE_ONLY', 2),
    define('IH_ONLY', 3),
    define('UNRELATED', 4),

    define('IH_CORRESPOND', [
        IH_AND_FIRE => 'IHと加熱',
        FIRE_ONLY   => '加熱のみ',
        IH_ONLY   => 'IHのみ',
        IH_CORRESPOND   => '関係なし',
    ]),
];
