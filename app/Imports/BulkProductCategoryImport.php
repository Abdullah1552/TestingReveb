<?php

namespace App\Imports;

use App\Models\Product\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Storage;

class BulkProductCategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $error='';
        if($row[0]!=='name') {
            return new Category([
                'name' => @$row[0],
            ]);
        }
        $file=Storage::disk('local')->append(''.time().'_error.txt', $error, $separator = PHP_EOL);
    }
}
