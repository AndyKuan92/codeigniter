<?php $this->load->view('user/common/header'); ?>
<?php $this->load->view('user/common/toast'); ?>

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

<!-- Modal -->
<!-- Logout Modal-->
<div class="modal fade" id="localModalPhoneDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="localModalPhoneDeleteTitle">Phone Delete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-danger">Delete This Record?</div>
            <form id="localModalPhoneDeleteForm"></form>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="localModalPhoneDeleteSubmitButton" onclick="localModalPhoneDeleteSubmit()">Confirm</button>
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

    $(document).ready(function ($) {

        $('#example_1').DataTable({
            data: <?php echo $list ?>,
            columns: [
                { title:'No.', mRender: function (data, type, row) {

                    return row.id+'</br>'
                    }
                },
                { title:'Name/Contact', mRender: function (data, type, row) {

                    return '<i class="fa fa-user"></i> '+row.name+'</br><i class="fa fa-phone nav-icon"> '+row.value+'</i>';
    
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

                        return '<button class="text-info" style="border-width:0px;" data-id='+row.id+' onclick="phoneDetails(this)"><i class="fas fa-fw fa-edit"></i>Edit</button>&nbsp;<button class="text-danger" style="border-width:0px;" data-id='+row.id+' onclick="localModalPhoneDeleteOpen(this)"><i class="fas fa-fw fa-trash"></i>Delete</button>';

                    }
                },
            ],
            order: [[0, 'desc']],
            lengthMenu: [[50, 100, 500, 1000],[50, 100, 500, 1000]],
            pageLength: 50,
        })

    });


    function phoneDetails(this_div) {

        var div = this_div;
        var id = div.dataset.id;
        console.log(id);
        //navigator.clipboard.writeText(id);

    }

    function localModalPhoneDeleteOpen(this_div) {

        var div = this_div;
        var phone_id = div.dataset.id;

        $('#localModalPhoneDeleteSubmitButton').data('id', phone_id);
        $('#localModalPhoneDeleteTitle').html("Bill Delete ("+phone_id+")");
        $('#localModalPhoneDelete').modal("show");
        $('.modal-backdrop').hide();

    }

    function localModalPhoneDeleteSubmit(){
        event.preventDefault();
        var form = document.getElementById("localModalPhoneDeleteForm");
        var formData = new FormData(form);
        var phone_id = $('#localModalPhoneDeleteSubmitButton').data('id');
        formData.append('id', phone_id);
        //console.log(Array.from(formData.entries()));

        $.ajax({
            'url': "<?= base_url(); ?>api/user/phone/delete",
            'method': "POST",
            'data':formData,
            'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            'processData': false,
            'contentType': false,
        }).done( function(res) {
            //console.log(res);
            $('#localModalPhoneDelete').modal("hide");
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