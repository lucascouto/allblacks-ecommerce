<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController
{
    public static function generateSpreadsheet()
    {
        $sql = new Sql;
        $clients = $sql->select('SELECT * FROM clients');

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
}
