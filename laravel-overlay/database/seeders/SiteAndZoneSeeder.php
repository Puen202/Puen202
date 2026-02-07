<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class SiteAndZoneSeeder extends Seeder
{
    public function run(): void
    {
        $site = Site::firstOrCreate(['name' => 'ITV Principal']);

        $zones = [
            ['name' => 'Sala de servidores', 'code' => 'SRV'],
            ['name' => 'Oficina', 'code' => 'OFI'],
            ['name' => 'Nave (General)', 'code' => 'NAV'],
            ['name' => 'Línea 1', 'code' => 'LINEA1'],
            ['name' => 'Línea 2', 'code' => 'LINEA2'],
            ['name' => 'Línea 3', 'code' => 'LINEA3'],
            ['name' => 'Línea 4A', 'code' => 'LINEA4A'],
            ['name' => 'Línea 4B', 'code' => 'LINEA4B'],
            ['name' => 'Cabina', 'code' => 'CAB'],
            ['name' => 'Puntos WiFi', 'code' => 'WIFI'],
            ['name' => 'Bocas de red', 'code' => 'LAN'],
        ];

        foreach ($zones as $zone) {
            Zone::firstOrCreate(['site_id' => $site->id, 'code' => $zone['code']], ['name' => $zone['name']]);
        }
    }
}
