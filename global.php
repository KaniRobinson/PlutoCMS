<?php
  // Get Global Configuration File
  include '../../configuration.php';

  // Get Settings
  include 'setting.php';

  // Error Reporting Referal: http://php.net/manual/en/errorfunc.constants.php
  error_reporting($Configuration['errors']);

  // Get Ini Settings Referal: http://php.net/manual/en/ini.list.php
  foreach($Configuration['ini'] as $Key => $Val)
  {
    ini_set($Key, $Val);
  }

  // Sessions Manager Referal: http://php.net/manual/en/session.configuration.php
  session_set_cookie_params($Configuration['session']['lifetime'], $Configuration['session']['path'], $Configuration['session']['domain'], $Configuration['session']['secure'], $Configuration['session']['httponly']);
  session_start($Configuration['session']['options']);

  // Call Application Classes
  foreach($Configuration['application'] as $Key => $Val)
  {
    include str_replace(['Pluto\\', "\\"], ['', '/'], $Val) . '.php';

    if(!is_numeric($Key))
    { 
      ${$Key} = new $Val();
    }
  }

  // Call Models
  foreach($Setting['models'] as $Key => $Val)
  {
    include str_replace(['Pluto\\', "\\"], ['', '/'], $Val) . '.php';
  }