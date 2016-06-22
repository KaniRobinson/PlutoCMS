<?php
    namespace Pluto\Application\Template;

    // Template Engine
    class Template {

        public function Engine()
        {
            $this->getController();
            $this->httpsCheck();
        }

        public function httpsCheck()
        {
            global $Setting;

            if($Setting['https'] == true && $_SERVER['HTTP_X_FORWARDED_PROTO'] != "https")
            {
                header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
                exit();
            }
        }

        public function getController()
        {
            if($_SERVER['REQUEST_URI'] == '/') {
                $Path = 'index';
            } else {
                $Path = str_replace('/', '', $_SERVER['REQUEST_URI']);
            }

            include 'Controllers/' . $Path . '.php';

            $Control = new $Path();
        }

        public function Load($File)
        {
            global $Param;
            // Start output buffer
            ob_start();

            // Include File
            include $File;

            // Get The Contents
            $template = ob_get_contents();

            // End Buffer
            ob_end_clean();

            //Return the File
            return $Param->engine($template);
        }

        public function Exists($File)
        {
            // Checks if File Exists
            return (file_exists($File)) ? true : false;
        }

    }
