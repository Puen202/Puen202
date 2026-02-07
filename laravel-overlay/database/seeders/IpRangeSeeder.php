<?php

namespace Database\Seeders;

use App\Models\IpRange;
use App\Models\Site;
use Illuminate\Database\Seeder;

class IpRangeSeeder extends Seeder
{
    public function run(): void
    {
        $site = Site::firstOrCreate(['name' => 'ITV Principal']);
        $ranges = [
            ['name' => 'Infra/Router/Switch', 'start_ip' => '192.168.0.1', 'end_ip' => '192.168.0.49', 'reserved_gaps' => [[1,5],[45,49]]],
            ['name' => 'Impresoras', 'start_ip' => '192.168.0.50', 'end_ip' => '192.168.0.99', 'reserved_gaps' => [[95,99]]],
            ['name' => 'PCs', 'start_ip' => '192.168.0.100', 'end_ip' => '192.168.0.220', 'reserved_gaps' => [[210,220]]],
            ['name' => 'Móviles/Tablets', 'start_ip' => '192.168.0.221', 'end_ip' => '192.168.0.254', 'reserved_gaps' => [[240,254]]],
        ];

        foreach ($ranges as $range) {
            IpRange::firstOrCreate(
                ['site_id' => $site->id, 'name' => $range['name']],
                ['start_ip' => $range['start_ip'], 'end_ip' => $range['end_ip'], 'reserved_gaps' => $range['reserved_gaps']]
            );
        }
    }
}
