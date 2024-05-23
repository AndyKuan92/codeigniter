<?php $this->load->view('user/common/header'); ?>
<?php $this->load->view('user/common/toast'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Phone > Add</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-lg-6 col-md-6" style="padding:0px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Phone Details</h6>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <form id="localModalPhoneAddForm" method="POST" action="<?= base_url() ?>user/phone/add">
                        <div class="form-group row col-lg-6 col-md-12">
                            <?= $this->session->flashdata('message')?? '' ?>
                        </div>
                        <div class="form-group row col-12">
                            <b class="text-dark">Phone Name:</b>
                            <input type="text" name="name" class="form-control form-control-user" placeholder="Enter Name" value="<?= set_value('name'); ?>">
                            <?= form_error('name','<small class="text-danger pl-1">','</small>')?? ''; ?>
                        </div>
                        <div class="form-group row col-12">
                            <b class="text-dark">Phone Number:</b>
                            <input type="number" name="contact" class="form-control form-control-user" placeholder="Enter Contact" value="<?= set_value('contact'); ?>">
                            <?= form_error('contact','<small class="text-danger pl-1">','</small>')?? ''; ?>
                        </div>
                        <div class="form-group row col-12 pt-3" style="text-align:right; justify-content:end;">
                            <button type="submit" class="col-lg-3 col-md-6 btn btn-round btn-primary btn-user btn-block">
							    Add 
						    </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<!-- Phone Add Modal-->
<div class="modal fade" id="localModalPhoneAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="localModalPhoneAddTitle">Add Phone</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-danger">
                Confirm?
                <form id="">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="localModalPhoneAddSubmitButton" onclick="localModalPhoneAddSubmit()">Confirm</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

<!-- Pages Level DataTable -->
<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/js/demo/datatables-demo.js"></script>

<script>

    function localModalPhoneAddOpen() {

        $('#localModalPhoneAdd').modal("show");
        $('.modal-backdrop').hide();

    }

    function localModalPhoneAddSubmit(){
        event.preventDefault();
        var form = document.getElementById("localModalPhoneAddForm");
        var formData = new FormData(form);
        // formData.append('id', phone_id);
        //console.log(Array.from(formData.entries()));

        $.ajax({
            'url': "<?= base_url(); ?>api/user/phone/add",
            'method': "POST",
            'data':formData,
            'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            'processData': false,
            'contentType': false,
        }).done( function(res) {
            //console.log(res);
            $('#localModalPhoneAdd').modal("hide");
            data = JSON.parse(res);
            if(data.status==1){
                toast(data.message,'<i class="fa fa-check open-card-option" style="margin:0px;"></i>',1);
                setTimeout(function(){window.location.reload()},1000);
            }
            else{
                toast(data.message,'<i class="fa fa-close open-card-option" style="margin:0px;"></i>',0);
            }
        });
    }

</script>

<?php $this->load->view('user/common/footer'); ?>