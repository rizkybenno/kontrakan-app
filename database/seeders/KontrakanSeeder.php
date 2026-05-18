<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kontrakan;

class KontrakanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            ['nama'=>'Kontrakan Saputra','alamat'=>'CPM6+5XW, Cihideung Udik','wilayah'=>'Kec. Ciampea, Kabupaten Bogor','harga'=>700000],

            ['nama'=>'Kontrakan ibu eer','alamat'=>'CP8H+FFR, Neglasari 16680','wilayah'=>'Kec. Dramaga, Kabupaten Bogor','harga'=>600000],

            ['nama'=>'Kontrakan pak ocid','alamat'=>'CQP3+7H8, Gg. Bengkong RT.03/RW.07, Bubulak 16115','wilayah'=>'Kec. Bogor Barat, Kota Bogor','harga'=>750000],

            ['nama'=>'Kontrakan bu cicih','alamat'=>'Jl. Gang Roda RT 05/01, Sindangbarang 16117','wilayah'=>'Kec. Bogor Barat, Kota Bogor','harga'=>670000],

            ['nama'=>'Kontrakan batman','alamat'=>'Jl. Babakan Lio, Balungbangjaya 16680','wilayah'=>'Kec. Bogor Barat, Kabupaten Bogor','harga'=>1000000],

            ['nama'=>'Kontrakan bapak uci','alamat'=>'CRG4+F67, Jl. Ciremei Ujung RT.03/RW.12, Bantarjati 16153','wilayah'=>'Kec. Bogor Utara, Kota Bogor','harga'=>750000],

            ['nama'=>'Kos mutiara','alamat'=>'Jl. Masjid Al Hikmah No.324 RT.02/RW.10, Semplak 16310','wilayah'=>'Kec. Bogor Barat, Kota Bogor','harga'=>1000000],

            ['nama'=>'Indekos johar','alamat'=>'Jl. Johar, Yasmin Raya No.10 RT.05/RW.04 16166','wilayah'=>'Kec. Tanah Sareal, Kota Bogor','harga'=>1150000],

            ['nama'=>'Kontrakan indy','alamat'=>'Jl. Curug Mekar RT.01/RW.08, Semplak 16114','wilayah'=>'Kec. Bogor Barat, Kota Bogor','harga'=>850000],

            ['nama'=>'Kontrakan pak budi','alamat'=>'Jl. Seremped No.56 RT.20/RW.06, Sukadamai 16166','wilayah'=>'Kec. Tanah Sareal, Kota Bogor','harga'=>700000],

            ['nama'=>'The kost exclusive','alamat'=>'Jl. KH. Abdullah Bin Nuh No.31 RT.06/RW.07 16117','wilayah'=>'Kec. Bogor Barat, Kota Bogor','harga'=>1100000],

            ['nama'=>'Kost griya kintani','alamat'=>'Jl. Bajang Ratu RT.05/RW.09, Kedungbadak 16164','wilayah'=>'Kec. Tanah Sareal, Kota Bogor','harga'=>1000000],

            ['nama'=>'Kosan fini','alamat'=>'Jl. Kolonel Martadisastra No.64 RT.03/RW.12, Kedungbadak 16164','wilayah'=>'Kec. Tanah Sareal, Kota Bogor','harga'=>750000],

            ['nama'=>'Kontrakan mama','alamat'=>'Jl. Cimanggu Wates No.52 RT.05/RW.05, Kedung Jaya 16164','wilayah'=>'Kec. Tanah Sareal, Kota Bogor','harga'=>500000],

            ['nama'=>'Kontrakan toyyibah','alamat'=>'Cilebut Timur RT01/05 No 31 16710','wilayah'=>'Kabupaten Bogor','harga'=>850000],

            ['nama'=>'Kontrakan kenanga','alamat'=>'Jl. Pancasan Baru No.92 RT.01/RW.12, Pasir Jaya 16119','wilayah'=>'Kec. Bogor Barat, Kota Bogor','harga'=>1000000],

            ['nama'=>'Kontrakan bn','alamat'=>'Jl. Cibeureum Sunting No.155 RT.01/RW.08, Mulyaharja 16135','wilayah'=>'Kec. Bogor Selatan, Kota Bogor','harga'=>800000],

            ['nama'=>'Kos babeh 123','alamat'=>'Jl. Raya Cibeureum Gg Dukuh No.70 RT.02/RW.04 16610','wilayah'=>'Kec. Bogor Selatan, Kota Bogor','harga'=>1000000],

            ['nama'=>'Kos skarr','alamat'=>'Jl. Raya Tajur Gg Sukajaya 3 RT.01/RW.06 16141','wilayah'=>'Kec. Bogor Timur, Kota Bogor','harga'=>900000],

            ['nama'=>'J&S Kost','alamat'=>'Gg. Emad No.28, Cikaret 16132','wilayah'=>'Kec. Bogor Selatan, Kota Bogor','harga'=>1000000],

            ['nama'=>'Andy’s kontrakan','alamat'=>'RT.04/RW.06, Muarasari 16137','wilayah'=>'Kec. Bogor Selatan, Kota Bogor','harga'=>700000],

            ['nama'=>'Kontrakan orange h.atang','alamat'=>'Jl. Babakan Pasirmas II RT.04/RW.08 16119','wilayah'=>'Kec. Bogor Barat, Kota Bogor','harga'=>700000],

            ['nama'=>'De kost','alamat'=>'Jl. Nasional 11 RT.04/RW.01, Sukasari 16142','wilayah'=>'Kec. Bogor Timur, Kota Bogor','harga'=>1200000],

            ['nama'=>'Kontrakan ibu dewi podomoro','alamat'=>'Kp. Lembur Situ RT.04/RW.05 16730','wilayah'=>'Kec. Caringin, Kabupaten Bogor','harga'=>1000000],

            ['nama'=>'Jazz 88 kost','alamat'=>'Jl. Mayjen H.R. Edi Sukma KM 16 16730','wilayah'=>'Kec. Caringin, Kabupaten Bogor','harga'=>750000],

            ['nama'=>'Kosan pak leli','alamat'=>'Wr. Menteng 16740','wilayah'=>'Kec. Cijeruk, Kabupaten Bogor','harga'=>550000],

            ['nama'=>'Kost kasyah','alamat'=>'Jl. Seuseupan Kaum No.3 RT01/10 16720','wilayah'=>'Kec. Ciawi, Kabupaten Bogor','harga'=>1100000],

            ['nama'=>'Kontrakan mang saja','alamat'=>'7VV7+H23, Pancawati 16730','wilayah'=>'Kec. Caringin, Kabupaten Bogor','harga'=>800000],

            ['nama'=>'Kost terus manis','alamat'=>'Gg. Buntu No.4 RT.02/RW.02, Paledang 16122','wilayah'=>'Kec. Bogor Tengah, Kota Bogor','harga'=>850000],

            ['nama'=>'Kontrakan ibu erni','alamat'=>'Jl. Kp. Tipar RT.06/RW.04, Sawah 16720','wilayah'=>'Kec. Ciawi, Kabupaten Bogor','harga'=>1000000],

        ];

        foreach ($data as $item) {
            Kontrakan::create($item);
        }
    }
}