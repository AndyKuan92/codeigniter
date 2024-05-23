<?php $this->load->view('user/common/header'); ?>

                   <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Phone > List</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Phone List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example_1" width="100%" cellspacing="0">
                                    <!-- <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Sakura Yamamoto</td>
                                            <td>Support Engineer</td>
                                            <td>Tokyo</td>
                                            <td>37</td>
                                            <td>2009/08/19</td>
                                            <td>$139,575</td>
                                        </tr>
                                    </tbody> -->
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

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

    $(document).ready(function ($) {

        $('#example_1').DataTable({
            data: <?php echo $list ?>,
            columns: [
                { title:'No.', mRender: function (data, type, row) {

                    return row.id+'</br>'
                    }
                },
                { title:'Name/Contact', mRender: function (data, type, row) {

                    return '<i class="las la-bed"></i>'+row.name+'</br><i class="la la-user-circle nav-icon">'+row.contact+'</i>';
    
                    }
                },
                { title:'Created', mRender: function (data, type, row) {

                    return row.created_at;

                    }
                },
                { title:'Image', mRender: function (data, type, row) {

                        return '<span style="color:green">Pending</span>';
                        
                    }
                },
                { title:'Actions', mRender: function (data, type, row) {

                        return '<button class="text-info" onclick="localModalBillManualSettleOpen('+row.id+')"><i class="las la-edit">Manual</i></button></br><button class="text-info" onclick="localModalBillPdf('+row.id+')"><i class="las la-file-alt">PDF</i></button></br><button class="text-danger" onclick="localModalBillDeleteOpen('+row.id+')"><i class="las la-trash-alt">Delete</i></button>';

                    }
                },
            ],
            order: [[0, 'desc']],
            lengthMenu: [[50, 100, 500, 1000],[50, 100, 500, 1000]],
            pageLength: 50,
        })

    });

</script>

<?php $this->load->view('user/common/footer'); ?>