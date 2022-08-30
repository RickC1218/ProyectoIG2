'use stricts'

/*
Funcion encargada de devolver las tarjeta con respecto a COMBOS, BEBIDAS, SNACKS Y DULCES
*/
function getRows() {
    // ver el ID del TAB seleccionado para asegurarse de que tabla y tipo de SNACK se quiere listar
    var table_bd = localStorage.getItem("idClickDulceria");
    var userData;
    var tipoSnack = [];

    if (table_bd != 'combos') {
        tipoSnack = getTipSnack(table_bd);
        userData = 'action_type=view&' + 'table_bd=SNACK&tipo_snack=' + tipoSnack[1];
    } else {
        userData = 'action_type=view&' + 'table_bd=' + table_bd.toUpperCase();
        tipoSnack[0] = 'ver_combos';
    }

    console.log(userData);

    $.ajax({
        type: 'POST',
        url: '../UseCases/userAction.php',
        data: userData,
        success: function (html) {
            $('#' + tipoSnack[0]).html(html);
        }
    });
}

/*
Funcion encargada de devolver la informacion respectiva a cada producto
en el caso de dar click en el boton VER respecto a cada tarjeta.
*/
function getRowSpecific(id) {
    var table_bd = localStorage.getItem("idClickDulceria");
    var ID_prod = parseInt(id.split('_')[1]); // obtener número (ID_COMBO or ID_SNACK)
    localStorage.setItem('id_specific', ID_prod); // almacenamiento de ID_prod
    var userData;
    var tipoSnack = [];

    if (table_bd != 'combos') { // snack
        tipoSnack = getTipSnack(table_bd);
        userData = 'action_type=viewSpecific&' + 'table_bd=SNACK&tipo_snack=' + tipoSnack[1] + '&id=' + ID_prod;
    } else { // combos
        userData = 'action_type=viewSpecific&' + 'table_bd=' + table_bd.toUpperCase() + '&id=' + ID_prod;
    }

    $.ajax({
        type: 'POST',
        url: '../UseCases/userAction.php',
        data: userData,
        success: function (html) {
            $('#modalProdSpecific').html(html);
        }
    });
}

/*
Funcion encargada de devolver la informacion respectiva de la
tabla detalle_dulceria de la BD
*/
function getDetalle_Dulceria() { // se puede enviar como parametro algun ID que reconozca al cliente para filtrar la informacion

    var userData = 'action_type=viewDetalle_dulceria';

    $.ajax({
        type: 'POST',
        url: '../UseCases/userAction.php',
        data: userData,
        success: function (html) {
            $('#container_detalle_dul').html(html);
            // obteniendo el total a pagar por los snacks de la dulceria
            var precioTotalDulceria = localStorage.getItem('precioTotalDulceria');
            var precioHTML = document.getElementById('precioTotal');
            precioHTML.innerHTML = '$ ' + precioTotalDulceria;
        }
    });
}

function getDetallePelicula() {
    var userData = 'action_type=viewDetalle_pelicula';

    $.ajax({
        type: 'POST',
        url: '../UseCases/userAction.php',
        data: userData,
        success: function (html) {
            $('#container_detPelicula').html(html);
            // obteniendo el total a pagar por los snacks de la dulceria
            //var precioTotalDulceria = localStorage.getItem('precioTotalDulceria');
            //var precioHTML = document.getElementById('precioTotal');
            //precioHTML.innerHTML = '$ ' + precioTotalDulceria;
        }
    });
}

/*
Devuelve el tipo de snack en funcion del nombre de la tabla ingresada
*/
function getTipSnack(table_bd) {
    var arreglo = [];

    switch (table_bd) {
        case 'bebidas': {
            arreglo[0] = 'ver_bebidas';
            arreglo[1] = 'B';
            return arreglo;
        }
        case 'snacks': {
            arreglo[0] = 'ver_snacks';
            arreglo[1] = 'S';
            return arreglo;
        }
        case 'dulces': {
            arreglo[0] = 'ver_dulces';
            arreglo[1] = 'D';
            return arreglo;
        }
    }
}

