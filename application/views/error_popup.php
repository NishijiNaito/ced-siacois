<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Script Emp -->
<script type="text/javascript">
    

        swal({
                title: "เกิดข้อผิดพลาด",
                text: "<?php echo $msg; ?>",
                icon: "error",
                buttons: false,
                closeOnEsc: false,
                closeOnClickOutside: false,
                timer: 3000,
                
            })
            .then((willDelete) => {
                
                    
                    window.location.href = "<?php echo base_url().$goto; ?>";
        
                
            });
</script>