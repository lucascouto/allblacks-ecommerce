<?php

class ClientController
{
    public static function showAll()
    {
        $clients = Client::listAll();

        $page = new Page;
        $page->view('clients', [
            'clients' => $clients
        ]);
    }
}
