<?php

function __autoload($classname) {
  $classname = ltrim($classname, '\\');
  $filename  = '';
  $namespace = '';
  if ($lastnspos = strripos($classname, '\\')) {
    $namespace = substr($classname, 0, $lastnspos);
    $classname = substr($classname, $lastnspos + 1);
    $filename  = str_replace('\\', '/', $namespace) . '/';
  }
  $filename .= str_replace('_', '/', $classname) . '.php';
  require $filename;
}
?>