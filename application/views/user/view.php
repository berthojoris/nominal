<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <h2>Master User</h2>
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('index.php/user/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Add Data</a></h3>
                            <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="user" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>                                 
                            </tr>
                        </thead>
                        <tbody>
                       <?php
					   $no=1;
					   foreach ($record as $r){                                     
						   echo"
							   <tr>
							   <td>".$no."</td>
                               <td>".$r->nama."</td>
                               <td>".$r->username."</td>
							   <td>".$r->nama_role."</td>							  						   
							   <td>" . anchor('user/edit/' . $r->id, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . " " . anchor('user/delete/' . $r->id, '<i class="btn btn-danger btn-sm glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
                               </tr>";
						   $no++;
					   }
					   ?>
                       </tbody>
                    </Table> 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
<script type="text/javascript">
  $(document).ready(function() {
      $('#user').DataTable();
  });
</script>
