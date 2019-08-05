<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController
{
    public static function generateSpreadsheet()
    {
        $sql = new Sql;
        $clients = $sql->query('SELECT * FROM clients');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = range('A', 'J');

        foreach ($columns as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }


        $sheet->setCellValue("A1", 'NOME');
        $sheet->setCellValue("B1", 'DOCUMENTO');
        $sheet->setCellValue("C1", 'CEP');
        $sheet->setCellValue("D1", 'ENDEREÇO');
        $sheet->setCellValue("E1", 'BAIRRO');
        $sheet->setCellValue("F1", 'CIDADE');
        $sheet->setCellValue("G1", 'UF');
        $sheet->setCellValue("H1", 'TELEFONE');
        $sheet->setCellValue("I1", 'E-MAIL');
        $sheet->setCellValue("J1", 'ATIVO');

        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        $index = 2;
        foreach ($clients as $client) {
            $sheet->setCellValue("A$index", $client['name']);
            $sheet->setCellValue("B$index", $client['document']);
            $sheet->setCellValue("C$index", $client['zip_code']);
            $sheet->setCellValue("D$index", $client['address']);
            $sheet->setCellValue("E$index", $client['neighborhood']);
            $sheet->setCellValue("F$index", $client['city']);
            $sheet->setCellValue("G$index", $client['state']);
            $sheet->setCellValue("H$index", $client['phone']);
            $sheet->setCellValue("I$index", $client['email']);
            $sheet->setCellValue("J$index", $client['active']);

            $index++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('clientes.xlsx');
    }
}
