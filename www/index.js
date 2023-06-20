$(document).ready(function(e) {
    trae_transacciones();
    trae_ganancias();
});
function trae_transacciones(){
    $.ajax({
        type	: "POST",
        url		: "/Controller/transaccionController.php",
        async	: true,
        data	: {
        opt		: 'traeTransacciones'
        },
		
        success: function(r){
            $(".contenido").html(r);
        }
    });
}
function trae_ganancias(){
    $.ajax({
        type	: "POST",
        url		: "/Controller/transaccionController.php",
        async	: true,
        data	: {
        opt		: 'traeGanancias'
        },
		
        success: function(r){
            $(".tablaGanancias").html(r);
        }
    });
}
$(document).on('click','#btnRegistrar',function(){
    
   var nombre_tx= $('#nomTx').val();
   var monto_tx= $('#montoTx').val();
   var tipo_tx= $('#tipoTx').val();

   if(nombre_tx=="" || monto_tx=="" || tipo_tx==0){
      $("#error_msg").css("display", "block");
      return false;  
    }else{
        $("#error_msg").css("display", "none");
    }
   
    $.ajax({
        type	: "POST",
        url		: "/Controller/transaccionController.php",
        async	: true,
        data	: {
        opt		: 'grabaTransaccion',
            nomTx 	: nombre_tx,
            montoTx : monto_tx,
            tipoTx  : tipo_tx
        },
		
        success: function(r){
            console.log(r);
            if($.trim(r)=="ok"){ 
                alertify.success("Transaccion registrada exitosamente");
                trae_transacciones();
                trae_ganancias();
                $('#nomTx').val("");
                $('#montoTx').val("");
                $('#tipoTx').val(0);
            }else{
                alertify.error("Error al registrar transaccion: "+r);
            }	
        }
    });

})

$(document).on('click','.editar',function(){
    var id_tx=$(this).data("id");
    $.ajax({
        type	: "POST",
        url		: "/Controller/transaccionController.php",
        async	: true,
        data	: {
        opt		: 'trae_info_transaccion',
            id_tx 	: id_tx,
        },
		
        success: function(r){
            console.log(r);
          
            var info_tx=r.split("**");
            $('#nombreTransaccionModal').val(info_tx[0]);
            $('#montoTransaccionModal').val(info_tx[1]);
            $('#tipoTransaccionModal').val(info_tx[2]);
            $("#idTx").val(id_tx);
            $("#modal_editar").show();
            
        }
    });
    
})
$(document).on('click','.close',function(){
    $("#modal_editar").hide();
})
$(document).on('click','#btnActualiza',function(){
    
    var nombre_tx= $('#nombreTransaccionModal').val();
    var monto_tx= $('#montoTransaccionModal').val();
    var tipo_tx= $('#tipoTransaccionModal').val();
 
    if(nombre_tx=="" || monto_tx=="" || tipo_tx==0){
       alertify.warning("Complete todos los campos de la transacción");
       return false;  
     }
    
     $.ajax({
         type	: "POST",
         url		: "/Controller/transaccionController.php",
         async	: true,
         data	: {
         opt		: 'modificaTransaccion',
             nomTx 	 : nombre_tx,
             montoTx : monto_tx,
             tipoTx  : tipo_tx,
             idTx   : $("#idTx").val()
         },
         
         success: function(r){
             console.log(r);
             if($.trim(r)=="ok"){ 
                 alertify.success("Transaccion modificada exitosamente");
                 trae_transacciones();
                 trae_ganancias();
                 $('#nombreTransaccionModal').val("");
                 $('#montoTransaccionModal').val("");
                 $('#tipoTransaccionModal').val(0);
                 $("#modal_editar").hide();
             }else{
                 alertify.error("Error al modificar transaccion: "+r);
             }	
         }
     });
 
 })

 $(document).on('click','.eliminar',function(){
   var id_tx=$(this).data("id");
    alertify.confirm("Se trata de un diálogo de confirmación",
        function (e) {
            if (e) {
                $.ajax({
                    type	: "POST",
                    url		: "/Controller/transaccionController.php",
                    async	: true,
                    data	: {
                    opt		: 'eliminaTransaccion',
                        idTx 	: id_tx
                    },
                    
                    success: function(r){
                        console.log(r);
                        if($.trim(r)=="ok"){
                            trae_transacciones();
                            trae_ganancias();
                            alertify.success("Se ha eliminado correctamente la transacción");
                        }else{
                            alertify.error("Error al eliminar: "+r);
                        }
                    }
                });
                
            } else {
                alertify.error("Eliminación cancelada");
            }
	});
    
})
 