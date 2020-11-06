<?php


namespace AdemOzmermer\Core;


class Device
{
    private $deviceString;

    private $deviceId;

    private $uuid;

    private $phoneId;

    private $adid;

    private $build;

    const devices = [
        "25/7.1.1; 440dpi; 1080x1920; Xiaomi; Mi Note 3; jason; qcom",
        "23/6.0.1; 480dpi; 1080x1920; Xiaomi; Redmi Note 3; kenzo; qcom",
        "23/6.0; 480dpi; 1080x1920; Xiaomi; Redmi Note 4; nikel; mt6797",
        "24/7.0; 480dpi; 1080x1920; Xiaomi/xiaomi; Redmi Note 4; mido; qcom",
        "23/6.0; 480dpi; 1080x1920; Xiaomi; Redmi Note 4X; nikel; mt6797",
        "27/8.1.0; 440dpi; 1080x2030; Xiaomi/xiaomi; Redmi Note 5; whyred; qcom",
        "23/6.0.1; 480dpi; 1080x1920; Xiaomi; Redmi 4; markw; qcom",
        "27/8.1.0; 440dpi; 1080x2030; Xiaomi/xiaomi; Redmi 5 Plus; vince; qcom",
        "25/7.1.2; 440dpi; 1080x2030; Xiaomi/xiaomi; Redmi 5 Plus; vince; qcom",
        "26/8.0.0; 480dpi; 1080x1920; Xiaomi; MI 5; gemini; qcom",
        "27/8.1.0; 480dpi; 1080x1920; Xiaomi/xiaomi; Mi A1; tissot_sprout; qcom",
        "26/8.0.0; 480dpi; 1080x1920; Xiaomi; MI 6; sagit; qcom",
        "25/7.1.1; 440dpi; 1080x1920; Xiaomi; MI MAX 2; oxygen; qcom",
        "24/7.0; 480dpi; 1080x1920; Xiaomi; MI 5s; capricorn; qcom",
        "26/8.0.0; 480dpi; 1080x1920; samsung; SM-A520F; a5y17lte; samsungexynos7880",
        "26/8.0.0; 480dpi; 1080x2076; samsung; SM-G950F; dreamlte; samsungexynos8895",
        "26/8.0.0; 640dpi; 1440x2768; samsung; SM-G950F; dreamlte; samsungexynos8895",
        "26/8.0.0; 420dpi; 1080x2094; samsung; SM-G955F; dream2lte; samsungexynos8895",
        "26/8.0.0; 560dpi; 1440x2792; samsung; SM-G955F; dream2lte; samsungexynos8895",
        "24/7.0; 480dpi; 1080x1920; samsung; SM-A510F; a5xelte; samsungexynos7580",
        "26/8.0.0; 480dpi; 1080x1920; samsung; SM-G930F; herolte; samsungexynos8890",
        "26/8.0.0; 480dpi; 1080x1920; samsung; SM-G935F; hero2lte; samsungexynos8890",
        "26/8.0.0; 420dpi; 1080x2094; samsung; SM-G965F; star2lte; samsungexynos9810",
        "26/8.0.0; 480dpi; 1080x2076; samsung; SM-A530F; jackpotlte; samsungexynos7885",
        "24/7.0; 640dpi; 1440x2560; samsung; SM-G925F; zerolte; samsungexynos7420",
        "26/8.0.0; 420dpi; 1080x1920; samsung; SM-A720F; a7y17lte; samsungexynos7880",
        "24/7.0; 640dpi; 1440x2560; samsung; SM-G920F; zeroflte; samsungexynos7420",
        "24/7.0; 420dpi; 1080x1920; samsung; SM-J730FM; j7y17lte; samsungexynos7870",
        "26/8.0.0; 480dpi; 1080x2076; samsung; SM-G960F; starlte; samsungexynos9810",
        "26/8.0.0; 420dpi; 1080x2094; samsung; SM-N950F; greatlte; samsungexynos8895",
        "26/8.0.0; 420dpi; 1080x2094; samsung; SM-A730F; jackpot2lte; samsungexynos7885",
        "26/8.0.0; 420dpi; 1080x2094; samsung; SM-A605FN; a6plte; qcom",
        "26/8.0.0; 480dpi; 1080x1920; HUAWEI/HONOR; STF-L09; HWSTF; hi3660",
        "27/8.1.0; 480dpi; 1080x2280; HUAWEI/HONOR; COL-L29; HWCOL; kirin970",
        "26/8.0.0; 480dpi; 1080x2032; HUAWEI/HONOR; LLD-L31; HWLLD-H; hi6250",
        "26/8.0.0; 480dpi; 1080x2150; HUAWEI; ANE-LX1; HWANE; hi6250",
        "26/8.0.0; 480dpi; 1080x2032; HUAWEI; FIG-LX1; HWFIG-H; hi6250",
        "27/8.1.0; 480dpi; 1080x2150; HUAWEI/HONOR; COL-L29; HWCOL; kirin970",
        "26/8.0.0; 480dpi; 1080x2038; HUAWEI/HONOR; BND-L21; HWBND-H; hi6250",
        "23/6.0.1; 420dpi; 1080x1920; LeMobile/LeEco; Le X527; le_s2_ww; qcom"
    ];

