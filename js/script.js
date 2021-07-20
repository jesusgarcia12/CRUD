$('document').ready(function (){

    /*$('#form001').validate({
        rules:{
            studentsname:{
                required:true
            },
            lastname:{
                required:true
            },
            age:{
                required:true
            },
            email:{
                required:true,
                email:true
            }
        }
    })
*/

$('#btn001').click((function (){

    if($('#form001').valid()){
        const $result=$('#warning');
        const email=$('#email').val();
        //const id=$('#id').val();
        const age=$('#age').val();
        const name=$('#studentsname').val();
        const lastname=$('#lastname').val();

        $result.text("");

        if(!validateemail(email)){
            $result.text("INVALID EMAIL ADDRESS");
            return;
        }
        if(!validatename(name)){
            $result.text("INVALID NAME");
            return;
        }
        if(!validateage(age)){
            $result.text("INVALID AGE");
            return;
        }
        if(!validatelastname(lastname)){
            $result.text("INVALID LASTNAME");
            return;
        }
        else {
            $address = "utlaguna.edu.mx";
            if (validacion(email) == $address) {
                console.log("ENTRA POR VERDADERO");
                var s1 = $('#form001').serialize();
                s1 = s1 + "&accion=AGREGAR";
                console.log(s1);
                $.ajax({
                    data: s1,
                    type: "post",
                    url: "php/crud.php",
                    success: function (data) {
                        resp1= JSON.parse(data);
                        alert(resp1.desc+ " "+resp1.idst+resp1.color);
                    }
                })
            }else {
                alert("DOMINIO INCORRECTO");
            }
        }
    }


}
))

    $('#btn003').click((function (){


        if($('#form001').valid()){
            const $result=$('#warning');
            const id=$('#idstudents').val();

            $result.text("");

            if(!validateid(id)){
                $result.text("INVALID ID ");
                return;
            }
            else {
                var s1= $('#form001').serialize();

                s1=s1+"&accion=BORRAR";
                console.log (s1);
                $.ajax({
                    data: s1,
                    type: "post",
                    url: "php/crud.php",
                    success:function(data){
                        //alert(data);
                        resp1 = JSON.parse(data);
                        alert(resp1.desc+ " "+resp1.idst+resp1.color);
                    }
                })


            }
        }
        }
    ))

    $('#btn002').click((function (){

            if($('#form001').valid()){
                const $result=$('#warning');
                const email=$('#email').val();
                const id=$('#idstudents').val();
                const age=$('#age').val();
                const name=$('#studentsname').val();
                const lastname=$('#lastname').val();
        

                $result.text("");

                if(!validateid(id)){
                    $result.text("INVALID ID ");
                    return;
                }
                if(!validateemail(email)){
                    $result.text("INVALID EMAIL ADDRESS");
                    return;
                }
                if(!validatename(name)){
                    $result.text("INVALID NAME");
                    return;
                }
                if(!validateage(age)){
                    $result.text("INVALID AGE");
                    return;
                }
                if(!validatelastname(lastname)){
                    $result.text("INVALID LASTNAME");
                    return;
                }
                else {
                    $address = "utlaguna.edu.mx";
                    if (validacion(email) == $address) {
                        console.log("ENTRA POR VERDADERO");
                        var s1 = $('#form001').serialize();
                        s1 = s1 + "&accion=ACTUALIZAR"
                        console.log(s1);
                        $.ajax({
                            data: s1,
                            type: "post",
                            url: "php/crud.php",

                            //si hay una respuesta de php
                            success: function (data) {
                                resp1 = JSON.parse(data);
                                alert(resp1.desc+ " "+resp1.idst+resp1.color);
                            }
                        })
                    }else {
                        alert("Dominio no correcto");
                    }
                }
            }
        }
    ))
})
function validacion(email)
{
    const lastIndex = email.lastIndexOf('@');
    return email.slice(lastIndex + 1, email.length);

}
function validateid(id){
    const re= /^[1-9][0-9]{0,2}$/;
    return re.test(id);
}

function validatename(nombre){
    const re= /^[a-zA-Z-' ]*$/;
    return re.test(nombre);
}

function validatelastname(lastname){
    const re= /^[a-zA-Z-' ]*$/;
    return re.test(lastname);
}

function validateage(age){
    const re= /^[1-9][0-9]{0,1}$/;
    return re.test(age);
}

function validateemail(email){
    console.log(email);
    const re=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function loadgrid()
{
    var grid = $("#grid-command-buttons").bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
            };
        },
        url: "php/bgridquery.php",
        formatters: {
            "commands": function(column, row)
            {
                return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " + 
                    "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
            }
        }
    }).on("loaded.rs.jquery.bootgrid", function()
    {
        /* Executes after data is loaded and rendered */
        grid.find(".command-edit").on("click", function(e)
        {
            alert("You pressed edit on row: " + $(this).data("row-id"));
        }).end().find(".command-delete").on("click", function(e)
        {
            alert("You pressed delete on row: " + $(this).data("row-id"));
        });
    });


}