<?php
namespace Statapus;
/**
 * Created by JetBrains PhpStorm.
 * User: sam
 * Date: 9/11/12
 * Time: 1:53 PM
 * To change this template use File | Settings | File Templates.
 */
class App
{
    private $config = array(
        'client_id'     => null,
        'client_secret' => null,
        'base_path'     => null,
    );
    /**
     * @var Db
     */
    private $db;

    private $service_state = null;

    function __construct(array $config, Db $db)
    {
        $missing_params = array_diff_key($this->config, $config);
        if($missing_params)
        {
            throw new \InvalidArgumentException(
                "Missing param key(s): ['".implode("', '", array_keys($missing_params))."']"
                    ." Required keys: ['".implode("', '", array_keys($this->config))."']"
            );
        }
        $this->db = $db;
        $this->config = $config;
    }
    public function init()
    {
        $this->service_state = $this->get_service_state();
        Http::set_base_path($this->config['base_path']);
    }

    function get_client_id()
    {
        return $this->config['client_id'];
    }
    function get_client_secret()
    {
        return $this->config['client_secret'];
    }

    function get_access_token()
    {
        return isset($this->service_state['access_token']) ? $this->service_state['access_token'] : null;
    }

    function app_is_authed()
    {
        return $this->service_state && $this->service_state['access_token'];
    }

    function record_access_token($access_token)
    {
        $dbh = $this->db->db_handle();
        $stmt =  $dbh->prepare("UPDATE `service_state` SET `access_token` = :access_token");
        $stmt->execute(array(':access_token' => $access_token));
    }

    protected function get_service_state()
    {
        $dbh = $this->db->db_handle();
        $stmt =  $dbh->prepare("SELECT * FROM `service_state`");
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result ? $result[0] : null;
    }




}
