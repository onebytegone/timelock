<?php

// Config
require('environment.php');


// Main handler

$parts = pathinfo($_GET['requested']);
$requestedFile  = $parts['basename'];

if (file_is_allowed($requestedFile)) {
   $path = path_for_file($requestedFile);
   if (file_exists($path)) {
      return_file($path);
      return;
   }
}
return_not_found();


// Helper functions

function file_is_allowed($filename) {
   $configured = get_config_for_file($filename);
   return $configured && isset($configured['datetime']) ? strtotime($configured['datetime']) <= time() : false;
}

function path_for_file($filename) {
   return rtrim(STORAGE_DIR) . '/' . $filename;
}

function get_config_for_file($filename) {
   $config = json_decode(file_get_contents(CONFIG_FILE), true);
   return isset($config[$filename]) ? $config[$filename] : null;
}

function return_not_found() {
   header("HTTP/1.0 404 Not Found");
   die();
}

function return_file($path) {
   $finfo = finfo_open(FILEINFO_MIME_TYPE);
   $mimeType = finfo_file($finfo, $path);
   finfo_close($finfo);

   header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
   header('Cache-Control: public');
   header('Content-Type: ' . $mimeType);
   header('Content-Length:' . filesize($path));
   readfile($path);
   die();
}
