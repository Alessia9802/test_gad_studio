<?php

namespace App\Imports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class AgenciesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

     use Importable;

    public function model(array $row)
    {
        return new Agency([
            'ragione_sociale' => $row['ragione_sociale'],
            'indirizzo' => $row['indirizzo'],
            'codice_postale' => $row['codice_postale'],
            'città' => $row['città'],
            'provincia' => $row['provincia'],
            'regione' => $row['regione'],
            'email' => $row['email'],
        ]);
    }
}
