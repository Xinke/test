<?php
/**
 * Написать функцию которая из этого массива
 */
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];

//сделает такой и наоборот
$data = [
    'parent' => [
        'child' => [
            'field' => 1,
            'field2' => 2,
        ]
    ],
    'parent2' => [
        'child' => [
            'name' => 'test'
        ],
        'child2' => [
            'name' => 'test',
            'position' => 10
        ]
    ],
    'parent3' => [
        'child3' => [
            'position' => 10
        ]
    ],
];

function collapseArray(&$arResult, $data, $strKey = '') {
    if(is_array($data)) {
        foreach ($data as $key => $value) {
            $strNewKey = ($strKey ? $strKey.'.'.$key : $key);
            collapseArray($arResult, $value, $strNewKey);
        }
    } else {
        $arResult[$strKey] = $data;
    }
}
function expandOrCollapseArray($data) {
    $arResult = array();
    reset($data);
    $strFirstKey = key($data);
    if(strpos($strFirstKey, '.')) {
        //Expand
        foreach ($data as $key => $value) {
            $arKeys = explode('.', $key);
            $hLink = &$arResult;
            $nCnt = count($arKeys);
            for ($i = 0; $i < $nCnt; $i++) { 
                if($i != $nCnt - 1) {
                    if(!isset($hLink[ $arKeys[$i] ])) {
                        $hLink[ $arKeys[$i] ] = array();
                    }
                    $hLink = &$hLink[ $arKeys[$i] ];
                } else {
                    $hLink[ $arKeys[$i] ] = $value;
                }
            }
            unset($hLink);
        }
    } else {
        //Collapse
        collapseArray($arResult, $data);
    }
    return $arResult;
}
print_r(expandOrCollapseArray($data1));
print_r(expandOrCollapseArray($data));