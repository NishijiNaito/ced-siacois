<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Script Pdf -->
<script type="text/javascript">
        
      
    function del(num) {

        swal({
                title: "ยืนยันการลบ",
                text: "คุณแน่ใจแล้วหรือ ที่จะลบ id " + num + " ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("กำลังลบ id" + num, {
                        icon: "success",
                    });
                    window.location.href = "<?php echo current_url(); ?>/delete/" + num;
        
                } 
            });

/*
        if (confirm("คุณแน่ใจแล้วหรือ ที่จะลบ id " + num + " ?")) {
            window.location.href = "<?php //echo current_url(); ?>/delete/" + num;
        }
        */
    }
</script>