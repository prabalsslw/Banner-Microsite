            
        </div>
    </body>

    <?php if(isset($_SESSION['errorMsg'])){ ?>
        <script type="text/javascript">
            swal({
                title: "Sorry!",
                text: "<?php echo $_SESSION['errorMsg']; ?>",
                icon: "error",
                button: "Cancel",
            });
         </script>
        <?php }elseif(isset($_SESSION['successMsg'])){ ?>
        <script type="text/javascript">
            swal({
                title: "Successful",
                text: "<?php echo $_SESSION['successMsg']; ?>",
                icon: "success",
                button: "Ok",
            });

        </script>
    <?php } ?>
</html>

<?php 
    if (isset($_SESSION['errorMsg'])) {
        unset($_SESSION['errorMsg']);
    }
    if(isset($_SESSION['successMsg'])) {
        unset($_SESSION['successMsg']);
    }
?>