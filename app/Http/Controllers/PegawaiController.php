<?php

namespace App\Http\Controllers;

use App\Enums\SubUnit;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawaiDb = Pegawai::ordered()->get();

        // Group by sub_unit for categorized display
        $kepalaUpt = null;
        $unitOperasional = [];
        $unitTataUsaha = collect();
        $ppnpn = collect();

        if ($pegawaiDb->isNotEmpty()) {
            foreach ($pegawaiDb as $p) {
                $item = [
                    'nama' => $p->nama,
                    'jabatan' => $p->jabatan,
                    'nip' => $p->nip,
                    'pendidikan' => $p->pendidikan,
                    'golongan' => $p->golongan,
                    'foto' => $p->foto_url,
                    'sub_unit' => $p->sub_unit,
                ];

                if ($p->sub_unit === SubUnit::KepalaUpt) {
                    $kepalaUpt = $item;
                } elseif ($p->sub_unit?->isOperasional()) {
                    $key = $p->sub_unit->value;
                    if (! isset($unitOperasional[$key])) {
                        $unitOperasional[$key] = [
                            'label' => $p->sub_unit->label(),
                            'members' => [],
                        ];
                    }
                    $unitOperasional[$key]['members'][] = $item;
                } elseif ($p->sub_unit === SubUnit::TataUsaha) {
                    $unitTataUsaha->push($item);
                } elseif ($p->sub_unit === SubUnit::Ppnpn) {
                    $ppnpn->push($item);
                } else {
                    // Fallback: employees without sub_unit assigned
                    $ppnpn->push($item);
                }
            }
        }

        // Ensure consistent ordering of operational sub-units
        $operasionalOrder = [
            SubUnit::Forecaster->value,
            SubUnit::Observer->value,
            SubUnit::DataInformasi->value,
            SubUnit::Teknisi->value,
        ];

        $sortedOperasional = [];
        foreach ($operasionalOrder as $key) {
            if (isset($unitOperasional[$key])) {
                $sortedOperasional[$key] = $unitOperasional[$key];
            }
        }

        return view('pages.profil.sdm', [
            'kepalaUpt' => $kepalaUpt,
            'unitOperasional' => $sortedOperasional,
            'unitTataUsaha' => $unitTataUsaha,
            'ppnpn' => $ppnpn,
        ]);
    }

    public function struktur()
    {
        $pegawaiDb = Pegawai::ordered()->get();

        $kepalaUpt = null;
        $unitOperasional = [];
        $unitTataUsaha = collect();
        $ppnpn = collect();

        foreach ($pegawaiDb as $p) {
            $item = [
                'nama' => $p->nama,
                'jabatan' => $p->jabatan,
                'foto' => $p->foto_url,
                'sub_unit' => $p->sub_unit,
            ];

            if ($p->sub_unit === SubUnit::KepalaUpt) {
                $kepalaUpt = $item;
            } elseif ($p->sub_unit?->isOperasional()) {
                $key = $p->sub_unit->value;
                if (! isset($unitOperasional[$key])) {
                    $unitOperasional[$key] = [
                        'label' => $p->sub_unit->label(),
                        'members' => [],
                    ];
                }
                $unitOperasional[$key]['members'][] = $item;
            } elseif ($p->sub_unit === SubUnit::TataUsaha) {
                $unitTataUsaha->push($item);
            } elseif ($p->sub_unit === SubUnit::Ppnpn) {
                $ppnpn->push($item);
            } else {
                $ppnpn->push($item);
            }
        }

        $operasionalOrder = [
            SubUnit::Forecaster->value,
            SubUnit::Observer->value,
            SubUnit::DataInformasi->value,
            SubUnit::Teknisi->value,
        ];

        $sortedOperasional = [];
        foreach ($operasionalOrder as $key) {
            if (isset($unitOperasional[$key])) {
                $sortedOperasional[$key] = $unitOperasional[$key];
            }
        }

        return view('pages.profil.struktur', [
            'kepalaUpt' => $kepalaUpt,
            'unitOperasional' => $sortedOperasional,
            'unitTataUsaha' => $unitTataUsaha,
            'ppnpn' => $ppnpn,
        ]);
    }
}
