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
        $timKerja = [];

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
                    'is_ketua_tim' => $p->is_ketua_tim,
                ];

                if ($p->sub_unit === SubUnit::KepalaUpt) {
                    $kepalaUpt = $item;
                } elseif ($p->sub_unit?->isTimKerja()) {
                    $key = $p->sub_unit->value;
                    if (! isset($timKerja[$key])) {
                        $timKerja[$key] = [
                            'label' => $p->sub_unit->label(),
                            'ketua' => null,
                            'members' => [],
                        ];
                    }
                    if ($p->is_ketua_tim) {
                        $timKerja[$key]['ketua'] = $item;
                    } else {
                        $timKerja[$key]['members'][] = $item;
                    }
                } else {
                    // Fallback to administrasi if no sub unit matched
                    $key = SubUnit::TimAdministrasi->value;
                    if (! isset($timKerja[$key])) {
                        $timKerja[$key] = [
                            'label' => SubUnit::TimAdministrasi->label(),
                            'ketua' => null,
                            'members' => [],
                        ];
                    }
                    if ($p->is_ketua_tim) {
                        $timKerja[$key]['ketua'] = $item;
                    } else {
                        $timKerja[$key]['members'][] = $item;
                    }
                }
            }
        }

        // Ensure consistent ordering of tim kerja
        $timKerjaOrder = [
            SubUnit::TimPrakiraan->value,
            SubUnit::TimObservasi->value,
            SubUnit::TimAdministrasi->value,
        ];

        $sortedTimKerja = [];
        foreach ($timKerjaOrder as $key) {
            if (isset($timKerja[$key])) {
                $sortedTimKerja[$key] = $timKerja[$key];
            }
        }

        return view('pages.profil.sdm', [
            'kepalaUpt' => $kepalaUpt,
            'timKerja' => $sortedTimKerja,
        ]);
    }

    public function struktur()
    {
        $pegawaiDb = Pegawai::ordered()->get();

        $kepalaUpt = null;
        $timKerja = [];

        foreach ($pegawaiDb as $p) {
            $item = [
                'nama' => $p->nama,
                'jabatan' => $p->jabatan,
                'foto' => $p->foto_url,
                'sub_unit' => $p->sub_unit,
                'is_ketua_tim' => $p->is_ketua_tim,
            ];

            if ($p->sub_unit === SubUnit::KepalaUpt) {
                $kepalaUpt = $item;
            } elseif ($p->sub_unit?->isTimKerja()) {
                $key = $p->sub_unit->value;
                if (! isset($timKerja[$key])) {
                    $timKerja[$key] = [
                        'label' => $p->sub_unit->label(),
                        'ketua' => null,
                        'members' => [],
                    ];
                }
                if ($p->is_ketua_tim) {
                    $timKerja[$key]['ketua'] = $item;
                } else {
                    $timKerja[$key]['members'][] = $item;
                }
            } else {
                $key = SubUnit::TimAdministrasi->value;
                if (! isset($timKerja[$key])) {
                    $timKerja[$key] = [
                        'label' => SubUnit::TimAdministrasi->label(),
                        'ketua' => null,
                        'members' => [],
                    ];
                }
                if ($p->is_ketua_tim) {
                    $timKerja[$key]['ketua'] = $item;
                } else {
                    $timKerja[$key]['members'][] = $item;
                }
            }
        }

        $timKerjaOrder = [
            SubUnit::TimPrakiraan->value,
            SubUnit::TimObservasi->value,
            SubUnit::TimAdministrasi->value,
        ];

        $sortedTimKerja = [];
        foreach ($timKerjaOrder as $key) {
            if (isset($timKerja[$key])) {
                $sortedTimKerja[$key] = $timKerja[$key];
            }
        }

        return view('pages.profil.struktur', [
            'kepalaUpt' => $kepalaUpt,
            'timKerja' => $sortedTimKerja,
        ]);
    }
}