//INSERT INTO detalle_dulceria
function userAction(type, id) {
    var cantidad_aux = parseInt(document.getElementById("cantidad").innerHTML);

    if (cantidad_aux == 0) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            text: 'Es necesario elegir la cantidad del producto!',
            background: '#041C3299', 
            color: '#ffff',
        });
    } else {
        Swal.fire({
            title: '¿Desea agregar al carrito el producto seleccionado?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'SI',
            background: '#041C3299', 
            color: '#ffff',
            confirmButtonColor: '#ECB365',
            denyButtonText: 'NO',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var table_bd = localStorage.getItem("idClickDulceria");
                var ID_prod = localStorage.getItem('id_specific'); // obtener número (ID_COMBO or ID_SNACK)
                var userData;
                var cantidad = parseInt(document.getElementById("cantidad").innerHTML);
                var precio = document.getElementById("precioPopup").innerHTML;
                precio = parseFloat(precio.split('$ ')[1]);

                console.log(precio);

                if (table_bd != 'combos') { // snack
                    tipoSnack = getTipSnack(table_bd);
                    userData = 'tipo_prod=0';
                } else { // combos
                    userData = 'tipo_prod=1';
                }

                userData += '&table_bd=DETALLE_DULCERIA' + '&id=' + ID_prod + '&id_factura=1' + '&cantidad_detdul=' + cantidad + '&precio=' + precio;

                id = (typeof id == "undefined") ? '' : id; // ver si el id fue definido
                var statusArr = { add: "added", edit: "updated", delete: "deleted" };

                let array_ids;
                if (type == 'add') {
                    if (localStorage.getItem("array_ids") == 0) { // verificar si es un snack sin subtipo
                        array_ids = ['NULL'];
                    } else {
                        array_ids = JSON.parse(localStorage.getItem("array_ids"));
                    }
                    userData += '&action_type=' + type + '&array_ids=' + array_ids;
                }

                console.log(userData);

                $.ajax({
                    type: 'POST',
                    url: '../UseCases/userAction.php',
                    data: userData,
                    success: function (msg) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Producto GUARDADO',
                            showConfirmButton: false,
                            background: '#041C3299', 
                            color: '#ffff',
                            timer: 1500
                        });
                        setTimeout(function () {
                            document.location.href = 'carritoCompras.html';
                        }, 2000);
                    }
                });
            } else if (result.isDenied) {
                $('#myModal').modal('hide');
                Swal.fire('Producto NO GUARDADO');
            }
        });
    }
}

/*
Funcion encargada de eliminar un producto del detalle_dulceria en funcion de su ID.
*/
function deleteUser(id) {
    Swal.fire({
        title: '¿Desea eliminar el producto seleccionado?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'SI',
        denyButtonText: `NO`,
        background: '#041C3299', 
        color: '#ffff',
        confirmButtonColor: '#ECB365'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            var idAux = parseInt(id.split('_')[1]);
            var userData = 'action_type=delete' + '&table_name=DETALLE_DULCERIA' + '&id=' + idAux;
            $.ajax({
                type: 'POST',
                url: '../UseCases/userAction.php',
                data: userData,
                success: function (msg) {
                    Swal.fire({
                        title:'Producto ELIMINADO',
                        background: '#041C3299', 
                        color: '#ffff'
                    });
                    setTimeout(function () {
                        document.location.reload();
                    }, 2000);
                }
            });
        } else if (result.isDenied) {
            Swal.fire({
            title:'Producto NO ELIMINADO',
            background: '#041C3299', 
            color: '#ffff'
            });
        }
    });
}

function getPayPalButtons() {
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay',
            size: 'mini'
        },
        createOrder: function (data, actions) {
            var precioTotalDulceria = parseFloat(localStorage.getItem('precioTotalDulceria'));

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: precioTotalDulceria
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            actions.order.capture().then(function (detalles) {
                var statusCompra = detalles.status;
                if (statusCompra == 'COMPLETED') {
                    statusCompra = 1;
                }
                var MyDate = new Date();
                var fechaCompra = transformDate(MyDate.toLocaleDateString());
                var totalCompra = detalles.purchase_units[0].amount.value;
                var idFactura = 1; // coger ID_FACTURA de la sesion

                var userData = 'action_type=updateFactura' + '&tbName=FACTURA' + '&id=' + idFactura + '&statusCompra=' + statusCompra + '&fechaCompra=' + fechaCompra + '&totalCompra=' + totalCompra;
                $.ajax({
                    type: 'POST',
                    url: '../UseCases/userAction.php',
                    data: userData,
                    success: function (html) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pago realizado con éxito!',
                        });
                        //console.log(html);
                        $.ajax({
                            method: 'POST',
                            url: '../sendEmail/pdf/factura.php',
                            success: function (html) {
                                console.log(html);
                            }
                        });
                    }
                });
            });
        },
        onCancel: function (data) {
            Swal.fire({
                title: 'PAGO CANCELADO',
                text: '¿Desea eliminar su pedido?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'SI',
                denyButtonText: `NO`,
                background: '#041C3299', 
                color: '#ffff',
                confirmButtonColor: '#ECB365'
            }).then((result) => {
                if (result.isConfirmed) {
                    // DELETE FROM FACTURA WHERE ID_FACTURA = ?
                    /*var userData = 'action_type=delete' + '&table_name=DETALLE_DULCERIA' + '&id=' + idAux;
            $.ajax({
                type: 'POST',
                url: '../UseCases/userAction.php',
                data: userData,
                success: function (msg) {
                    Swal.fire('Producto ELIMINADO');
                    setTimeout(function () {
                        document.location.reload();
                    }, 2000);
                }
            });*/
                } else if (result.isDenied) {
                    Swal.fire('Intente nuevamente realizar el pago!')
                }
            });
            console.log(data);
        }
    }).render('#paypal-button-container');
}

function transformDate(fecha) {
    var aux = fecha.split('/');
    var fechaString = '';
    for (var i = 2; i >= 0; i--) {
        if (i == 0) {
            fechaString += aux[i];
        } else {
            fechaString += aux[i] + '-';
        }
    }
    return fechaString;
}