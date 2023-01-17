
        $(function () {
            $("#status").change(function () {
                if ($(this).val() == "Checking") {
                    $("#komen").show(300);//1:500
                    document.getElementById("komentar").required = true;
                } else {
                    $("#komen").hide(300);
                    document.getElementById("komentar").required = false;
                }
            });
        });
