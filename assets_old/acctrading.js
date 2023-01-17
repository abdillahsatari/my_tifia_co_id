
            $(function(){
                $('#no_akun_wd').change(function(){
                    var accid=$(this).val();
                    
                    $.ajax({
                        url : "akuntrading/getAccDetail",
                        method : "POST",
                        data : {accid: accid},
                        async : false,
                        dataType : 'json',
                        success: function(data){
                            $("#komisi").val(data.komisi);
                            $("#nilaitukar").val(data.nama_currency + ' | ' + data.withdraw_rate );
                        }
                    });
                });
            });
