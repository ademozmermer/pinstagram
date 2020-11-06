<?php


namespace AdemOzmermer\Auth;

use AdemOzmermer\Client\Http;
use GuzzleHttp\Cookie\FileCookieJar;
use GuzzleHttp\Exception\ClientException;
use AdemOzmermer\Core\{Constants, Device};

class Auth extends Http
{
    private $_username;

    private $_password;

    private $_proxy;

    private $_devices;

    private $_cookies;

    /**
     * Auth constructor.
     * @param $username
     * @param $password
     * @param false $proxy
     */
    public function __construct($username, $password, $proxy = false)
    {
        $baseDir = realpath(getcwd());

        $this->_username = $username;

        $this->_password = $password;

        $this->_proxy = $proxy;

        $this->_cookies = new FileCookieJar($baseDir.'/cookies/'.$username.'.json');

        $this->_devices = new Device($this->_username);
    }

    /**
     * Login olmadan önce bu istek gönderilmelidir
     */
    private function init(): void
    {
        $this->headers($this->_devices->getHeaders())
            ->proxy($this->_proxy)
            ->form(['signed_body' => 'SIGNATURE.{"id":"'.$this->_devices->getDeviceId().'","server_config_retrieval":"1","experiments":"ig_android_device_detection_info_upload,ig_android_gmail_oauth_in_reg,ig_android_account_linking_upsell_universe,ig_android_direct_main_tab_universe_v2,ig_android_direct_add_direct_to_android_native_photo_share_sheet,ig_growth_android_profile_pic_prefill_with_fb_pic_2,ig_account_identity_logged_out_signals_global_holdout_universe,ig_android_quickcapture_keep_screen_on,ig_android_device_based_country_verification,ig_android_login_identifier_fuzzy_match,ig_android_reg_modularization_universe,ig_android_video_render_codec_low_memory_gc,ig_android_device_verification_separate_endpoint,ig_android_suma_landing_page,ig_android_smartlock_hints_universe,ig_android_retry_create_account_universe,ig_android_caption_typeahead_fix_on_o_universe,ig_android_reg_nux_headers_cleanup_universe,ig_android_nux_add_email_device,ig_android_device_info_foreground_reporting,ig_android_device_verification_fb_signup,ig_android_passwordless_account_password_creation_universe,ig_android_security_intent_switchoff,ig_android_sim_info_upload,ig_android_fb_account_linking_sampling_freq_universe"}'])
            ->cookies($this->_cookies);
        $this->request('POST', Constants::APP_INIT_URL.'/api/v1/qe/sync/');
    }

    public function login()
    {
        $this->init();
        $form = [
            'jazoest' => '22646',
            'country_codes' => "[{\"country_code\":\"1\",\"source\":[\"default\"]}]",
            'phone_id' => $this->_devices->getPhoneId(),
            'enc_password' => '#PWD_INSTAGRAM:0:'.time().':'.$this->_password,
            '_csrftoken' => $this->_cookies->getCookieByName('csrftoken')->getValue(),
            'username' => $this->_username,
            'adid' => '',
            'guid' => $this->_devices->getUuid(),
            'device_id' => $this->_devices->getDeviceId(),
            'google_tokens' => '[]',
            'login_attempt_count' => '0'
        ];

        $this->headers($this->_devices->getHeaders());
        $this->cookies($this->_cookies);
        $this->proxy($this->_proxy);
        $this->form(['signed_body' => 'SIGNATURE.'.json_encode($form)]);

        try {
            $response = $this->request('POST', Constants::APP_URL.'/api/v1/accounts/login/');
        } catch (ClientException $exception) {
            return json_decode($exception->getResponse()->getBody());
        }

        return $response->getHeaders();
    }
}