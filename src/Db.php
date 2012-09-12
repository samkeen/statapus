<?php
namespace Statapus;
/**
 * Created by JetBrains PhpStorm.
 * User: sam
 * Date: 9/11/12
 * Time: 3:05 PM
 * To change this template use File | Settings | File Templates.
 */
class Db
{
    private $config = array(
        'host'     => null,
        'port'     => null,
        'database' => null,
        'username' => null,
        'password' => null,
    );
    private $db_handle = null;

    function __construct(array $config)
    {
        $missing_params = array_diff_key($this->config, $config);
        if($missing_params)
        {
            throw new \InvalidArgumentException(
                "Missing param key(s): ['".implode("', '", array_keys($missing_params))."']"
                    ." Required keys: ['".implode("', '", array_keys($this->config))."']"
            );
        }
        $test_for_empty = $config;
        unset($test_for_empty['password']);
        if(count($test_for_empty) != count(array_filter($test_for_empty)))
        {
            throw new \InvalidArgumentException(
                "One or more required db config values was empty: ". print_r($test_for_empty, true)
            );
        }
        $this->config = $config;
        $this->db_handle = $this->db_handle();
    }

    /**
     * @return \PDO
     */
    function db_handle()
    {
        $dsn = "mysql:dbname={$this->config['database']};host={$this->config['host']}:{$this->config['port']}";
        $db_handle = new \PDO($dsn, $this->config['username'], $this->config['password']);
        return $db_handle;
    }
}
