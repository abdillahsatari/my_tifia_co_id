        $(function () {
            $("#status_dw").change(function () {
                if ($(this).val() == "Reject") {
                    $("#komentr").show(300);//1:500
                    document.getElementById("komentar").required = true;
                } else {
                    $("#komentr").hide(300);
                    document.getElementById("komentar").required = false;
                }
            });
        });