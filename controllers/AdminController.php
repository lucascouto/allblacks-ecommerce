<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

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
            $higestColumn = $sheet->getHighestColumn();
            $higestColumnIndex = Coordinate::columnIndexFromString($higestColumn);

            $keys = [
                'name', 'document', 'zipcode',
                'address', 'neighborhood', 'city',
                'state', 'phone', 'email', 'active'
            ];

            for ($row = 2; $row <= $highestRow; $row++) {
                for ($column = 1; $column <= $higestColumnIndex; $column++) {
                    $data[$keys[$column - 1]] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
                }
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

            $keys = [
                'name', 'document', 'zipcode',
                'address', 'neighborhood', 'city',
                'state', 'phone', 'email', 'active'
            ];

            foreach ($clients as $client) {
                $i = 0;
                foreach ($client->attributes as $attribute) {
                    $data[$keys[$i]] = $attribute->nodeValue;
                    $i++;
                }

                $clientObj->save($data);
            }
        }
    }

    public static function sendEmail($subject, $tplName, $data = [])
    {
        $clients = Client::listAll();

        $recipients = [];
        foreach ($clients as $client) {
            if ($client['email'])
                array_push($recipients, [$client['email'] => $client['name']]);
        }

        $mail = new Mailer($recipients, $subject, $tplName, $data);
        if ($mail->send()) {
            echo 'ENVIADO COM SUCESSO!';
        }
    }
}
