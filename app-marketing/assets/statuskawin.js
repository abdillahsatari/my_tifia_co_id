
        $(function () {
            $("#status_kawin").change(function () {
                if ($(this).val() == "Menikah") {
                    $("#pasangan").show(300);//1:500
                    document.getElementById("nama_pasangan").required = true;
                } else {
                    $("#pasangan").hide(300);
                    document.getElementById("nama_pasangan").required = false;
                }
            });
        });
