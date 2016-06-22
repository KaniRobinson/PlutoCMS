<?php
    namespace Pluto\Application\Cache;

    use Pluto\Application\Template\Template;
    
    /* Todo Tasks:
     * 
     * Create Custom File Names.
     *  filemtime of the fileName and .Cache
     *  Set The FileType at the Top of the file.
     *
    */

    class Cache {

        private $Location = "Cache/";
        private $Trash = "Trash/";

        public function getLocation()
        {
            return $this->Location;
        }

        public function getTrash()
        {
            return $this->getLocation() . "Trash/";
        }

        public function __CONSTRUCT($Content, $fileName, $Time=60)
        {

            if($this->Exists($Content, $fileName))
            {
                if($this->timeOut($Time, $fileName))
                {
                    $this->Create($Content, $fileName);
                }
            } else {
                $this->Create($Content, $fileName);
            }
        }

        // Create Cache File
        public function Create($Content, $fileName)
        {
            $myfile = fopen($this->getLocation() . $fileName, "w") or die("Unable to open file!");
            fwrite($myfile, $Content);
            fclose($myfile);
        }

        // Exists
        public function Exists($Content, $fileName)
        {
            if(file_exists($this->getLocation() . $fileName))
            {
                return true;
            } else {
                return false;
            }
        }

        // Cache Timeout
        public function timeOut($Time, $fileName)
        {
            if(time() - filemtime($this->getLocation() . $fileName) >= $Time)
            {
                return true;
            } else {
                return false;
            }
        }

        // Get Cache
        public function Get($fileName, $Time=60, $Content="")
        {
            if($this->timeOut($Time, $fileName))
            {
                $this->Create($Content, $fileName);
            }

            return Template::Load($this->getLocation() . $fileName);
        }
        

        // Delete Cache
        public function Remove($fileName, $Content="")
        {
            if($this->Exists($Content, $fileName))
            {
                copy($this->getLocation() . $fileName, $this->getTrash() . $fileName);
                $this->Delete($fileName);

            }
        }

        public function Delete($fileName, $Content="")
        {
            if($this->Exists($Content, $fileName))
            {
                unlink($this->getLocation() . $fileName);
            }
        }

        // Recover Cache
        public function Recover($fileName, $Content="")
        {
            if($this->Exists($Content, $this->Trash . $fileName))
            {
                copy($this->getTrash() . $fileName, $this->getLocation() . $fileName);
                $this->Delete($this->Trash . $fileName);

            }
        }
    }