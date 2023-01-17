// jQuery Code

document.addEventListener('DOMContentLoaded', function () {

    console.log('doc ready');

    // By Default Disable radio button

    // $(".button-next").attr('disabled', true);

    $("form input:radio").change(function () {

        if ($(this).val() == "0") {

            // $(".button-next").hide(300);

            $(".button-next").attr('disabled', true);

            $(".profilperusahaan_error").append("<font color='red'>Anda tidak bisa melanjutkan!</font>");

        }

        // Else Enable radio buttons.

        else {

            $(".button-next").attr('disabled', false);

            $(".button-next").show(300);

            $(".profilperusahaan_error").empty();

        }

    });

    $("#checkbox_1").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_2").removeAttr("disabled");

            $("#checkbox_2").focus();

        } else {

            // $("#checkbox_2").attr("disabled", "disabled");



        }

    });

    $("#checkbox_2").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_3").removeAttr("disabled");

            $("#checkbox_3").focus();

        } else {

            // $("#checkbox_3").attr("disabled", "disabled");



        }

    });

    $("#checkbox_3").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_4").removeAttr("disabled");

            $("#checkbox_4").focus();

        } else {

            // $("#checkbox_4").attr("disabled", "disabled");



        }

    });

    $("#checkbox_4").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_5").removeAttr("disabled");

            $("#checkbox_5").focus();

        } else {

            // $("#checkbox_5").attr("disabled", "disabled");



        }

    });

    $("#checkbox_5").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_6").removeAttr("disabled");

            $("#checkbox_6").focus();

        } else {

            // $("#checkbox_6").attr("disabled", "disabled");



        }

    });

    $("#checkbox_6").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_7").removeAttr("disabled");

            $("#checkbox_7").focus();

        } else {

            // $("#checkbox_7").attr("disabled", "disabled");



        }

    });

    $("#checkbox_7").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_8").removeAttr("disabled");

            $("#checkbox_8").focus();

        } else {

            // $("#checkbox_8").attr("disabled", "disabled");



        }

    });

    $("#checkbox_8").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_9").removeAttr("disabled");

            $("#checkbox_9").focus();

        } else {

            // $("#checkbox_9").attr("disabled", "disabled");



        }

    });

    $("#checkbox_9").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_10").removeAttr("disabled");

            $("#checkbox_10").focus();

        } else {

            // $("#checkbox_10").attr("disabled", "disabled");



        }

    });

    $("#checkbox_10").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_11").removeAttr("disabled");

            $("#checkbox_11").focus();

        } else {

            // $("#checkbox_11").attr("disabled", "disabled");



        }

    });

    $("#checkbox_11").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_12").removeAttr("disabled");

            $("#checkbox_12").focus();

        } else {

            // $("#checkbox_12").attr("disabled", "disabled");



        }

    });

    $("#checkbox_12").click(function () {

        if ($(this).is(":checked")) {

            // $("#checkbox_13").removeAttr("disabled");

            $("#checkbox_13").focus();

        } else {

            // $("#checkbox_13").attr("disabled", "disabled");



        }

    });

    // $("#checkbox_13").click(function () 

    // {

    //     if ($(this).is(":checked")) {

    //         $("#cb_1").removeAttr("disabled");

    //         $("#cb_1").focus();

    //     } else {

    //         $("#cb_1").attr("disabled", "disabled");



    //     }

    // });

    $("#cb_1").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_2").removeAttr("disabled");

            $("#cb_2").focus();

        } else {

            // $("#cb_2").attr("disabled", "disabled");



        }

    });

    $("#cb_2").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_4").removeAttr("disabled");

            $("#cb_4").focus();

        } else {

            // $("#cb_4").attr("disabled", "disabled");



        }

    });

    // $("#cb_3").click(function () {

    //     if ($(this).is(":checked")) {

    //         $("#cb_4").removeAttr("disabled");

    //         $("#cb_4").focus();

    //     } else {

    //         $("#cb_4").attr("disabled", "disabled");



    //     }

    // });

    $("#cb_4").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_5").removeAttr("disabled");

            $("#cb_5").focus();

        } else {

            // $("#cb_5").attr("disabled", "disabled");



        }

    });

    $("#cb_5").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_6").removeAttr("disabled");

            $("#cb_6").focus();

        } else {

            // $("#cb_6").attr("disabled", "disabled");



        }

    });

    $("#cb_6").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_7").removeAttr("disabled");

            $("#cb_7").focus();

        } else {

            // $("#cb_7").attr("disabled", "disabled");



        }

    });

    $("#cb_7").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_8").removeAttr("disabled");

            $("#cb_8").focus();

        } else {

            // $("#cb_8").attr("disabled", "disabled");



        }

    });

    $("#cb_8").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_10").removeAttr("disabled");

            $("#cb_10").focus();

        } else {

            // $("#cb_10").attr("disabled", "disabled");



        }

    });

    // $("#cb_9").click(function () {

    //     if ($(this).is(":checked")) {

    //         $("#cb_10").removeAttr("disabled");

    //         $("#cb_10").focus();

    //     } else {

    //         $("#cb_10").attr("disabled", "disabled");



    //     }

    // });

    $("#cb_10").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_11").removeAttr("disabled");

            $("#cb_11").focus();

        } else {

            // $("#cb_11").attr("disabled", "disabled");



        }

    });

    $("#cb_11").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_12").removeAttr("disabled");

            $("#cb_12").focus();

        } else {

            // $("#cb_12").attr("disabled", "disabled");



        }

    });

    $("#cb_12").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_13").removeAttr("disabled");

            $("#cb_13").focus();

        } else {

            // $("#cb_13").attr("disabled", "disabled");



        }

    });

    $("#cb_13").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_14").removeAttr("disabled");

            $("#cb_14").focus();

        } else {

            // $("#cb_14").attr("disabled", "disabled");



        }

    });

    $("#cb_14").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_15").removeAttr("disabled");

            $("#cb_15").focus();

        } else {

            // $("#cb_15").attr("disabled", "disabled");



        }

    });

    $("#cb_15").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_16").removeAttr("disabled");

            $("#cb_16").focus();

        } else {

            // $("#cb_16").attr("disabled", "disabled");



        }

    });

    $("#cb_16").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_17").removeAttr("disabled");

            $("#cb_17").focus();

        } else {

            // $("#cb_17").attr("disabled", "disabled");



        }

    });

    $("#cb_17").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_18").removeAttr("disabled");

            $("#cb_18").focus();

        } else {

            // $("#cb_18").attr("disabled", "disabled");



        }

    });

    $("#cb_18").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_19").removeAttr("disabled");

            $("#cb_19").focus();

        } else {

            // $("#cb_19").attr("disabled", "disabled");



        }

    });

    $("#cb_19").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_20").removeAttr("disabled");

            $("#cb_20").focus();

        } else {

            // $("#cb_20").attr("disabled", "disabled");



        }

    });

    $("#cb_20").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_21").removeAttr("disabled");

            $("#cb_21").focus();

        } else {

            // $("#cb_21").attr("disabled", "disabled");



        }

    });

    $("#cb_21").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_22").removeAttr("disabled");

            $("#cb_22").focus();

        } else {

            // $("#cb_22").attr("disabled", "disabled");



        }

    });

    $("#cb_22").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_23").removeAttr("disabled");

            $("#cb_23").focus();

        } else {

            // $("#cb_23").attr("disabled", "disabled");



        }

    });

    $("#cb_23").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_24").removeAttr("disabled");

            $("#cb_24").focus();

        } else {

            // $("#cb_24").attr("disabled", "disabled");



        }

    });

    $("#cb_24").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_25").removeAttr("disabled");

            $("#cb_25").focus();

        } else {

            // $("#cb_25").attr("disabled", "disabled");



        }

    });


    // PERATURAN PERDAGANGAN
    $("#cb_26").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_27").removeAttr("disabled");

            $("#cb_27").focus();

        } else {

            // $("#cb_27").attr("disabled", "disabled");



        }

    });

    $("#cb_27").click(function () {

        if ($(this).is(":checked")) {

            // $("#cb_28").removeAttr("disabled");

            $("#cb_28").focus();

        } else {

            // $("#cb_28").attr("disabled", "disabled");



        }

    });


    $(".check_all_1").on('change', function () {


        for (let i = 1; i <= 13; i++) {
            if ($(this).prop("checked") == true) {

                $('.check_all_1').prop("checked", true);
                $('#checkbox_' + i).prop("checked", true);
                console.log('#checkbox_' + i + ' checked');
            } else {

                $('.check_all_1').prop("checked", false);
                $('#checkbox_' + i).prop("checked", false);
                console.log('#checkbox_' + i + ' not checked');

            }
        }



    });

    $(".check_all_2").on('change', function () {

        var cb_no = ['1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25'];

        cb_no.forEach(function (i) {

            if ($('.check_all_2').prop("checked") == true) {
                // $('.check_all_2').prop("checked", true);
                $('#cb_' + i).prop("checked", true);
                console.log('#cb_' + i + ' checked');
            } else {
                // $('.check_all_2').prop("checked", false);
                $('#cb_' + i).prop("checked", false);
                console.log('#cb_' + i + ' not checked');

            }
        });



    });




    $("#nama_lengkap").keyup(function () {

        $("#namalengkapspan").html($(this).val())

        $("#namalengkapspan2").html($(this).val())

        $("#namalengkapspan8").html($(this).val())

    });

    $("#alamat_rumah").keyup(function () {

        $("#alamatspan").html($(this).val())

        $("#alamatspan2").html($(this).val())
        $("#alamatspan8").html($(this).val())

    });

    $("#kode_pos").keyup(function () {

        $("#kodeposspan").html($(this).val())
        $("#kodeposspan8").html($(this).val())

    });

    $("#no_identitas").keyup(function () {

        $("#noidspan").html($(this).val())
        $("#noidspan8").html($(this).val())

    });

    $("#noaccspan").html($("#noakundemo").val())
    $("#noaccspan8").html($("#noakundemo").val())

    $("#pekerjaan").change(function () {

        $("#pekerjaanspan").html($(this).val() + "/" + $("#jabatan").val())

    });

    $("#jabatan").keyup(function () {

        $("#pekerjaanspan").html($("#pekerjaan").val() + "/" + $(this).val())

    });

    $("#photo").change(function () {

        readURLFoto(this);

    });

    $("#npwp").change(function () {

        readURLNPWP(this);

    });

    $("#tabungan").change(function () {

        readURLTabungan(this);

    });

    $("#identitas").change(function () {

        readURLIdentitas(this);

    });

    // $("#submit_regist").click(function () {

    $("#m_form").submit(function (e) {

        // var cek_upload = true;

        // if (document.getElementById("img_foto").files.length == 0) {
        //     cek_upload = false;
        // }
        // if (document.getElementById("img_npwp").files.length == 0) {
        //     cek_upload = false;
        // }
        // if (document.getElementById("img_identitas").files.length == 0) {
        //     cek_upload = false;
        // }
        // if (document.getElementById("img_tabungan").files.length == 0) {
        //     cek_upload = false;
        // }

        e.preventDefault();
        // var me = $(this);
        $("#submit_regist").prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin"></i>');

        // if (cek_upload == true) {

        $.ajax({

            url: 'registercomplete/save',
            type: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            dataType: 'JSON',
            processData: false,

            success: function (json) {

                // if (json.form_validation == true) {

                if (json.success == true) {

                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Succes!',
                        text: json.alert,
                        showConfirmButton: false,
                        timer: 2500
                    }).then(function () {
                        window.location.href = "kabinet";
                    });


                } else {
                    Swal.fire({
                        position: 'center',
                        type: 'error',
                        title: 'Error!',
                        text: json.alert,
                        showConfirmButton: false,
                        timer: 2500
                    }).then(function () {
                        $("#submit_regist").prop('disabled', false)
                            .html('Submit');
                    });
                }
                // } else {
                //     $("#submit_regist").prop('disabled', false)
                //         .html('Submit');
                //     alert(json.alert);
                // }

            },

            error: function (json) {

                $("#submit_regist").prop('disabled', false)
                    .html('Submit');
                alert(errorThrown);

            }

        })

        // }
    })

    // });

});


