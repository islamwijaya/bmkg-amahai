<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BeritasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('beritas')->delete();
        
        \DB::table('beritas')->insert(array (
            0 => 
            array (
                'id' => 2,
                'title' => 'Gempa Bumi Bermagnitudo 4.3 Guncang Buru, Maluku',
                'slug' => 'gempa-bumi-bermagnitudo-43-guncang-buru-maluku',
                'thumbnail' => NULL,
                'images' => '["berita/AUQ0zYAnRmceLs9AJWiu4OTuqESTTm8NqpuWR7gS.jpg"]',
                'image_captions' => '[null]',
            'content' => '<div>&nbsp;Informasi gempa bumi hari ini, kali ini gempa mengguncang di wilayah Buru, Maluku, hari ini, Selasa (21/4/26), BMKG menyebut, gempa ini guncang barat daya, Buru, Maluku.<br><br>Dalam rilis BMKG, gempa tersebut memiliki kekuatan magnitude 4.3. BMKG menginformasikan bahwa waktu terjadinya gempa sekitar pukul 07:17:38 WIB.<br><br>Lokasi gempa ini berada di 3.40 Lintang Selatan (LS) 126.89 Bujur Timur (BT). BMKG sebut pusat gempa 27 km di barat daya, Buru, Maluku.<br><br>Gempa bumi ini terjadi di kedalaman 10 Km.<br><br>"#Gempa Mag:4.3, 21-Apr-2026 07:17:38 WIB, Lok:3.40LS, 126.89BT (27 km BaratDaya BURU-MALUKU), Kedlmn:10 Km #BMKG, Disclaimer: Informasi ini mengutamakan kecepatan, sehingga hasil pengolahan data belum stabil dan bisa berubah seiring kelengkapan data," tulis BMKG, dilansir dari akun X BMKG.</div>',
                'published_at' => NULL,
                'is_published' => 1,
            'published_by' => 'Admin (BMKG Amahai)',
                'created_at' => '2026-04-22 02:32:35',
                'updated_at' => '2026-04-22 02:32:35',
            ),
            1 => 
            array (
                'id' => 3,
                'title' => 'BMKG Peringatkan Gelombang Hingga 4 Meter di Laut Maluku',
                'slug' => 'bmkg-peringatkan-gelombang-hingga-4-meter-di-laut-maluku',
                'thumbnail' => NULL,
                'images' => '["berita/ffx8CzObis2aW6NcSJEWgponzCWyFBGcEny4QCHX.webp"]',
                'image_captions' => '[null]',
            'content' => '<div>Jakarta – Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) mengeluarkan peringatan dini gelombang tinggi yang berpotensi mencapai hingga 4 meter di wilayah Laut Maluku. Peringatan ini berlaku mulai hari ini, Rabu (22/4/2026) pukul 09.00 WIT hingga Sabtu (25/4/2026) pukul 09.00 WIT.<br><br></div><div>Dalam siaran pers resminya, BMKG menyoroti peningkatan gelombang di sejumlah wilayah strategis, termasuk Samudra Hindia bagian selatan Indonesia dan sebagian perairan timur. Kondisi ini dinilai berisiko tinggi terhadap aktivitas pelayaran, terutama bagi nelayan dan kapal penyeberangan.<br><br></div><div>Pola Angin Picu Gelombang Tinggi</div><div>BMKG menjelaskan, peningkatan gelombang dipicu oleh pola angin yang cukup aktif. Di wilayah utara, angin bergerak dari barat laut hingga timur laut dengan kecepatan 4–20 knot.<br><br></div>',
                'published_at' => '2026-04-22 02:33:47',
                'is_published' => 1,
            'published_by' => 'Admin (BMKG Amahai)',
                'created_at' => '2026-04-22 02:33:39',
                'updated_at' => '2026-04-22 02:33:47',
            ),
            2 => 
            array (
                'id' => 4,
                'title' => 'BMKG Peringatkan Hujan Sedang di Maluku Utara, Gelombang Laut Capai 2 Meter',
                'slug' => 'bmkg-peringatkan-hujan-sedang-di-maluku-utara-gelombang-laut-capai-2-meter',
                'thumbnail' => NULL,
                'images' => '["berita/PyDRDENuTvSQiPqXvI69qxA21x7Jaa5t3Qs7PnyP.jpg"]',
                'image_captions' => '[null]',
            'content' => '<div>Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) Kelas II Sultan Babullah Ternate memperkirakan kondisi cuaca di Maluku Utara dalam tiga hari ke depan secara umum cerah berawan hingga berawan.<br><br></div><div>Meski demikian, sejumlah wilayah masih berpotensi diguyur hujan dengan intensitas ringan hingga sedang.<br><br></div><div>Prakirawan BMKG Kelas II Sultan Babullah Ternate, Muhamad Dzikri Abdul Fattah, mengatakan untuk tiga hari ke depan belum terdapat potensi hujan lebat di wilayah Maluku Utara.<br><br></div><div>“Namun tetap waspada potensi hujan ringan hingga hujan sedang di wilayah Tobelo, Galela, Kao, Malifut, Oba, Wasile, Weda, Patani, Gane, Bacan, Obi, Taliabu dan sekitarnya,” kata Dzikri kepada Istana FM, Senin, 20 April 2026.<br><br></div><div>Menurut dia, masyarakat di wilayah tersebut tetap perlu meningkatkan kewaspadaan terhadap perubahan cuaca yang dapat terjadi sewaktu-waktu.<br><br></div><div>Selain kondisi hujan, BMKG juga memantau gelombang laut di sejumlah perairan Maluku Utara. Secara umum, tinggi gelombang diperkirakan berkisar antara 0,5 hingga 1,5 meter.<br><br></div><div>Namun terdapat potensi peningkatan gelombang hingga mencapai 2 meter di sejumlah wilayah perairan, yakni Morotai, Loloda, Batang Dua, Halmahera Timur, Gebe, perairan utara Mangoli, dan Taliabu.<br><br></div><div>Kondisi itu dinilai perlu menjadi perhatian khusus bagi nelayan, operator transportasi laut, serta masyarakat yang beraktivitas di kawasan pesisir.<br><br></div><div>BMKG mengimbau masyarakat agar terus memperbarui informasi cuaca dan gelombang laut melalui kanal resmi BMKG, termasuk media sosial dan layanan WhatsApp.<br><br></div><div>Bagi nelayan dan pengguna jasa transportasi laut, BMKG meminta agar mewaspadai potensi peningkatan gelombang serta penurunan jarak pandang akibat cuaca buruk.<br><br></div><div>Sementara warga yang tinggal di daerah rawan bencana hidrometeorologi seperti banjir dan longsor diminta lebih waspada apabila hujan sedang hingga lebat terjadi dalam durasi cukup lama.<br><br></div>',
                'published_at' => NULL,
                'is_published' => 1,
            'published_by' => 'Admin (BMKG Amahai)',
                'created_at' => '2026-04-22 02:34:47',
                'updated_at' => '2026-04-22 02:34:47',
            ),
        ));
        
        
    }
}