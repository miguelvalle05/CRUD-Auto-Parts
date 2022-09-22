var Toast = Swal.mixin({

    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000

})

let parameters = []
let attributes = []
var attributesEdit = []



function removeElement(event, position) {
    event.target.parentElement.remove()
    delete parameters[position]
}

const addJsonElement = json => {
    parameters.push(json)
    return parameters.length - 1
}


const addJsonAttributes = json => {
    attributes.push(json)
    return attributes.length - 1
}


$(document).ready(function() {

    const $form = document.getElementById("frmGeneral")
    const $divElements = document.getElementById("divElements")
    const $btnAdd = document.getElementById("btnAdd")
    const $btnSave = document.getElementById("btnSave")
    document.getElementById("btnNewSearch").style.display = 'none'; // hide


    document.getElementById("partType").disabled = true
    document.getElementById("brand").disabled = true
    document.getElementById("model").disabled = true
    document.getElementById("version").disabled = true
    document.getElementById("initialYear").disabled = true
    document.getElementById("finalYear").disabled = true
    document.getElementById("btnAdd").disabled = true
    document.getElementById("btnDelete").disabled = true
    document.getElementById("btnSave").disabled = true

    $("#code").change(function() {
        $("#code").each(function() {
            codeV = $(this).val();

            $.ajax({
                url: "ValidateProduct.php",
                type: "post",
                data: {
                    codeV: codeV
                }
            }).done(function(res) {
                if (res == 0) {
                    alert("Codigo Inexistente")
                    $("#code").val(null);
                } else {

                    document.getElementById("code").disabled = true
                    document.getElementById("btnNewSearch").style.display = ''; // show

                    document.getElementById("brand").disabled = false
                    document.getElementById("model").disabled = false
                    document.getElementById("version").disabled = false
                    document.getElementById("initialYear").disabled = false
                    document.getElementById("finalYear").disabled = false
                    document.getElementById("btnAdd").disabled = false
                    document.getElementById("btnSave").disabled = false
                    document.getElementById("btnDelete").disabled = false


                    resultado = JSON.parse(res);


                    data = resultado["app"];




                    if (resultado["att"] == null) {
                        attributesEdit = []

                    } else {
                        attributesEdit = resultado["att"]
                    }




                    console.log(resultado["app"]);
                    console.log(resultado["att"]);

                    $("#partType").val(data[0].tipo_parte);
                    $("#partType").change();

                    parameters = []




                    data.map(function(aplicacion) {

                        let index = addJsonElement({

                            code: aplicacion.codigo,
                            partType: aplicacion.tipo_parte,
                            brand: aplicacion.IdMarca,
                            model: aplicacion.IdModelo,
                            version: aplicacion.IdVersion,
                            initialYear: aplicacion.id_ano_in,
                            finalYear: aplicacion.id_ano_fin,


                        })





                        const $div = document.createElement("div")
                        $div.classList.add("notification", "is-link", "is-light", "py-2", "my-1")
                        if (aplicacion.IdVersion == null && aplicacion.id_ano_in == 0 && aplicacion.id_ano_fin == 0) {
                            $div.innerHTML = templateElement(`${aplicacion.maDescripcion} ${aplicacion.moDescripcion}`, index)


                        } else if (aplicacion.id_ano_in == 0 && aplicacion.id_ano_fin == 0) {

                            $div.innerHTML = templateElement(`${aplicacion.maDescripcion} ${aplicacion.moDescripcion} ${aplicacion.vDescripcion}  `, index)



                        } else if (aplicacion.IdVersion == null) {

                            $div.innerHTML = templateElement(`${aplicacion.maDescripcion} ${aplicacion.moDescripcion}   ${aplicacion.Anioi}  ${aplicacion.Aniof} `, index)


                        } else {

                            $div.innerHTML = templateElement(`${aplicacion.maDescripcion} ${aplicacion.moDescripcion} ${aplicacion.vDescripcion}   ${aplicacion.Anioi}  ${aplicacion.Aniof}`, index)


                        }



                        $divElements.insertBefore($div, $divElements.firstChild)

                    });



                }

            });


        });
    })



    $("#partType").change(function() {
        $("#partType option:selected").each(function() {
            id_partType = $(this).val();

            $.post("PartType.php", { id_partType: id_partType }, function(data) {




                if (window.attributesEdit.length != 0) {



                    atributo = "#atributo"
                    $("#attributes").html(data);



                    window.attributesEdit.map(function(attr) {






                        for (var titulo = 1; titulo < 35; titulo++) {
                            attri = atributo + titulo

                            var tittle_text = $(attri + " " + "option:first").html();




                            if (tittle_text == attr.aDescripcion) {


                                valor = attr.id_atributos + "." + attr.id_valores




                                $(attri).val(valor);


                            }


                        }





                    });

                } else {

                    $("#attributes").html(data);
                }




            });
        });

    })


    //BRAND
    $("#brand").change(function() {
        $("#brand option:selected").each(function() {
            id_brand = $(this).val();
            $.post("Model.php", { id_brand: id_brand }, function(data) {
                $("#model").html(data);

            });
        });
    })

    //MODEL
    $("#model").change(function() {
        $("#model option:selected").each(function() {
            id_model = $(this).val();
            $.post("VersionAdd.php", { id_model: id_model }, function(data) {
                $("#version").html(data);

            });
        });
    })

    //INITIALYEAR
    $("#initialYear").change(function() {
        $("#initialYear option:selected").each(function() {
            id_initialYear = $(this).val();
            $.post("FinalYear.php", { id_initialYear: id_initialYear }, function(data) {
                $("#finalYear").html(data);

            });
        });
    })

    const templateElement = (data, position) => {
        return (`
            <button class="delete" onclick="removeElement(event, ${position})"></button>
            <strong>Aplicacion - </strong> ${data}
        `)
    }






    $btnAdd.addEventListener("click", (event) => {

        if ($form.code.value == "" && $form.partType.value == "") {
            alert("Ingresa Codigo y/o tipo de parte")

        } else {


            if ($form.brand.value != "" && $form.model.value != "") {
                let index = addJsonElement({

                    code: $form.code.value,
                    partType: $form.partType.value,
                    brand: $form.brand.value,
                    model: $form.model.value,
                    version: $form.version.value,
                    initialYear: $form.initialYear.value,
                    finalYear: $form.finalYear.value,



                })

                const $div = document.createElement("div")
                $div.classList.add("notification", "is-link", "is-light", "py-2", "my-1")


                if ($form.version.value == "" && $form.initialYear.value == "" && $form.finalYear.value == "")

                {

                    $div.innerHTML = templateElement(`
                ${$form.brand.options[brand.selectedIndex].text} 
                ${$form.model.options[model.selectedIndex].text} 
                `, index)

                } else if ($form.version.value == "") {

                    $div.innerHTML = templateElement(`
                ${$form.brand.options[brand.selectedIndex].text} 
                ${$form.model.options[model.selectedIndex].text} 
                ${$form.initialYear.options[initialYear.selectedIndex].text}
                ${$form.finalYear.options[finalYear.selectedIndex].text} 
                
               
                   `, index)


                } else if ($form.initialYear.value == "" && $form.finalYear.value == "") {

                    $div.innerHTML = templateElement(`
                ${$form.brand.options[brand.selectedIndex].text} 
                ${$form.model.options[model.selectedIndex].text} 
                ${$form.version.options[version.selectedIndex].text} 
                
                
            
                `, index)


                } else if ($form.finalYear.value == "") {

                    $div.innerHTML = templateElement(`
                ${$form.brand.options[brand.selectedIndex].text} 
                ${$form.model.options[model.selectedIndex].text} 
                ${$form.version.options[version.selectedIndex].text} 
                ${$form.initialYear.options[initialYear.selectedIndex].text} 
                
                
            
                `, index)


                } else {

                    $div.innerHTML = templateElement(`
                ${$form.brand.options[brand.selectedIndex].text} 
                ${$form.model.options[model.selectedIndex].text} 
                ${$form.version.options[version.selectedIndex].text} 
                ${$form.initialYear.options[initialYear.selectedIndex].text} 
                ${$form.finalYear.options[finalYear.selectedIndex].text} 
                
               
                   `, index)




                }

                $divElements.insertBefore($div, $divElements.firstChild)








            } else {
                alert("Complete los campos de aplicacion")


            }

        }




    })


    $btnSave.addEventListener("click", (event) => {

        if ($form.code.value != "" && $form.partType.value != "") {


            Swal.fire({
                title: "¡CONFIRMAR!",
                icon: "warning",
                text: "¿Esta seguro de que desea editar el producto?",
                showCancelButton: true,
                confirmButtonText: "Si, deseo editar",
                cancelButtonText: "Cancelar"

            }).then(resultado => {
                if (resultado.value) {

                    parameters = parameters.filter(el => el != null)


                    /*  NO DESCOMENTAR const $jsonDiv = document.getElementById("jsonDiv")
 
                   $jsonDiv.innerHTML = ` ${JSON.stringify(parameters)}`*/

                    var str_json = ` ${JSON.stringify(parameters)}`
                    const request = new XMLHttpRequest()
                    request.open("POST", "EditProductApp.php")
                    request.setRequestHeader("Content-type", "application/json")
                    request.send(str_json)
                    console.log(str_json)



                    /* begins code block for attributes type Select */


                    attributes = []
                    atributo = "#atributo"
                    limit = $("#record").val()

                    for (i = 1; i <= limit; i++) {

                        a = atributo + i

                        if ($(a).val() != "" && $(a).val() != null) {

                            val = $(a).val().toString();

                            let arr = val.split('.');

                            at = arr[0]
                            va = arr[1]


                            addJsonAttributes({

                                code: $form.code.value,
                                attribute: at,
                                value: va


                            })

                            /* console.log(" atributo: " + at + " valor " + va)
                                 
                                                                alert(" atributo: " + at + " valor " + va)*/

                        }




                    }
                    /*ends code block for attributes type Select */




                    attributes = attributes.filter(el => el != null)

                    var str_json_attributes = ` ${JSON.stringify(attributes)}`

                    const requestA = new XMLHttpRequest()
                    requestA.open("POST", "ProductAttributesEdit.php")
                    requestA.setRequestHeader("Content-type", "application/json")
                    requestA.send(str_json_attributes)
                    console.log(str_json_attributes)


                    $.post("ProductDescriptions.php", { codeV: $form.code.value, option: 2 }, function(data) {

                       
                      
                    });

                 




                    Toast.fire({
                        icon: "success",
                        title: "El producto se agrego"

                    })

                    $form.reset()

                    window.location.href = "http://192.168.1.199/programas/com/Aplicaciones/EditProduct.php";



                } else {



                }


            })




        } else {
            alert("Completa los campos")
        }






    })


    $(document).on("click", "#btnNewSearch", function(e) {
        //alert("soy el boton nuevo")

        location.reload();
        clearstatcache();

    });



    $(document).on("click", "#btnDelete", function(e) {



        Swal.fire({
            title: "¡CONFIRMAR!",
            icon: "warning",
            text: "¿Esta seguro de eliminar el Producto?",
            showCancelButton: true,
            confirmButtonText: "Si, deseo eliminar",
            cancelButtonText: "Cancelar"

        }).then(resultado => {
            if (resultado.value) {
                $.ajax({
                    url: "ProductDelete.php",
                    type: "post",
                    data: {
                        code: document.getElementById("code").value
                    }
                }).done(function(res) {
                    if (res == 0) {
                        alert("No se elimino")

                    } else {

                        $.post("ProductDescriptions.php", { codeV: $form.code.value, option: 1 }, function(data) {
                      
                        });



                        Toast.fire({
                            icon: "success",
                            title: "El producto se elimino"

                        })
                        location.reload();
                        clearstatcache();

                    }
                });







            }


        })



    });










});