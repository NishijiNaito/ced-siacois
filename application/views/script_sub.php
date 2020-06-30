<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Script sub -->

<script type="text/javascript">
    function logo() {
        window.location.href = "../../logout.php";
    }

    function del(type, num, name, utype) {
        switch (type) {
            case 1:
                switch (utype) {
                    case "uni":
                        var nametype = "มหาวิทยาลัย";
                        break;
                    case "col":
                        var nametype = "วิทยาลัย";
                        break;
                }

                break;
            case 2:
                var nametype = "คณะ";
                break;
            case 3:
                var nametype = "ภาควิชา";
                break;
        }

        swal({
                title: "ยืนยันการลบ",
                text: "คุณแน่ใจแล้วหรือ ที่จะลบ" + nametype + " " + name + " ?",
                icon: "warning",
                buttons: true,
                closeOnEsc: false,
                closeOnClickOutside: false,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("กำลังลบ" + nametype + " " + name, {
                        icon: "success",
                    });
                    window.location.href = "<?php echo current_url(); ?>/delete/" + type + "/" + num;

                }
            });


    }

    function test() {
        alert("Hello");
    }

    function changeunidata() {
        var req = new XMLHttpRequest();
        req.overrideMimeType("application/json");
        var itype = document.getElementById('iutype').value;
        var uid = document.getElementById('iuid').value;
        //alert(user+"/"+pass);
        req.open('get', "<?php echo base_url(); ?>adminconsole/subdata/jsonload/" + itype + "/" + uid);
        req.onload = function() {
            //alert(req.responseText);

            var jsonResponse = JSON.parse(req.responseText);
            //alert(jsonResponse);
            var responseText = "";

            if (jsonResponse.status == 0) {

            } else {
                if (jsonResponse.uform == "in") {
                    document.getElementById("Eformtype").selectedIndex = 0;
                } else {
                    document.getElementById("Eformtype").selectedIndex = 1;
                }
                if(jsonResponse.utype == "col"){
                    document.getElementById("iuctype").selectedIndex = 0;
                }else{
                    document.getElementById("iuctype").selectedIndex = 1;
                }
            }
        };


        req.send();
    }

    function changedepdata() {
        var req = new XMLHttpRequest();
        req.overrideMimeType("application/json");
        var itype = document.getElementById('idtype').value;
        var uid = document.getElementById('idid').value;
        //alert(user+"/"+pass);
        req.open('get', "<?php echo base_url(); ?>adminconsole/subdata/jsonload/" + itype + "/" + uid);
        req.onload = function() {
            //alert(req.responseText);

            var jsonResponse = JSON.parse(req.responseText);
            //alert(jsonResponse);
            var responseText = "";

            if (jsonResponse.status == 0) {

            } else {
                if (jsonResponse.dtype == "col") {
                    document.getElementById("idetype").selectedIndex = 0;
                } else {
                    document.getElementById("idetype").selectedIndex = 1;
                }
                
            }
        };


        req.send();
    }
</script>