<?php

namespace App\Imports;

use App\Helper\Actor;
use App\Models\Device;
use App\Models\SerialNumberJaring;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DeviceImport implements ToCollection, WithStartRow
{
    protected $terminal_tipe_id;

    public function __construct($terminal_tipe_id)
    {
        $this->terminal_tipe_id = $terminal_tipe_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {

            $device   = sprintf("%'.05d", DB::table('serial_number_jarings')->count() + 1);
            $datetime = now()->format('dmY');
            $snj      = "100" . (string) $datetime . $device;

            SerialNumberJaring::create(["serial_number_jaring" => $snj]);

            Device::create([
                'terminal_tipe_id' => $this->terminal_tipe_id,
                'nama_device' => $row[0],
                'serial_number_manufacture' => $row[1],
                'serial_number_jaring' => $snj,
                'deskripsi' => $row[2],
                'createdBy' => Actor::name()
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