    const build_arr = [
        "NMF26X",
        "MMB29M",
        "MRA58K",
        "NRD90M",
        "MRA58K",
        "OPM1.171019.011",
        "IMM76L",
        "JZO54K",
        "JDQ39",
        "JLS36I",
        "KTU84P",
        "LRX22C",
        "LMY48M",
        "MMB29V",
        "NRD91N",
        "N2G48C"
    ];

    /**
     * Device constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->deviceString = getDeviceString($username);

        $this->deviceId = deviceString($username);

        $this->uuid = guid($username);

        $this->phoneId = guid($username);

        $this->adid = guid($username);

        $this->build = buildArr($username);
    }

    /**
     * @return string
     */
    public function getDeviceString(): string
    {
        return $this->deviceString;
    }

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getPhoneId(): string
    {
        return $this->phoneId;
    }

    /**
     * @return string
     */
    public function getAdid(): string
    {
        return $this->adid;
    }

    /**
     * @return string
     */
    public function getBuild(): string
    {
        return $this->build;
    }

    /**
     * @return string
     */
    public function getAppUserAgent(): string
    {
        return sprintf(Constants::APP_USER_AGENT, Constants::APP_VERSION, $this->getDeviceString(), Constants::LANG, '253447809');
    }

    public function getWebUserAgent(): string
    {
        return Constants::WEB_USER_AGENT;
    }

    public function getHeaders()
    {
        return [
            'X-IG-App-Locale' => Constants::LANG,
            'X-IG-Device-Locale' => Constants::LANG,
            'X-IG-Mapped-Locale' => Constants::LANG,
            'X-Pigeon-Session-Id' => $this->getUuid(),
            'X-Pigeon-Rawclienttime' => time().'.101',
            'X-IG-Connection-Speed' => '-1kbps',
            'X-IG-Bandwidth-Speed-KBPS' => '-1.000',
            'X-IG-Bandwidth-TotalBytes-B' => rand(500000, 900000),
            'X-IG-Bandwidth-TotalTime-MS' => rand(50, 150),
            'X-Bloks-Version-Id' => Constants::BLOCK_VERSION_ID,
            'X-IG-WWW-Claim' => 0,
            'X-Bloks-Is-Layout-RTL' => false,
            'X-Bloks-Is-Panorama-Enabled' => false,
            'X-IG-Device-ID' => $this->getPhoneId(),
            'X-IG-Android-ID' => $this->getDeviceId(),
            'X-IG-Connection-Type' => 'WIFI',
            'X-IG-Capabilities' => '3brTvx8=',
            'X-IG-App-ID' => Constants::APP_ID,
            'User-Agent' => $this->getAppUserAgent(),
            'Accept-Language' => str_replace('_', '-', Constants::LANG),
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Accept-Encoding' => 'gzip, deflate',
            'X-FB-HTTP-Engine' => 'Liger',
            'X-FB-Client-IP' => 'True',
            'Connection' => 'close'
        ];
    }
}