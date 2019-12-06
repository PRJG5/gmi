<?php


namespace App\Imports;

use App\Subdomain;
use Maatwebsite\Excel\Concerns\ToModel;

class SubDomainsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if(!empty($row[0])){
            return new Subdomain([
                'content'=> $row[0],
            ]);
        }

    }
}