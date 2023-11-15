    function changeTheme(){

            $.ajax({

                url:'controls/change_theme.php',
                type:'POST',
                data:{
                    change:'ok'
                },
                success:function(data){
                   var json = JSON.parse(data);
                   if(json.result){
                    location.reload();
                   }else{
                    console.log("err changing theme.");
                   }
                },
                error:function(err){
                    console.log(err);
                }



            });

        }