<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <h2>Edit User</h2>
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                <div class="col-md-5">
                <?php
                    echo form_open('user/edit');
                ?> 
                <!-- <form action="<?php //echo base_url(); ?>index.php/user/add" id="formid" method='post'> -->
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?php echo $record['id'] ?>">
                        <div class="form-group">
                            <label for="example">Name</label>
                            <input type="tex" name="nama" class="form-control" required oninvalid="setCustomValidity('Nama Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama" id="nama" value="<?php echo $record['nama'] ?>">
                                   <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>  
                        <div class="form-group">
                            <label for="example">Username</label>
                            <input type="tex" name="username" class="form-control" required oninvalid="setCustomValidity('Username Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Username" id="username" value="<?php echo $record['username'] ?>" readonly>
                                   <?php echo form_error('username', '<div class="text-red">', '</div>'); ?>
                        </div>  
                        <div class="form-group" style="display:none">
                            <label for="example">Password</label>
                            <input type="password" name="password" class="form-control" required oninvalid="setCustomValidity('Nama Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Password" id="password" value="<?php echo $record['pass_asli'] ?>">
                                   <?php echo form_error('password', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="example">Email</label>
                            <!-- <input type="email" name="email" class="form-control" required oninvalid="setCustomValidity('Email Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Email" id="email" value="<?php //echo $record['email'] ?>"> -->
                            <input type="email" name="email" class="form-control" placeholder="Masukan Email" id="email" value="<?php echo $record['email'] ?>">
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
                                            echo "<option value='".$roles->id_role."' ";
                                            echo $record['role'] == $roles->id_role ? 'selected' : '';
                                            echo ">".$roles->nama_role."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                            <?php }else if ($this->session->userdata('role')==6) {?>
                                <select name='role' class="form-control " id="role" onchange="pilih2()">
                                    <option value=''>--Choose Role--</option>
                                    <option value="6" <?php echo $record['role'] == 6 ? 'selected' : '';?>>Kanwil</option>
                                    <option value="7" <?php echo $record['role'] == 7 ? 'selected' : '';?>>Kanca</option>
                                </select>
                            <?php }?>
                        </div>
                        <div class="form-group"  id="f_kanwil">
                            <label for="">Region</label>
                            <?php if ($this->session->userdata('role')==1) {?>
                                <select name='kanwil' class="form-control " id="kanwil" onchange="getKanca()">
                                    <option value=''>--Choose Region--</option>
                                    <?php
                                    if (!empty($kanwil)) {
                                        foreach ($kanwil as $k) {
                                            echo "<option value='$k->kode_kanwil'";
                                            echo $record['kode_kanwil'] == $k->kode_kanwil ? 'selected' : '';
                                            echo">$k->nama_kanwil</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                            <?php }else if ($this->session->userdata('role')==6) {
                                    if (!empty($kanwil)) {
                                        foreach ($kanwil as $k) {
                                            echo $record['kode_kanwil'] == $k->kode_kanwil ? '<input type="text" name="nama_kanwil" class="form-control"  value="'.$k->nama_kanwil.'" readonly>' : '';                                        
                                        }
                                    }?>
                                    <input type="hidden" name="kanwil" id="kanwil" onkeypress="getKanca()" class="form-control" value="<?php echo $this->session->userdata('kanwil'); ?>" readonly>
                            <?php }?>
                        </div> 
                        <div class="form-group" id="f_kanca" style="display: none">
                            <label for="">Main Branch</label>
                            <select name='kanca' class="form-control " id="kanca">
                            </select>
                        </div>
                        <div class="form-group"  id="f_provider" style="display: none">
                            <label for="">Provider</label>
                            <select name='provider' class="form-control " id="provider">
                            <option value=''>--Choose Provider--</option>
                                <?php
                                if (!empty($provider)) {
                                    foreach ($provider as $p) {
                                        echo "<option value='$p->kode_provider'";
                                        echo $record['kode_provider'] == $p->kode_provider ? 'selected' : '';
                                        echo">$p->nama_provider</option>";                                        
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Position</label>
                            <input type="tex" name="jabatan" class="form-control" required oninvalid="setCustomValidity('Jabatan Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Jabatan" id="jabatan" value="<?php echo $record['jabatan'] ?>">
                                   <?php echo form_error('jabatan', '<div class="text-red">', '</div>'); ?>
                        </div>     
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="tex" name="no_hp" class="form-control" required oninvalid="setCustomValidity('Nomor HP Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nomor HP" id="no_hp" value="<?php echo $record['nomor_hp'] ?>">
                                   <?php echo form_error('no_hp', '<div class="text-red">', '</div>'); ?>
                        </div>                                 
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Save</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            Edit Password
                        </button>                       
                    <?php if(in_array( $this->session->userdata('role'), array(1,5) )){?>
                        <a href="<?php echo site_url('user'); ?>" class="btn btn-primary">Back</a>
                    <?php } ?>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Password</h4>
        </div>
        <div class="modal-body">
            <form action="" method="post" id="editpass">
                <input type="hidden" name="id" value="<?php echo $record['id'] ?>">
                <input type="hidden" name="username" class="form-control" value="<?php echo $record['nama']; ?>">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="pass1" class="form-control" id="pass1">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="pass2" class="form-control" id="pass2">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="edit_password()">Save Password</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
$(document).ready(function() {
    var role = '<?php echo $record['role'];?>';
    if (role == 6 || role == 7) {   
        pilih();
        getKancaEdit();
    }else if(role == 10){
        pilih();
    }
});


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

function getKancaEdit(){
    var kanwil = $("#kanwil").val();
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
              var i;
              var kode_kanca = '<?php echo $record['kode_kanca'];?>';
              var selected = '';
              $("#kanca").append('<option value="">--Choose Main Branch--</option>');
              for(var i = 0 ; i < data.length ; i++){
                  //html += '<option value="'+data[i]['kode_kanca']+'">'+data[i]['nama_kanca']+'</option>';
                    // $(data).each(function(i) { //to list cities
                    if (kode_kanca==data[i].kode_kanca) {
                        selected = 'selected';
                    }else{
                        selected = '';
                    }
                    $("#kanca").append('<option value="'+data[i].kode_kanca+'" '+selected+'>'+data[i].nama_kanca+'</option>')
                    // });
              }
              //$("#kanca").html(html);
          }

      });
}


function simpan(formid) {
        //event.preventDefault();
        // var nama = $("input#nama").val();
        // var username = $("input#username").val();
        // var password = $("input#password").val();
        // var kanwil = $("input#kanwil").val();
        // var provider = $("input#provider").val();
        // var email = $("input#email").val();
        // var jabatan = $("input#jabatan").val();
        // var no_hp = $("input#no_hp").val();
        $.ajax({
            type: "POST",
            url: $(formid).attr('action'),
            dataType:'JSON',
            data: {
                username: username, 
                password: password,
                nama: nama, 
                kanwil: kanwil,
                provider: provider, 
                email: email,
                jabatan: jabatan, 
                no_hp: no_hp,
            },
            success: function(data) {
                alert(data);
            },
            error: function(){
                alert("Error");
            }
        });
}

function edit_password(){
    var url="<?php echo base_url(); ?>index.php/User/edit_pass";
    var pass1 = $("#pass1").val();
    var pass2 = $("#pass2").val();
    //ajax adding data to database
    if (pass1==pass2) {
        $.ajax({
            url : url,
            type: "POST",
            data: $('#editpass').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                alert("Success!");
                location.reload();
                //swal("SUCCESS!", "", "success");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error Update Password');
                //swal("ERROR!", "", "error");
    
            }
        });
    } else {
        alert('Error Update Password');
    }
    
}
</script>