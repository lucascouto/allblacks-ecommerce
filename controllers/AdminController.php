<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController
{
    public static function generateSpreadsheet()
    {
        $clients = Client::listAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = range('A', 'J');

        /* SET THE COLUMNS WIDTH TO AUTO-SIZE */
        foreach ($columns as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        /* SET HEADER OF THE TABLE */
        $header = [
            'NOME',
            'DOCUMENTO',
            'CEP',
            'ENDEREÇO',
            'BAIRRO',
            'CIDADE',
            'UF',
            'TELEFONE',
            'E-MAIL',
            'ATIVO'
        ];

        $sheet->fromArray($header);
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        /* SET THE CONTENT OF THE TABLE, ROW BY ROW */
        $data = [];
        foreach ($clients as $client) {
            $clientData = [];
            /* array_slice to skip the 'idclient' field from database */
            foreach (array_slice($client, 1) as $fieldValue) {
                array_push($clientData, $fieldValue);
            }
            array_push($data, $clientData);
        }

        $sheet->fromArray($data, null, 'A2');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public static function uploadSpreadsheet($file)
    {
        $clientObj = new Client;

        if (!empty($file)) {
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file);

            $sheet = $spreadsheet->getActiveSheet();

            $highestRow = $sheet->getHighestRow();

            for ($row = 2; $row <= $highestRow; $row++) {
                $data = [
                    'name' => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
                    'document' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'zipcode' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
                    'address' => $sheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'neighborhood' => $sheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'city' => $sheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'state' => $sheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'phone' => $sheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'email' => $sheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'active' => $sheet->getCellByColumnAndRow(10, $row)->getValue()
                ];

                $clientObj->save($data);
            }
        }
    }

    public static function uploadXML($file)
    {
        $clientObj = new Client;

        if (!empty($file)) {
            $xml = new DOMDocument();
            $xml->load($file);

            $clients = $xml->getElementsByTagName('torcedor');



            foreach ($clients as $client) {
                $data = [
                    'name' => $client->getAttribute('nome'),
                    'document' => $client->getAttribute('documento'),
                    'zipcode' => $client->getAttribute('cep'),
                    'address' => $client->getAttribute('endereco'),
                    'neighborhood' => $client->getAttribute('bairro'),
                    'city' => $client->getAttribute('cidade'),
                    'state' => $client->getAttribute('uf'),
                    'phone' => $client->getAttribute('telefone'),
                    'email' => $client->getAttribute('email'),
                    'active' => $client->getAttribute('ativo')
                ];

                $clientObj->save($data);
            }
        }
    }
}
