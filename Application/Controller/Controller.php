<?php
    namespace Pluto\Application\Controller;

    class Controller {

        private $Data;
        private $Content = '{@content}';

        public function View($View, $Structure, $Title='', $Description='', $Keywords='')
        {
            global $Param, $Template, $Setting;

            $Param->create('Title', $Title);
            $Param->create('Description', $Description);
            $Param->create('Keywords', self::createKeywords($Keywords));
            $Param->create('basehref', 'Assets/');
            $Param->create('View', $View);
            $Param->create('Structure', $Structure);
            $Param->create('Domain', $Setting['domain']);

            $Structure = $Template->Load('Structure/' . $Structure . '.php');
            $View = str_replace($this->Content, $Template->Load('Views/' . $View . '.php'), $Structure);

            return $View;

        }

        public function createKeywords($Keywords)
        {
            $Keyword = '';

            foreach($Keywords as $Key => $Val)
            {
                $Keyword .= $Val . ', ';
            }

            $Keyword = rtrim($Keyword, ', ');

            return $Keyword;

        }

        public function Data($Data)
        {
            global $Param;

            $this->Data = $Data;
            
            foreach($this->Data as $Key => $Val)
            {
                $Param->create($Key, $Val);
            }
        }

        public function Login()
        {

        }

    }