function readURLFoto(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function (e) {

            document.getElementById("img_foto").src = e.target.result

        }



        reader.readAsDataURL(input.files[0]);

    }

}



function readURLNPWP(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function (e) {

            document.getElementById("img_npwp").src = e.target.result

        }



        reader.readAsDataURL(input.files[0]);

    }

}



function readURLIdentitas(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function (e) {

            document.getElementById("img_identitas").src = e.target.result

        }



        reader.readAsDataURL(input.files[0]);

    }

}



function readURLTabungan(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function (e) {

            document.getElementById("img_tabungan").src = e.target.result

        }



        reader.readAsDataURL(input.files[0]);

    }

}



function copy_ttl() {

    var ttl = document.getElementById("tempat_lahir").value + ", " + document.getElementById("m_datepicker_3").value;

    // document.getElementById("namalengkapspan").text(ttl);

    $("#ttlspan").html(ttl);
    $("#ttlspan8").html(ttl);

}



function copy_nama() {

    // alert(document.getElementById("nama_lengkap").value);

    document.getElementById("namalengkap").value = document.getElementById("nama_lengkap").value;

    document.getElementById("namalengkap2").value = document.getElementById("nama_lengkap").value;

    document.getElementsByName("namalengkapspan").value = document.getElementById("nama_lengkap").value;

    $("#namalengkapspan2").html(document.getElementById("nama_lengkap").value);

    // $("#namalengkapspan3").html(document.getElementById("nama_lengkap").value);

    $("#namalengkapspan4").html(document.getElementById("nama_lengkap").value);

}



