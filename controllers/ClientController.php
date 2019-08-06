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

    public static function show($id)
    {
        if ($clientObj = Client::loadById($id)) {
            $client = $clientObj->getValues();

            $page = new Page;
            $page->view('client-detail', [
                'client' => $client
            ]);
        }
    }

    public static function create()
    {
        $page = new Page;
        $page->view('client-create');
    }

    public static function destroy($id)
    {
        Client::delete($id);
    }

    public static function edit($id)
    {
        if ($clientObj = Client::loadById($id)) {
            $client = $clientObj->getValues();


            $page = new Page;
            $page->view('client-update', [
                'client' => $client
            ]);
        }
    }

    public static function update($id, $data)
    {
        Client::update($id, $data);
    }


    public static function store($data)
    {
        Client::save($data);
    }
}
