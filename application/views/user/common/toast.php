<style>
    #snackbar {
    visibility: hidden;
    min-width: 100px;
    margin-left: -125px;
    /* background-color: #66d; */
    color: #fff;
    text-align: left;
    border-width: 2px;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 2147483647;
    right: 5%;
    top: 120px;
    font-size: 17px;
    white-space: normal;
    max-width: 300px;
    }

    #snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.6s, fadeout 1s 2.5s;
    animation: fadein 0.6s, fadeout 1s 2.5s;
    }

    @-webkit-keyframes fadein {
    from {top: 0; opacity: 0;} 
    to {top: 120px; opacity: 1;}
    }

    @keyframes fadein {
    from {top: 0; opacity: 0;}
    to {top: 120px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
    from {top: 120px; opacity: 1;} 
    to {top: 0; opacity: 0;}
    }

    @keyframes fadeout {
    from {top: 120px; opacity: 1;}
    to {top: 0; opacity: 0;}
    }
</style>

<div id="snackbar">Some Message..</div>

<script>
    function toast(content,icon,status) {
    var color_success = "#42ba96";
    var color_danger = "#df4759";
    var toast = document.getElementById("snackbar");
    $('#snackbar').css("background-color", status==1? color_success : color_danger);
    $('#snackbar').html(icon+'&nbsp;'+content);
    toast.className = "show";
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
    }
</script>