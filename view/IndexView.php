<?php
class IndexView extends TwigView 
{
    protected static $instance;
    //get instance singelton
    public static function getInstance()
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
    public function show($infoIndex) 
    {       
        echo self::getTwig()->render('index.html', array('infoIndex' => $infoIndex)); 
    }   
}
?>