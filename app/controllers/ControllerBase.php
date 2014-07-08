<?php

use Phalcon\Mvc\Controller;

abstract class ControllerBase extends Controller
{
    const MESSSAGES_PATH = '/../messages/';

    public function initialize()
    {
        $this->view->setVar("t", $this->_getTranslation() );
    }

    protected function _getTranslation()
    {
        $dir = self::MESSSAGES_PATH;
        $lang = $this->request->getBestLanguage();

        $file = $dir.$lang.".php";
        $file = file_exists($file) ? $file : $dir."pt-BR.php";

        return new \Phalcon\Translate\Adapter\NativeArray(array(
            "content" => require $file
        ));
    }
}
