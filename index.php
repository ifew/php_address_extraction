<?php
$test_data = array(
    '12/34 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    'บ้านเลขที่ 12/34 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    'เลขที่ 12/34 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    '12 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    'บ้านเลขที่ 12 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    'เลขที่ 12 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    'เลขที่ 898-901 ม.9 ต.บ่ง อ.เมือง จ.อำนาจเจริญ 37000',
    '898-901 ม.9 ต.บ่ง อ.เมือง จ.อำนาจเจริญ 37000',

    '1234 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    '1234 ตำบลมีชัย อ.เมือง จ.หนองคาย 43000',
    '1234 ตำบล มีชัย อ.เมือง จ.หนองคาย 43000',

    '1234 หมู่ 2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    '1234 หมู่ที่ 2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',

    '1234 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    '1234 ม.2 ต.มีชัย อำเภอเมือง จ.หนองคาย 43000',
    '1234 ม.2 ต.มีชัย อำเภอ เมือง จ.หนองคาย 43000',

    '1234 ม.2 ต.มีชัย อ.เมือง จ.หนองคาย 43000',
    '1234 ม.2 ต.มีชัย อ.เมือง จังหวัดหนองคาย 43000',
    '1234 ม.2 ต.มีชัย อ.เมือง จังหวัดหนองคาย 43000',

    'เลขที่ 1234 ถนนเทศา 2 ตำบลในเมือง อำเภอเมืองกำแพงเพชร จังหวัดกำแพงเพชร',
    'เลขที่ 1234 ถนน เทศา 2 ตำบลในเมือง อำเภอเมืองกำแพงเพชร จังหวัดกำแพงเพชร',
    'เลขที่ 1234 ถ.เทศา 2 ตำบลในเมือง อำเภอเมืองกำแพงเพชร จังหวัดกำแพงเพชร',

    'เลขที่ 12/34 ซอย 4 ถนนเทศา ตำบลในเมือง อำเภอเมืองกำแพงเพชร จังหวัดกำแพงเพชร',
    'เลขที่ 12/34 ซ. 4 ถนนเทศา ตำบลในเมือง อำเภอเมืองกำแพงเพชร จังหวัดกำแพงเพชร',

    '1234/1234 หมู่ 5 ซ.พหลโยธิน 54 แยก 10 ถ.พหลโยธิน ต.คลองถนน อ.สายไหม กทม. 10220',
    '1234 JJ Mall ถนน กำแพงเพชร 2 แขวง จตุจักร เขตจตุจักร กรุงเทพมหานคร 10900',
    '123/456 สีกัน ดอนเมือง กรุงเทพ 10210',
    '123/456 ซอยลาดพร้าว94 แขวงพลับพลา เขตวังทองหลาง กรุงเทพ',
    '1234 ถนน ดินสอ แขวงบวรนิเวศ เขตพระนคร กรุงเทพมหานคร 10200',
    '123/456 ต.ทุ่งมหาเมฆ อ.สาทร กรุงเทพ 10120'
);

function address_remove_prefix($address_text) {
    $address_text = str_replace(array("เขต","แขวง","จังหวัด","อำเภอ","ตำบล","อ.","ต.","จ.",), '', $address_text);
    return $address_text;
}

function extract_zipcode($address_text) {
    $pattern = '/([0-9]{5})/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[0])) {
        return $matches[0];
    } else {
        return '';
    }
}

function extract_house_no($address_text) {
    // $pattern = '/(เลขที่ |เลขที่|บ้านเลขที่ |บ้านเลขที่)([0-9]\S*)/';
    $pattern = '/(เลขที่ |เลขที่|บ้านเลขที่ |บ้านเลขที่)?([0-9\/ ]+)(ซอย|ซอย |ซ\.|หมู่|หมู่ |หมู่ที่|หมู่ที่ |ม\.|ถนน|ถนน |ถ\.)/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[2])) {
        return $matches[2];
    } else {
        return '';
    }
}

function extract_house_address($address_text) {
    // $pattern = '/(เลขที่ |เลขที่|บ้านเลขที่ |บ้านเลขที่)([0-9]\S*)/';
    $pattern = '/(.+)(ตำบล|ตำบล |ต\.|ต\. |แขวง|แขวง )(.\S*)/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[1])) {
        return $matches[1];
    } else {
        return '';
    }
}

function extract_soi($address_text) {
    $pattern = '/(ซอย|ซอย |ซ\.)(.* )(ถนน|ถนน |ถ\.)/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[2])) {
        return $matches[2];
    } else {
        return '';
    }
}

function extract_road($address_text) {
    $pattern = '/(ถนน|ถนน |ถ\.)(.\S*)/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[2])) {
        return $matches[2];
    } else {
        return '';
    }
}

function extract_village_no($address_text) {
    $pattern = '/(หมู่|หมู่ |หมู่ที่|หมู่ที่ |ม\.)([0-9]\S*)/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[2])) {
        return $matches[2];
    } else {
        return '';
    }
}

function extract_subdistrict($address_text) {
    $pattern = '/(ตำบล|ตำบล |ต\.|ต\. |แขวง|แขวง )(.\S*)/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[2])) {
        return $matches[2];
    } else {
        return '';
    }
}

function extract_district($address_text) {
    $pattern = '/(อำเภอ|อำเภอ |อ\.|อ\. |เขต|เขต )(.\S*)/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[2])) {
        return $matches[2];
    } else {
        return '';
    }
}

function extract_province($address_text) {
    $pattern = '/(จังหวัด|จ\.)(.\S*)?/';
    preg_match($pattern, $address_text, $matches);
    if(isset($matches[2])) {
        return $matches[2];
    } else {
        $pattern_bkk = '/(กรุงเทพมหานครฯ|กรุงเทพมหานคร|กรุงเทพ|กรุงเทพฯ|กทม)/';
        preg_match($pattern_bkk, $address_text, $matches_bkk);
        if(isset($matches_bkk[1])) {
            return $matches_bkk[1];
        } else {
            return '';
        }
    }
}

function extract_address($address_text) {
    $address_array = array();

	// $address_text = address_remove_prefix($address_text);
    $address_array['house_address'] = extract_house_address($address_text);
    $address_array['house_no'] = extract_house_no($address_text);
    $address_array['village_no'] = extract_village_no($address_text);
    $address_array['soi'] = extract_soi($address_text);
    $address_array['road'] = extract_road($address_text);
    $address_array['subdistrict'] = extract_subdistrict($address_text);
    $address_array['district'] = extract_district($address_text);
    $address_array['province'] = extract_province($address_text);
    $address_array['zipcode'] = extract_zipcode($address_text);

    // return explode(" ",$address_text);
    return $address_array;
}

echo '<pre>';
foreach($test_data as $data) {
    echo "test: ".$data."\n";
    print_r(extract_address($data));
}
echo '</pre>';