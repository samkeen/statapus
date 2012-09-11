<?php
spl_autoload_register(
   function($class) {
      static $classes = null;
      if ($classes === null) {
         $classes = array(
            'octoshepherd\\mockresponsefactory' => '/vendor/octo_shepherd/tests/response_stubs/MockResponseFactory.php',
                'octoshepherd\\octoobject' => '/vendor/octo_shepherd/src/OctoObject.php',
                'octoshepherd\\shepherd' => '/vendor/octo_shepherd/src/Shepherd.php'
          );
      }
      $cn = strtolower($class);
      if (isset($classes[$cn])) {
         require __DIR__ . $classes[$cn];
      }
   }
);