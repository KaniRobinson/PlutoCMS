<?php
    namespace Pluto\Application\Template;

    class Param {

    	public $Params = [];

    	public function create($Find, $Data)
    	{
    		@$this->Params[$Find] = $Data;
    	}

        public function Functions($File)
        {
            $File = preg_replace("~\{!!\s*(.+?)\s*\}~", "<?=$1?>", $File);

            return $File;

        }

    	public function engine($File)
    	{
    		foreach($this->Params as $Key => $Val){
    			$File  = str_replace('{' . $Key . '}', $Val, $File);
    		}

    		return $this->Functions($File);
    	}
    }
