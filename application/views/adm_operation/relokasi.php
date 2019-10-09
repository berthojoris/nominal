<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/swal/sweetalert.min.css">
<link href="<?php echo base_url(); ?>assets/bootstrap-select.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/bootstrap-select.min.js"></script>
<script>
$(document).ready(function() {

});
</script>

<section>
    <div style="width:100%;height:38px;" class="panel panel-default">
        <ol class="breadcrumb" style="background: white;">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active" style="color: #3C8DBC;">Relokasi</li>
        </ol>
    </div>
</section>

<section class="content" id="full" style="margin-top: -20px">
    <div class="row">
        <div class="panel panel-default" style="float: left;width: 100%;">
            <div class="panel-heading" style="background-color:#3C8DBC;color:#FFFFFF;font-weight:bold;font-size:14pt;">New Relokasi</div>
            <form action="" method="POST">
                <div class="col-md-6">
                    <table class="table table-hover">
                        <tr>
                            <th>SPK</th>
                            <td>
                                <input type="text" class="form-control input-sm" name="spk" id="spk">
                                <input type="text" class="form-control input-sm" name="no_spk" id="no_spk">
                            </td>
                        </tr>
                        <tr>
                            <th>JENIS JARKOM</th>
                            <td><input type="text" class="form-control input-sm" name="jenis_jarkom" id="jenis_jarkom"></td>
                        </tr>
                        <tr>
                            <th>IP LAMA</th>
                            <td><input type="text" class="form-control input-sm"  name="ip_lama" id="ip_lama"></td>
                        </tr>
                        <th>KANWIL LAMA</th>
                            <td>
                                <select name="kanwil_lama" id="kanwil_lama" class="form-control input-sm">
                                    <option value="">- Pilih Kanwil -</option>
                                </select>
                            </td>
                        <tr>
                            <th>UKER INDUK LAMA</th>
                            <td><input type="text" class="form-control input-sm"  name="uker_induk_lama" id="uker_induk_lama"></td>
                        </tr>
                        <tr>
                            <th>NAMA UKER LAMA</th>
                            <td><input type="text" class="form-control input-sm"  name="nama_uker_lama" id="nama_uker_lama"></td>
                        </tr>
                        <tr>
                            <th>JENIS UKER LAMA</th>
                            <td>
                                <select name="jenis_uker_lama" id="jenis_uker_lama" class="form-control input-sm">
                                    <option value="">- Pilih Jenis Uker -</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>ALAMAT LAMA</th>
                            <td><textarea name="alamat_lama" class="form-control input-sm" id="alamat_lama" cols="10" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <th>NO DOK PENDUKUNG</th>
                            <td><input type="text" class="form-control input-sm"  name="no_dok_pendukung" id="no_dok_pendukung"></td>
                        </tr>
                        <tr>
                            <th>TGL DOK PENDUKUNG</th>
                            <td><input type="text" class="form-control input-sm"  name="tgl_dok_pendukung" id="tgl_dok_pendukung"></td>
                        </tr>
                        <tr>
                            <th>FILE PENDUKUNG</th>
                            <td><input type="file" class="form-control input-sm"  name="file_pendukung" id="file_pendukung"></td>
                        </tr>
                        <tr>
                            <th>ALASAN PINDAH</th>
                            <td><input type="text" class="form-control input-sm"  name="alasan_pindah" id="alasan_pindah"></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-hover">
                        <tr>
                            <th></th>
                            <td><input type="checkbox" class="form-check-input" name="update_cacti" id="update_cacti">   Update Cacti</td>
                        </tr>
                        <tr>
                            <th>PROVIDER</th>
                            <td><input type="text" class="form-control input-sm" name="provider" id="provider"></td>
                        </tr>
                        <tr>
                            <th>IP BARU</th>
                            <td><input type="text" class="form-control input-sm" name="ip_baru" id="ip_baru"></td>
                        </tr>
                        <tr>
                            <th>KANWIL BARU</th>
                            <td>
                                <select name="kanwil_baru" id="kanwil_baru" class="form-control input-sm">
                                    <option value="">- Pilih Kanwil -</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>UKER INDUK BARU</th>
                            <td><input type="text" class="form-control input-sm" name="uker_induk_baru" id="uker_induk_baru"></td>
                        </tr>
                        <tr>
                            <th>NAMA UKER BARU</th>
                            <td><input type="text" class="form-control input-sm" name="nama_uker_baru" id="nama_uker_baru"></td>
                        </tr>
                        <tr>
                            <th>JENIS UKER BARU</th>
                            <td>
                                <select name="jenis_uker_baru" id="jenis_uker_baru" class="form-control input-sm">
                                    <option value="">- Pilih Jenis Uker -</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>ALAMAT</th>
                            <td><textarea name="alamat_baru" id="alamat_baru" class="form-control input-sm" cols="10" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <th>PIC</th>
                            <td><input type="text" class="form-control input-sm" name="pic" id="pic"></td>
                        </tr>
                        <tr>
                            <th>TGL LIVE</th>
                            <td><input type="text" class="form-control input-sm" name="tgl_live" id="tgl_live"></td>
                        </tr>
                        <tr>
                            <th>KETERANGAN</th>
                            <td><textarea name="keterangan" id="keterangan" class="form-control input-sm" cols="10" rows="5"></textarea></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-12 col-sm-offset-6" style="margin-bottom: 10px;">
                    <input type="button" value="Create" class="btn btn-primary">
                </div> 
            </form>
        </div>
    </row>
</section>