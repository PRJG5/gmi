<?php


namespace App\Imports;

use App\Domain;
use Maatwebsite\Excel\Concerns\ToModel;

class DomainsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if(!empty($row[0])){
            return new Domain([
                'content'=> $row[0],
            ]);
        }

    }
}