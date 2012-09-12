<?php
require dirname(__DIR__) . '/src/autoload.php';

spl_autoload_register(
   function($class) {
      static $classes = null;
      if ($classes === null) {
         $classes = array(
            'statapus\\apptest' => '/unit/AppTest.php',
                'statapus\\dbfake' => '/mocks/DbFake.php',
                'statapus\\dbtest' => '/unit/DbTest.php'
          );
      }
      $cn = strtolower($class);
      if (isset($classes[$cn])) {
         require __DIR__ . $classes[$cn];
      }
   }
);