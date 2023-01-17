document.addEventListener('DOMContentLoaded', function () {


    var base_url = window.location.origin + '/'; // asli
    // var base_url = window.location.origin + '/mytfx_kabinet/'; // local - ganti dengan nama folder anda
    console.log('Jika di local, mohon ganti base_url pada file ./assets/wilayah-administratif.js');

    $(document).on("change", "#provinsi", function () {
        loadKabupaten();
    });

    $(document).on("change", "#kabupaten", function () {
        loadKecamatan();
    });

    $(document).on("change", "#kecamatan", function () {
        loadKelurahan();
    });

    function loadKabupaten() {
        var provinsi = $("#provinsi").val();
        if (provinsi != "") {
            $.ajax({
                type: 'GET',
                url: base_url + "wilayah/kabupaten",
                data: "id=" + provinsi,
                success: function (html) {
                    $("#kabupaten").html(html);
                    $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
                    $("#kelurahan").html('<option value="">-- Pilih Kelurahan --</option>');
                }
            });
        } else {
            $("#kabupaten").html('<option value="">-- Pilih Kabupaten/Kota --</option>');
            $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
            $("#kelurahan").html('<option value="">-- Pilih Kelurahan --</option>');
        }
    }

    function loadKecamatan() {
        var kabupaten = $("#kabupaten").val();
        if (kabupaten != "") {
            $.ajax({
                type: 'GET',
                url: base_url + "wilayah/kecamatan",
                data: "id=" + kabupaten,
                success: function (html) {
                    $("#kecamatan").html(html);
                    $("#kelurahan").html('<option value="">-- Pilih Kelurahan --</option>');
                }
            });
        } else {
            $("#kecamatan").html('<option value="">-- Pilih Kecamatan --</option>');
            $("#kelurahan").html('<option value="">-- Pilih Kelurahan --</option>');
        }

    }

    function loadKelurahan() {
        var kecamatan = $("#kecamatan").val();
        if (kecamatan != "") {
            $.ajax({
                type: 'GET',
                url: base_url + "wilayah/kelurahan",
                data: "id=" + kecamatan,
                success: function (html) {
                    $("#kelurahan").html(html);
                }
            });
        } else {
            $("#kelurahan").html('<option value="">-- Pilih Kelurahan --</option>');
        }
    }
});