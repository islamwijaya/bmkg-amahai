<?php

namespace App\Enums;

enum SubUnit: string
{
    case KepalaUpt = 'kepala_upt';
    case TimPrakiraan = 'tim_prakiraan';
    case TimObservasi = 'tim_observasi';
    case TimAdministrasi = 'tim_administrasi';

    public function label(): string
    {
        return match ($this) {
            self::KepalaUpt => 'Kepala UPT',
            self::TimPrakiraan => 'Tim Kerja Prakiraan, Analisa, Data dan Informasi',
            self::TimObservasi => 'Tim Kerja Observasi dan Instrumentasi',
            self::TimAdministrasi => 'Tim Kerja Administrasi',
        };
    }

    public function isTimKerja(): bool
    {
        return in_array($this, [self::TimPrakiraan, self::TimObservasi, self::TimAdministrasi]);
    }
}
