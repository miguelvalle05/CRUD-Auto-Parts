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

    document.getElementById("btnSave").style.display = 'none'; // hide


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


    $("#code").change(function() {
        $("#code").each(function() {
            codeV = $(this).val();

            $.ajax({
                url: "ProductCode.php",
                type: "post",
                data: {
                    codeV: codeV
                }
            }).done(function(res) {
                if (res == 0) {


                    Swal.fire({
                        title: "¡CONFIRMAR!",
                        icon: "warning",
                        text: "¿Esta seguro de clonar el producto " + codeV + "?",
                        showCancelButton: true,
                        confirmButtonText: "Si, deseo clonar",
                        cancelButtonText: "Cancelar"

                    }).then(resultado => {
                        if (resultado.value) {

                            $.ajax({
                                url: "ValidateProduct.php",
                                type: "post",
                                data: {
                                    codeV: codeV
                                }
                            }).done(function(res) {
                                if (res == 0) {
                                    alert("No puede clonar")
                                    $("#code").val(null);
                                } else {

                                    $("#code").val(null);
                                    document.getElementById("partType").disabled = true
                                    document.getElementById("btnSave").style.display = ''; // show


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



                        } else {




                            $("#code").val(null);





                        }


                    })





                } else {

                    document.getElementById("code").disabled = true

                }

            });


        });
    })




    $btnAdd.addEventListener("click", (event) => {

        if ($form.code.value == "" && $form.partType.value == "") {
            alert("Ingresa Codigo y/o tipo de parte")

        } else {



            if ($form.brand.value != "" && $form.model.value != "") {

                document.getElementById("btnSave").style.display = ''; // Show
                let index = addJsonElement({


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
                text: "¿Esta seguro de que desea agregar el producto?",
                showCancelButton: true,
                confirmButtonText: "Si, deseo agregar",
                cancelButtonText: "Cancelar"

            }).then(resultado => {
                if (resultado.value) {

                    parameters = parameters.filter(el => el != null)


                    /*  NO DESCOMENTAR const $jsonDiv = document.getElementById("jsonDiv")
 
                   $jsonDiv.innerHTML = ` ${JSON.stringify(parameters)}`*/

                    for (var i = 0; i < parameters.length; i++) {
                        parameters[i].code = $form.code.value;

                    }

                    var str_json = ` ${JSON.stringify(parameters)}`
                    const request = new XMLHttpRequest()
                    request.open("POST", "ProductApp.php")
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
                    requestA.open("POST", "ProductAttributes.php")
                    requestA.setRequestHeader("Content-type", "application/json")
                    requestA.send(str_json_attributes)
                    console.log(str_json_attributes)


                    $.post("ProductDescriptions.php", { codeV: $form.code.value, option: 0 }, function(data) {
                      
                    });


                    Toast.fire({
                        icon: "success",
                        title: "El producto se agrego"

                    })

                    $form.reset()

                    window.location.href = "http://192.168.1.199/programas/com/Aplicaciones/AddProduct.php";



                } else {



                }


            })




        } else {
            alert("Completa los campos Codigo y/o Tipo de parte")
        }






    })









});