<?php

class ClientController
{

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

    public static function showLogin()
    {
        $page = new Page;
        $page->view('client-login');
    }

    public static function login($login, $password)
    {
        return Client::login($login, $password);
    }

    public static function verifyClientLogin($id)
    {
        if (
            !isset($_SESSION['Client'])
            || !$_SESSION['Client']
            || !(int) $_SESSION['Client']['idclient'] > 0
        ) {
            header('Location: /allblacks-ecommerce');
            exit;
        } else if ($id != $_SESSION['Client']['idclient']) {
            header('Location: /allblacks-ecommerce/client/' . $_SESSION['Client']['idclient']);
            exit;
        }
    }

    public static function logout()
    {
        $_SESSION['Client'] = NULL;
    }

    public static function showLoginError()
    {
        $page = new Page;
        $page->view('client-login-error');
    }
}
