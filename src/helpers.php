<?php

function deviceString($seed) {
    $megaRandomHash = md5($seed . "axUmhY63gd7Hmjdy63gHf");
    return 'android-' . substr($megaRandomHash, 16);
}

function is_valid($uuid) {
    return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'.
            '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
}

function guid($name, $namespace = '1546058f-5a25-4334-85ae-e68f2a44bbaf')
{
    if(!is_valid($namespace)) return false;

    $nhex = str_replace(array('-','{','}'), '', $namespace);

    $nstr = '';

    for($i = 0; $i < strlen($nhex); $i+=2)
    {
        $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
    }

    $hash = sha1($nstr . $name);

    return sprintf('%08s-%04s-%04x-%04x-%12s',

        substr($hash, 0, 8),

        substr($hash, 8, 4),

        (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,

        (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,

        substr($hash, 20, 12)
    );
}

function getDeviceString($username)
{
    $username = strtolower($username);

    $charList = array_merge(range('a', 'z'), range(0,9));


    $userCharLists = str_split($username);

    $sum = 0;

    foreach ($userCharLists as $userChar)
    {
        $res = array_search($userChar, $charList);

        if ($res)
        {
            $sum += $res;
        }
    }

    $sonuc = $sum % strlen($username);

    $devices = \AdemOzmermer\Core\Device::devices;

    return $devices[$sonuc];

}

function buildArr($username)
{
    $build_arr = \AdemOzmermer\Core\Device::build_arr;
    return isset($build_arr[strlen($username)]) ? $build_arr[strlen($username)] : $build_arr[14];
}

function sign($data, $key)
{
    return hash_hmac('sha256', $data, $key);
}