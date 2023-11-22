<?php

namespace App\Imports;

use App\Models\DiagnosticsImport as DiagnosticsImportModel;
use Maatwebsite\Excel\Concerns\ToModel;

class DiagnosticsImport implements ToModel
{

    public function model(array $row)
    {

        testSachin($row);
    }
}
