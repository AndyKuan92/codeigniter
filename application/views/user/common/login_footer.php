    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>

<script>

    function login(){

        event.preventDefault();
        var form = document.getElementById("login_form");
        var formData = new FormData(form);

        console.log(formData);

        $.ajax({
            type: "POST",
            url: "{{ url('/') }}/api/merchant/login",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res){
                //console.log(res);
                if(res.status == 0){
                    alert(res.message?? '');
                }
                else{
                    window.location.href = "{{ url('/') }}/user/dashboard";
                }
            }
        });

    }

</script>