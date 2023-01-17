
            $(function(){
                $('#bank_select').change(function(){
                    var bankid=$(this).val();
                    $.ajax({
                        url : "bank/getBankDetail",
                        method : "POST",
                        data : {bankid: bankid},
                        async : false,
                        dataType : 'json',
                        success: function(data){
                            $("#nmpemilik_slc").val(data.atas_nama);
                            $("#kodebank_slc").val(data.kode_bank);
                        }
                    });
                });
            });
