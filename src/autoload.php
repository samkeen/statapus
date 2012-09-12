<?php
spl_autoload_register(
   function($class) {
      static $classes = null;
      if ($classes === null) {
         $classes = array(
            'octoshepherd\\mockresponsefactory' => '/vendor/octo_shepherd/tests/response_stubs/MockResponseFactory.php',
                'octoshepherd\\octoobject' => '/vendor/octo_shepherd/src/OctoObject.php',
                'octoshepherd\\shepherd' => '/vendor/octo_shepherd/src/Shepherd.php',
                'presta\\curler' => '/vendor/octo_shepherd/src/vendor/presta/src/Curler.php',
                'presta\\prestatestbase' => '/vendor/octo_shepherd/src/vendor/presta/tests/PrestaTestBase.php',
                'presta\\request' => '/vendor/octo_shepherd/src/vendor/presta/src/Request.php',
                'presta\\response' => '/vendor/octo_shepherd/src/vendor/presta/src/Response.php',
                'presta\\util\\arr' => '/vendor/octo_shepherd/src/vendor/presta/src/util/Arr.php',
                'statapus\\app' => '/App.php',
                'statapus\\db' => '/Db.php',
                'statapus\\http' => '/util/Http.php'
          );
      }
      $cn = strtolower($class);
      if (isset($classes[$cn])) {
         require __DIR__ . $classes[$cn];
      }
   }
);