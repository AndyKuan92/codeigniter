<?php $this->load->view('user/common/header'); ?>
<?php $this->load->view('user/common/toast'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-2 text-gray-800">Phone > Edit</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-lg-6 col-md-6" style="padding:0px;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Phone Details</h6>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <form id="localModalPhoneAddForm" method="POST" action="<?= base_url() ?>user/phone/edit/<?= $details['id']?? 0 ?>">
                        <div class="form-group row col-lg-6 col-md-12">
                            <?= $this->session->flashdata('message')?? '' ?>
                        </div>
                        <div class="form-group row col-12">
                            <b class="text-dark">Phone Name:</b>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?= $details['name']?? "" ?>">
                            <?= form_error('name','<small class="text-danger pl-1">','</small>')?? ''; ?>
                        </div>
                        <div class="form-group row col-12">
                            <b class="text-dark">Phone Number:</b>
                            <input type="number" name="contact" class="form-control" placeholder="Enter Contact" value="<?= $details['value']?? "" ?>">
                            <?= form_error('contact','<small class="text-danger pl-1">','</small>')?? ''; ?>
                        </div>
                        <div class="form-group row col-12 pt-3" style="text-align:right; justify-content:end;">
                            <button type="submit" class="col-lg-3 col-md-6 btn btn-round btn-primary btn-user btn-block">
							    Edit 
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

</script>

<?php $this->load->view('user/common/footer'); ?>