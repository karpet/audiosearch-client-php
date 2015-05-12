<?php

class Audiosearch_Client {

    private $access_token;
    private $host;
    private $version = '1.0.0';
    private $user_agent = 'audiosearch-client-php';

    /**
     *
     *
     * @param unknown $args (optional)
     */
    public function __construct($args=array()) {
        $client_key = isset($args['id'])
            ? $args['id']
            : (
            isset($args['key'])
            ? $args['key']
            : getenv('AS_ID')
        );
        $client_secret = isset($args['secret'])
            ? $args['secret']
            : getenv('AS_SECRET');
        $this->host = isset($args['host'])
            ? $args['host']
            : (
            getenv('AS_HOST')
            ? getenv('AS_HOST')
            : 'https://www.audiosear.ch'
        );

        if (!$client_key or !$client_secret) {
            throw new Exception("Must define client key and secret");
        }

        // get auth token
        $signature = base64_encode("$client_key:$client_secret");
        $auth_url = $this->host . '/oauth/token';
        $params = array('grant_type' => 'client_credentials');
        $resp = Requests::post($auth_url, array('Authorization' => "Basic $signature"), $params);
        $resp_json = json_decode($resp->body);
        $this->access_token = $resp_json->access_token;

    }


    /**
     *
     *
     * @param string  $path
     * @param array   $params (optional)
     * @return object
     */
    public function get($path, $params=false) {
        $uri = sprintf("%s/api/%s", $this->host, $path);
        if ($params) {
            $uri .= '?' . http_build_query($params);
        }
        $resp = Requests::get($uri, array('Authorization' => "Bearer " . $this->access_token));
        return json_decode($resp->body);
    }


    /**
     *
     *
     * @param integer $show_id
     * @return unknown
     */
    public function get_show($show_id) {
        return $this->get("/shows/$show_id");
    }


    /**
     *
     *
     * @param integer $ep_id
     * @return unknown
     */
    public function get_episode($ep_id) {
        return $this->get("/episodes/$ep_id");
    }


    /**
     *
     *
     * @param array   $params
     * @param string  $type   (optional) defaults to 'episodes'
     * @return object
     */
    public function search($params, $type='episodes') {
        return $this->get("/search/$type", $params);
    }


}
