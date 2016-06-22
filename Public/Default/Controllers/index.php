<?php
    class Index extends Pluto\Application\Controller\Controller {

        public function __CONSTRUCT()
        {
            $Example = new Pluto\Models\Example();

            $Example->setVariable('Pluto<strong>CMS</strong>');

            $this->Data([
                'exampleVariable' => $Example->getVariable(),
                'Param2' => 'Parameter Two',
                'Param3' => 'Parameter Three',
            ]);

            echo $this->View('index', 'template', 'title', 'description', ['this', 'is', 'the', 'keywords']);
        }
    }