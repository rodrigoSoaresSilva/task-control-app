<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class TasksExport
{

    /**
     * Exports task data in the specified format.
     *
     * This method handles the export of task data in different formats such as 'xlsx' and 'csv'.
     * The desired format is provided as a string parameter (`$format`). If no format is specified,
     * it defaults to 'xlsx'. The method retrieves the task data and processes it according to the
     * specified format, generating the corresponding file for download.
     *
     * Supported formats:
     * - 'xlsx': Excel spreadsheet format (default).
     * - 'csv': Comma-separated values format.
     *
     * The method will use appropriate libraries (PhpSpreadsheet) to create and export the file in the
     * chosen format and return the file as a downloadable response.
     */
    public function export(string $format = 'xlsx')
    {
        $tasks = auth()->user()->tasks()->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Título');
        $sheet->setCellValue('C1', 'Prazo');
        $sheet->setCellValue('D1', 'Criado em');
        $sheet->setCellValue('E1', 'Atualizado em');

        $row = 2;
        foreach ($tasks as $task) {
            $sheet->setCellValue('A' . $row, $task->id);
            $sheet->setCellValue('B' . $row, $task->task);
            $sheet->setCellValue('C' . $row, date('d/m/Y', strtotime($task->deadline)));
            $sheet->setCellValue('D' . $row, date('d/m/Y', strtotime($task->created_at)));
            $sheet->setCellValue('E' . $row, date('d/m/Y', strtotime($task->updated_at)));
            $row++;
        }

        $fileName = "lista_de_tarefas.$format";
        $tempFilePath = tempnam(sys_get_temp_dir(), $fileName);

        if ($format === 'csv') {
            $writer = new Csv($spreadsheet);
        } else {
            $writer = new Xlsx($spreadsheet);
        }

        $writer->save($tempFilePath);

        return Response::download($tempFilePath, $fileName)->deleteFileAfterSend(true);
    }

}
