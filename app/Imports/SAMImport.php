<?php

namespace App\Imports;

use App\Helper\Actor;
use App\Models\Sam;
use App\Models\SerialNumberJaring;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class SAMImport implements ToCollection, WithStartRow
{
    protected $issuer_id;
    protected $partner_id;

    public function __construct($issuer_id, $partner_id)
    {
        $this->issuer_id  = $issuer_id;
        $this->partner_id = $partner_id;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $sam = sprintf("%'.05d", DB::table('serial_number_jaring_sams')->count() + 1);
            $datetime = now()->format('dmY');
            $snj = "543" . (string) $datetime . $sam;

            SerialNumberJaring::create(['serial_number_jaring_sam' => $snj]);

            Sam::create([
                'sam_code' => strtoupper(Str::random(15)),
                'partner_id' => $this->partner_id,
                'issuer_id' => $this->issuer_id,
                'serial_number_jaring' => $snj,
                'mid' => $row[0],
                'tid' => $row[1],
                'keterangan' => $row[2],
                'status' => 'in stock',
                'createdBy' => Actor::name(),
                'createdAt' => now()
            ]);

        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
