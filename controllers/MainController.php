<?php
class MainController
{
    public static function home()
    {
        $page = new Page;
        $page->view('index');
    }
}
