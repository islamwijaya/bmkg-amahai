<?php

namespace App\Enums;

enum SubUnit: string
{
    case KepalaUpt = 'kepala_upt';
    case Forecaster = 'forecaster';
    case Observer = 'observer';
    case DataInformasi = 'data_informasi';
    case Teknisi = 'teknisi';
    case TataUsaha = 'tata_usaha';
    case Ppnpn = 'ppnpn';

    public function label(): string
    {
        return match ($this) {
            self::KepalaUpt => 'Kepala UPT',
            self::Forecaster => 'Sub Unit Forecaster',
            self::Observer => 'Sub Unit Observer',
            self::DataInformasi => 'Sub Unit Data & Informasi',
            self::Teknisi => 'Sub Unit Teknisi',
            self::TataUsaha => 'Unit Tata Usaha',
            self::Ppnpn => 'PPNPN',
        };
    }

    /**
     * Group label for the parent organizational unit.
     */
    public function groupLabel(): string
    {
        return match ($this) {
            self::KepalaUpt => 'Kepala UPT',
            self::Forecaster, self::Observer, self::DataInformasi, self::Teknisi => 'Unit Operasional',
            self::TataUsaha => 'Unit Tata Usaha',
            self::Ppnpn => 'PPNPN',
        };
    }

    public function isOperasional(): bool
    {
        return in_array($this, [self::Forecaster, self::Observer, self::DataInformasi, self::Teknisi]);
    }
}
