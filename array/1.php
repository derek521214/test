<?php

$arr = [
    0=>[
        'a'=>'sdfada1',
        'b'=>'sdfada2',
    ],
    1=>[
        'c'=>'sdfada3',
        'd'=>'sdfada4',
    ],
    2=>[
        'e'=>'sdfada5',
        'f'=>'sdfada6',
    ],
    3=>[
        'g'=>'sdfada7',
        'h'=>'sdfada8',
    ],
    4=>[
        'i'=>'sdfada9',
        'j'=>'sdfada0',
    ],
];

//var_dump(array_chunk($arr,2));

echo  ceil(count($arr)/3);