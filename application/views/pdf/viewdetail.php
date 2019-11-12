<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Report</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/4.css">
    <style>
    html {
        font-size: 14px;
    }
    @media (min-width: 768px) {
        html {
            font-size: 16px;
        }
    }
    .border-top { border-top: 1px solid #e5e5e5; }
    .border-bottom { border-bottom: 1px solid #e5e5e5; }
    .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
    .tdCheck {
        width: 60px;
    }
    .textRed {
        color: red;
    }
    </style>
</head>
<body id="printPage">

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p class="lead">Berdasarkan <b><?= $req_doc_no ?></b> tanggal <b><?= $req_doc_date ?></b> dengan ini kami berikan izin kerja kepada:</p>
    </div>

    <div class="container">

        <div class="row text-center">
            <div class="col-md-4">
                <p>NAMA/NIP</p>
            </div>
            <div class="col-md-4">
                <p>JABATAN</p>
            </div>
            <div class="col-md-4">
                <p>BAGIAN/PERUSAHAAN</p>
            </div>
        </div>

        <div class="row text-center mb-5">
            <div class="col-md-12">
                <p>NP BRISAT-PATRAKOM (Telkomsat)</p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <p>Untuk melakukan pekerjaan sebagai berikut:</p>
            </div>
        </div>
        
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th colspan="2">HARDWARE</th>
                        <th>SOFTWARE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr col="3">
                        <td class="tdCheck"></td>
                        <td>Site Survey</td>
                        <td>Memasang System/Aplikasi</td>
                    </tr>
                    <tr col="3">
                        <td class="tdCheck"></td>
                        <td>Instalasi H/w indoor & outdoor</td>
                        <td>Mengganti/Upgrade System</td>
                    </tr>
                    <tr col="3">
                        <td class="tdCheck"></td>
                        <td>Memperbaiki/Upgrade Hardware</td>
                        <td>Menghapus/Merubah System/Aplikasi</td>
                    </tr>
                    <tr col="3">
                        <td class="tdCheck"></td>
                        <td>Menarik/Memindahkan Hardware</td>
                        <td>Maintenance</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>Rincian pekerjaan adalah: - Relokasi indoor dan outdoor media komunikasi <b><?= $network_type ?></b> pada <b><?= $remote_name_old ?></b> TID 50633 (<b><?= $ip_lan_old ?></b>)</p>
            </div>
            <div class="col-md-12 mb-5">
                <p>Site ID : <?= $network_id_old ?> ke <b><?= $remote_name_new ?></b> TID 50633 Site ID : <b><?= $network_id_new ?></b></p>
            </div>
            <div class="col-md-12">
                <p>No SPK <b><?= $no_spk ?></b> no urut : <b><?= ($id_contract == '' || empty($id_contract)) ? '-' : $id_contract ?></b></p>
                <p>Target Live : <b><?= $due_date ?></b></p>
                <p>PIC : <b><?= $pic ?></b></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>- Media komunikasi <?= $remote_type_old ?> setelah relokasi dilakukan repointing ke arah <b></b>.</p>
                <p>- Menggunakan IP Address <b><?= $ip_wan_new ?></b> pada modem di lokasi baru</p>
                <p>- Pemasangan dan instalasi grounding pada Antena, BUC, dan Modem di lokasi.</p>
                <p>- Pengecekan ketersediaan UPS di lokasi.</p>
                <p>- Melengkapi data task pada aplikasi GITS setelah instalasi jarkom di http://103.63.96.110:30080/panel/public/v2</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>Alamat Lama : <b><?= $address_old ?></b> <?= $region_name_old ?></p>
                <p>Alamat Baru : <b><?= $address_new ?></b> <?= $region_name_new ?></p>
                <p class="textRed">Ket : (Jarak pindah -+ <b><?= $distance ?></b>)</p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>Demi keberhasilan tugasnya diharapkan kepada yang bersangkutan dapat diberikan kesempatan bekerja yang sebaik-baiknya dan Pemimpin cabang wajib melaporkan kepada Divisi Satelit & Jaringan Telekomunikasi setelah pekerjaan ini selesai di laksanakan oleh provider maksimum 7 hari setelah pekerjaan selesai dengan format (terlampir).
                </p>
            </div>
        </div>

        <div class="row mt-5 mb-3">
            <div class="col-md-12">
                <p>* Usai relokasi, provider harap mengakses http://103.63.96.110:30080/panel/public/v2 untuk integrasi</p>
            </div>
        </div>

    </div>

</body>
</html>