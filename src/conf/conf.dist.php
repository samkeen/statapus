<?php
/*
 * copy this file to conf.php and fill with appropriate 
 * values.
 * 
 * The OctoShepherd\Shepherd class has a block of public attributes
 * @see OctoShepherd\Shepherd::attributes()
 * 
 * You can define any of those values here and pass them to the constructor
 * 
 *     new OctoShepherd\Shepherd($config);
 */
return array(
    /*
     * register at https://github.com/settings/applications/new to get these
     * credentials for your App
     */
    'client_id'     => '',
    'client_secret' => '',
    'base_path'     => 'http://localhost/statapus',
    'db' => array(
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'statapus',
        'username' => 'root',
        'password' => '',
    )
);