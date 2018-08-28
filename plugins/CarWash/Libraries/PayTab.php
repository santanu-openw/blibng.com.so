<?php

namespace Zix\CarWash\Libraries;


/**
 * Class PayTab
 * @package Zix\CarWash\Libraries
 */
class PayTab
{
    protected $config = [
        'VERIFY_URL' => 'https://www.paytabs.com/apiv2/verify_payment',
        'PAYPAGE_URL' => 'https://www.paytabs.com/apiv2/create_pay_page',
        'AUTHENTICATION' => 'https://www.paytabs.com/apiv2/validate_secret_key',
        'TESTING' => 'https://localhost:8888/paytabs/apiv2'
    ];
    /**
     * @var
     */
    private $merchant_id;
    /**
     * @var
     */
    private $secret_key;


    /**
     * @param $merchant_email
     * @param $secret_key
     */
    public function __construct($merchant_email, $secret_key)
    {
        $this->merchant_email = $merchant_email;
        $this->secret_key = $secret_key;
        $this->api_key = "";
    }

    /**
     * @return string
     */
    public function authentication()
    {
        $obj = json_decode($this->runPost($this->config['AUTHENTICATION'], array("merchant_email" => $this->merchant_email, "secret_key" => $this->secret_key)));
        if ($obj->access == "granted")
            $this->api_key = $obj->api_key;
        else
            $this->api_key = "";
        return $this->api_key;
    }

    /**
     * @param $values
     * @return mixed
     */
    public function create_pay_page($values)
    {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['secret_key'] = $this->secret_key;
        $values['ip_customer'] = request()->ip();
        $values['ip_merchant'] = request()->ip();
        return json_decode($this->runPost($this->config['PAYPAGE_URL'], $values));
    }

    /**
     * @return mixed
     */
    public function send_request()
    {
        $values['ip_customer'] = request()->ip();
        $values['ip_merchant'] = request()->server('SERVER_ADDR');
        return json_decode($this->runPost($this->config['TESTING'], $values));
    }


    /**
     * @param $payment_reference
     * @return mixed
     */
    public function verify_payment($payment_reference)
    {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['payment_reference'] = $payment_reference;
        return json_decode($this->runPost($this->config['VERIFY_URL'], $values));
    }

    /**
     * @param $url
     * @param $fields
     * @return mixed
     */
    public function runPost($url, $fields)
    {
//        dd($fields);
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = request()->ip();

        $ip_address = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $ip_address);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}