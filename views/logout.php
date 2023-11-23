    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.json-2.4.min.js"></script>
            <?php
                if(isset($_SESSION['id'])) {
                    session_destroy();
                    ?>
                <script>swal({
  title:"Logout",
  type: "success",
  text:"Your going to logged out :)",
  timer: 2000,
  showConfirmButton: false
});</script>
                <?php
                }
                else {
                             ?>
                <script>swal({
  title:"Already logged out",
  type: "info",
  text:"your are already logged out from the system",
  timer: 2200,
  showConfirmButton: false
});</script>
                <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function() {
        window.location.reload();
    }
    ,2100);
</script>