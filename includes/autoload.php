<?php
spl_autoload_register(function($className) {
   $dir="/datos/www/preadmespecial.aragon.es/public_admespecial/";
   $filename = $dir . $class_name . '.php';
   include $filename;
   /*
   $file = dirname(__DIR__) . '\\public_admespecial\\' . $className . '.php';
   $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
   echo $file;
   if (file_exists($file)) {
      include $file;
   }
   */
});
