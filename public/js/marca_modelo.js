$(document).ready(function () {

    $("#marca-select").change(function () {
        let marca_id = $(this).val();
        $('#modelo-select').empty();
        $.ajax({
            url: '/api/marcas/' + marca_id + '/modelos',
            type: 'get',
            dataType: 'json',
            success: function (modelos) {
                modelos.forEach(modelo => {
                    $('#modelo-select').append($('<option>', {
                        value: modelo['id'],
                        text: modelo['nombre']
                    }));
                })

            }
        });
    });

    $("#otra-marca").change(function () {
        let otra_marca = $(this);
        let select = $('#marca-select');
        let input = $('#marca-text');
        let otro_modelo = $('#otro-modelo');
        if(otra_marca.is(":checked"))
        {
            input.removeClass('d-none');
            select.addClass('d-none');
            if(!otro_modelo.is(":checked"))
            {
                //otro_modelo.prop("checked", true);
                otro_modelo.click();
            }
        } else {
            select.removeClass('d-none');
            input.addClass('d-none');
            //otro_modelo.prop("checked", true);
            if(otro_modelo.is(":checked"))
            {
                //otro_modelo.prop("checked", true);
                otro_modelo.click();
            }
        }
    });

    $("#otro-modelo").change(function () {
        let otro_modelo = $(this);
        let select = $('#modelo-select');
        let input = $('#modelo-text');
        if(otro_modelo.is(":checked"))
        {
            input.removeClass('d-none');
            select.addClass('d-none');
        } else {
            select.removeClass('d-none');
            input.addClass('d-none');
        }
    });

    IMask(
        document.getElementById('vehiculo_dominio'),
        {
            mask: [
                {
                    mask: 'aaa000'
                },
                {
                    mask: '000aaa'
                },
                {
                    mask: 'aa000aa'
                },
                {
                    mask: 'a000aaa'
                }
            ]
        });

    IMask(
        document.getElementById('vehiculo_anio'),
        {
            mask: '0000'
        });

});
