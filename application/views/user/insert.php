<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <h2>Insert User</h2>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                <div class="col-md-5">
                <?php
                    //echo form_open('user/add');
                ?> 
                <form action="<?php  echo site_url('User/add'); ?>" id="formid" method='post'>
                <!-- <form action="" id="formid" method='post'> -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Name</label>
                            <input type="tex" name="nama" class="form-control" required oninvalid="setCustomValidity('Nama Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama" id="nama">
                                   <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>  
                        <div class="form-group">
                            <label for="example">Username</label>
                            <input type="tex" name="username" class="form-control" required oninvalid="setCustomValidity('Username Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Username" id="username">
                                   <?php echo form_error('username', '<div class="text-red">', '</div>'); ?>
                        </div>  
                        <div class="form-group">
                            <label for="example">Password</label>
                            <input type="password" name="password" value="" class="form-control" required oninvalid="setCustomValidity('Nama Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Password" id="password">
                                   <?php echo form_error('password', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="example">Email</label>
                            <!-- <input type="email" name="email" value="" class="form-control" required oninvalid="setCustomValidity('Email Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Email" id="email"> -->
                            <input type="email" name="email" value="" class="form-control" placeholder="Masukan Email" id="email">
                                   <?php echo form_error('email', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <?php if ($this->session->userdata('role')==1) {?>
                                <select name='role' class="form-control " id="role" onchange="pilih()">
                                    <option value=''>--Choose Role--</option>
                                    <?php
                                    if (!empty($role)) {
                                        foreach ($role as $roles) {
                                            echo "<option value=".$roles->id_role.">".$roles->nama_role."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                            <?php }else if ($this->session->userdata('role')==6) {?>
                                <select name='role' class="form-control " id="role" onchange="pilih2()">
                                    <option value=''>--Choose Role--</option>
                                    <option value="6">Kanwil</option>
                                    <option value="7">Kanca</option>
                                </select>
                            <?php }?>
                        </div>  
                        <div class="form-group" id="f_kanwil" style="display: none">
                            <label for="">Region</label>
                            <?php if ($this->session->userdata('role')==1) {?>
                                <select name='kanwil' class="form-control " id="kanwil" onchange="getKanca()">
                                    <option value=''>--Choose Region--</option>
                                    <?php
                                    if (!empty($kanwil)) {
                                        foreach ($kanwil as $k) {
                                            echo "<option value=".$k->kode_kanwil.">".$k->nama_kanwil."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                            <?php }else if ($this->session->userdata('role')==6) {?>
                                    <?php
                                    if (!empty($kanwil)) {
                                        foreach ($kanwil as $k) {
                                            echo  $this->session->userdata('kanwil')== $k->kode_kanwil ? '<input type="text" name="nama_kanwil" class="form-control"  value="'.$k->nama_kanwil.'" readonly>' : '';                                        
                                        }
                                    }?>
                                        <input type="hidden" name="kanwil" class="form-control" value="<?php echo $this->session->userdata('kanwil'); ?>">
                            <?php }?>
                        </div> 
                        <div class="form-group" id="f_kanca" style="display: none">
                            <label for="">Main Branch</label>
                            <select name='kanca' class="form-control " id="kanca">
                            </select>
                        </div>
                        <div class="form-group" id="f_provider" style="display: none">
                            <label for="">Provider</label>
                            <select name='provider' class="form-control " id="provider">
                            <option value=''>--Choose Provider--</option>
                                <?php
                                if (!empty($provider)) {
                                    foreach ($provider as $p) {
                                        echo "<option value=".$p->kode_provider.">".$p->nama_provider."</option>";                                        
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Position</label>
                            <input type="tex" name="jabatan" value="" class="form-control" required oninvalid="setCustomValidity('Jabatan Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Jabatan" id="jabatan">
                                   <?php echo form_error('jabatan', '<div class="text-red">', '</div>'); ?>
                        </div>     
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="tex" name="no_hp" value="" class="form-control" required oninvalid="setCustomValidity('Nomor HP Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nomor HP" id="no_hp">
                                   <?php echo form_error('no_hp', '<div class="text-red">', '</div>'); ?>
                        </div>                                 
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
                        <!-- <button type="button" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button> -->
                        <a href="<?php echo site_url('user'); ?>" class="btn btn-primary">Back</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">

function pilih(){
    $("#f_kanwil").hide();
    $("#f_kanca").hide();
    $("#f_provider").hide();
    var pilih = $("#role").val(); 
    //alert(pilih);
    if (pilih==6 || pilih==7) {
        $("#f_kanwil").show();
        $("#f_kanca").show();
    }else if(pilih==10){
        $("#f_provider").show();
    }
}


function getKanca(){
    var kanwil = $("#kanwil").val();
    $("#kanca").empty();
    //alert(kanwil);
    $.ajax({
          type  : 'POST',
          url   : "<?php echo site_url('Dashboard/getKanca')?>",
          async : false,
          dataType : 'JSON',
          data:"kanwil="+kanwil,
          success : function(data){
            //console.log(data);
              var html = '';
              var i;
              $("#kanca").append('<option value="">--Choose Main Branch--</option>')
              for(var i = 0 ; i < data.length ; i++){
                  //html += '<option value="'+data[i]['kode_kanca']+'">'+data[i]['nama_kanca']+'</option>';
                    // $(data).each(function(i) { //to list cities
                    $("#kanca").append('<option value="'+data[i].kode_kanca+'">'+data[i].nama_kanca+'</option>')
                    // });
              }
              //$("#kanca").html(html);
          }

      });
}


function pilih2(){
    $("#f_kanwil").hide();
    $("#f_kanca").hide();
    $("#f_provider").hide();
    var pilih = <?php echo $this->session->userdata('role');?>; 
    //alert(pilih);
    if (pilih==6 || pilih==7) {
        $("#f_kanwil").show();
        $("#f_kanca").show();
        getKanca2();
    }else if(pilih==10){
        $("#f_provider").show();
    }
}

function getKanca2(){
    var kanwil = "<?php echo $this->session->userdata('kanwil');?>";
    //alert(kanwil);
    $("#kanca").empty();
    $.ajax({
          type  : 'POST',
          url   : "<?php echo site_url('Dashboard/getKanca')?>",
          async : false,
          dataType : 'JSON',
          data:"kanwil="+kanwil,
          success : function(data){
            //console.log(data);
              var html = '';
              $("#kanca").append('<option value="">--Choose Main Branch--</option>');
              for(var i = 0 ; i < data.length ; i++){
                  //html += '<option value="'+data[i]['kode_kanca']+'">'+data[i]['nama_kanca']+'</option>';
                    // $(data).each(function(i) { //to list cities
                    $("#kanca").append('<option value="'+data[i].kode_kanca+'" >'+data[i].nama_kanca+'</option>')
                    // });
              }
              //$("#kanca").html(html);
          }

      });
}


// function simpan(formid) {
//         //alert('tes');
//         //event.preventDefault();
//         var nama = $("input#nama").val();
//         var username = $("input#username").val();
//         var password = $("input#password").val();
//         var kanwil = $("input#kanwil").val();
//         var provider = $("input#provider").val();
//         var email = $("input#email").val();
//         var jabatan = $("input#jabatan").val();
//         var no_hp = $("input#no_hp").val();
//         $.ajax({
//             type: "POST",
//             url: $(formid).attr('action'),
//             dataType:'JSON',
//             data: {
//                 username: username, 
//                 password: password,
//                 nama: nama, 
//                 kanwil: kanwil,
//                 provider: provider, 
//                 email: email,
//                 jabatan: jabatan, 
//                 no_hp: no_hp,
//             },
//             success: function(data) {
//                 alert('S uccess');
//             },
//             error: function(){
//                 alert("Error");
//             }
//         });
// }
</script>