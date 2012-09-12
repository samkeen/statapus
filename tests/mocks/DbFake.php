<?php
namespace Statapus;
/**
 * Created by JetBrains PhpStorm.
 * User: sam
 * Date: 9/11/12
 * Time: 3:38 PM
 * To change this template use File | Settings | File Templates.
 */
class DbFake extends Db
{
    function __construct()
    {
        // do noting
    }

    function db_handle()
    {
        return null;
    }

}
