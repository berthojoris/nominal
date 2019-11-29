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
    .boldText {
        font-size: 1.3rem;
        font-weight: bold;
        line-height: 1.5;
        color:#000000;
    }
    .table td, .table th {
        padding: .75rem;
        vertical-align: top;
        border: 2px solid #000000;
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid 
        #000000;
    }
    </style>
</head>
<?php 
function indoDate($oridate) {
    $format = explode("-", $oridate);
    $date = $format[2];
    $month = $format[1];
    $year = $format[0];

    if($month == "01") {
        $convMonth = "Januari";
    } else if($month == "02") {
        $convMonth = "Februari";
    } else if($month == "03") {
        $convMonth = "Maret";
    } else if($month == "04") {
        $convMonth = "April";
    } else if($month == "05") {
        $convMonth = "Mei";
    } else if($month == "06") {
        $convMonth = "Juni";
    } else if($month == "07") {
        $convMonth = "Juli";
    } else if($month == "08") {
        $convMonth = "Agustus";
    } else if($month == "09") {
        $convMonth = "September";
    } else if($month == "10") {
        $convMonth = "Oktober";
    } else if($month == "11") {
        $convMonth = "November";
    } else {
        $convMonth = "Desember";
    }
    return $date."-".$convMonth."-".$year;
}
?>
<body id="printPage">
    
    <table align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding-left: 10px; padding-right: 10px;">
                <span>Berdasarkan Nota Dinas/Facs/Email <span><?= $req_doc_no ?></span> tanggal <span><?= indoDate($req_doc_date);?> 
                dengan ini kami berikan izin kerja kepada:</span>
            </td>
        </tr>
    </table>

    <br>
    
    <div class="container">

        <div class="row text-center">
            <table border="1" align="center" cellpadding="0" cellspacing="0" width="600">
                <thead>
                    <tr align="center">
                        <th width="30%"><u>NAMA/NIP</u></th>
                        <th width="30%"><u>JABATAN</u></th>
                        <th width="30%"><u>BAGIAN/PERUSAHAAN</u></th>
                    </tr>
                    <tr>
                        <th colspan="3">NP <?= $nickname_provider ?> - <?= $network_type_new ?></th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="row text-center mb-5">
            <div class="col-md-12">
                <p><b></b></p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <p>Untuk melakukan pekerjaan sebagai berikut:</p>
            </div>
        </div>
        
        <div class="row">
            <table border="1" align="center" cellpadding="0" cellspacing="0" width="600">
                <thead>
                    <tr align="center">
                        <th colspan="2"><u>HARDWARE</u></th>
                        <th><u>SOFTWARE</u></th>
                    </tr>
                </thead>
                <tbody>
                    <tr col="3">
                        <td style="width: 60px; text-align: center;">&radic;</td>
                        <td style="text-align: center;">Site Survey</td>
                        <td style="text-align: center;">Memasang System/Aplikasi</td>
                    </tr>
                    <tr col="3">
                        <td style="width: 60px; text-align: center;">&radic;</td>
                        <td style="text-align: center;">Instalasi H/w indoor & outdoor</td>
                        <td style="text-align: center;">Mengganti/Upgrade System</td>
                    </tr>
                    <tr col="3">
                        <td style="width: 60px; text-align: center;">&radic;</td>
                        <td style="text-align: center;">Memperbaiki/Upgrade Hardware</td>
                        <td style="text-align: center;">Menghapus/Merubah System/Aplikasi</td>
                    </tr>
                    <tr col="3">
                        <td style="width: 60px; text-align: center;">&radic;</td>
                        <td style="text-align: center;">Menarik/Memindahkan Hardware</td>
                        <td style="text-align: center;">Maintenance</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>Rincian pekerjaan adalah: - Relokasi indoor dan outdoor media komunikasi <b><?= $network_type ?></b> pada <b><?= $remote_name_old ?></b> (<b><?= $ip_lan_old ?></b>)</p>
            </div>
            <div class="col-md-12 mb-5">
                <p>Site ID : <?= $network_id_old ?> ke <b><?= $remote_name_new ?></b> Site ID : <b><?= $network_id_new ?></b></p>
            </div>
            <div class="col-md-12">
                <p>No SPK <b><?= $no_spk ?></b> no urut : <b><?= ($id_contract == '' || empty($id_contract)) ? '-' : $id_contract ?></b></p>
                <p>Target Live : <b><?= indoDate($due_date) ?></b></p>
                <p>PIC : <b><?= $pic ?></b></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>- Setelah <b><?= $type_relocate ?></b> dilakukan, VSAT akan dipointing kembali ke arah <b><?= $network_type_new ?></b>.</p>
                <p>- Menggunakan IP Address <b><?= $ip_wan_new ?></b> pada modem di lokasi baru</p>
                <p>- Pemasangan dan instalasi grounding pada Antena, BUC, dan Modem di lokasi.</p>
                <p>- Pengecekan ketersediaan UPS di lokasi.</p>
                <p>- Melengkapi data task pada aplikasi GITS setelah instalasi jarkom di <b>http://103.63.96.110:30080/panel/public/v2</b></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <p>Alamat Lama : <b><?= $address_old ?></b> <?= $region_name_old ?></p>
                <p>Alamat Baru : <b><?= $address_new ?></b> <?= $region_name_new ?></p>
                <p>Ket : (Jarak pindah -+ <b><?= $distance ?></b>)</p>
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
                <p>* Usai relokasi, provider harap mengakses <b>http://103.63.96.110:30080/panel/public/v2</b> untuk integrasi</p>
            </div>
        </div>

    </div>

</body>
</html>