function copy_tmpt() {

    document.getElementById("tempatlahir").value = document.getElementById("tempat_lahir").value;

    document.getElementById("tempatlahir2").value = document.getElementById("tempat_lahir").value;

    // console.log(copy_ttls());

    copy_ttl();

}



function copy_tgl() {

    document.getElementById("tgllahir").value = document.getElementById("m_datepicker_3").value;

    document.getElementById("tgllahir2").value = document.getElementById("m_datepicker_3").value;

    // console.log(copy_ttls());

    copy_ttl();

}



function copy_alamat() {

    document.getElementById("alamat").value = document.getElementById("alamat_rumah").value;

    document.getElementById("alamat2").value = document.getElementById("alamat_rumah").value;

    document.getElementById("alamat2").value = document.getElementById("alamat_rumah").value;

    $("#alamatspan2").html(document.getElementById("alamat_rumah").value);

    // $("#alamatspan3").html(document.getElementById("alamat_rumah").value);

    $("#alamatspan4").html(document.getElementById("alamat_rumah").value);

}



function copy_kodepos() {

    document.getElementById("kodepos").value = document.getElementById("kode_pos").value;

    document.getElementById("kodepos2").value = document.getElementById("kode_pos").value;

    $("#kodeposspan2").html(document.getElementById("kode_pos").value);

}



function copy_noid() {

    document.getElementById("noid").value = document.getElementById("no_identitas").value;

    document.getElementById("noid2").value = document.getElementById("no_identitas").value;

    $("#noidspan").html(document.getElementById("no_identitas").value);

}



function copy_bank() {

    // $("#bankspan").html(document.getElementById("no_identitas").value);

}



function copy_rekening() {

    // $("#rekeningspan").html(document.getElementById("no_identitas").value);

}



function copy_telepon() {
    $("#teleponspan").html(document.getElementById("no_tlp").value);
}

function copy_fax() {
    $("#faxspan").html(document.getElementById("no_faksimili").value);
}
