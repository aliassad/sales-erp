<div class="row align-center" style="margin-top:5px;text-align: center;  padding:0px;">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        <p class="label label-default label-custom">Copyright &copy; 2017-2024 Fast Software Solutions <b>(Ali Assad
                +923348101214)</b>, All rights
            reserved.</p>

    </div>
</div>
</div>


</div>
<script src="js/bootstrap-select.js">


</script>
<script>
    var ok = true;
    $("#menu").click(function () {
        if (ok) {
            $(".side-nav").animate({
                width: "197px"
            }, 600);
            ok = false;
            $('#arrow').removeClass('fa-arrow-right');
            $('#arrow').addClass('fa-arrow-left');
            $('#arrow').removeClass('goleft');
            $('#arrow').addClass('goright');
        } else {
            $(".side-nav").animate({
                width: "65px"
            }, 400);

            ok = true;

            $('#arrow').removeClass('fa-arrow-left');
            $('#arrow').addClass('fa-arrow-right');
            $('#arrow').removeClass('goright');
            $('#arrow').addClass('goleft');
        }
    });

    $(window).load(function () {

        // Do the code in the {}s when the window has loaded
        $(".loader").fadeOut("fast");  //Fade out the #loader div
        $("#side_menu").fadeIn("fast");  //Fade out the #loader div
    });
</script>

</body>
</html>

