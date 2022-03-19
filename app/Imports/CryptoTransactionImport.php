<?php

namespace App\Imports;

use App\Models\CryptoTransaction;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CryptoTransactionImport implements ToModel, WithCustomCsvSettings, WithStartRow , WithValidation, SkipsEmptyRows
{
    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '0' => 'required|integer',
            '1' => 'required|string',
            '2' => 'required|string',
            '3' => 'required|integer',
            '4' => 'required|string',
            '5' => 'required|string',
            '6' => 'required|boolean',
            '7' => 'required|string',
            '8' => 'required|decimal',
            '9' => 'required|decimal',
            '10' => 'required|decimal',
            '11' => 'required|decimal',
            '12' => 'required|decimal',

            // so on
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter'              => ",",
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row[13])) {
            $row[13]=NULL;
        }elseif(isset($row[13])){
            $row[13]=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]);
        }
        if (!isset($row[14])) {
            $row[14]=NULL;
        }elseif(isset($row[14])){
            $row[14]=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14]);
        }

        // $row[6] = str_replace('"','',$row[6]);
        // $row[8] = str_replace('"','',$row[8]);
        // $row[9] = str_replace('"','',$row[9]);
        // $row[10] = str_replace('"','',$row[10]);
        // $row[12] = str_replace('"','',$row[12]);
        return new CryptoTransaction([
            'id'     => $row[0],
            'name'   => $row[1],
            'ticker' => $row[2],
            'coin_id' => $row[3],
            'code' => $row[4],
            'exchange' => $row[5],
            'invalid' => $row[6],
            'record_time' => $row[7],
            'usd' => $row[8],
            'idr' => $row[9],
            'hnst' => $row[10],
            'eth' => $row[11],
            'btc' => $row[12],
            'created_at' => $row[13],
            'updated_at' => $row[14],
        ]);
    }
}
