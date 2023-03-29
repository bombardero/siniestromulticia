$(document).ready(function () {
    $("#provincias").change(function () {
        provincia_id = $("#provincias").val();
        console.log(provincia_id);
        $.ajax({
            url: '/api/provincias/' + provincia_id + '/localidades',
            type: 'get',
            dataType: 'json',
            success: function (cities) {
                $('#localidades').empty();
                cities.forEach(city => {
                    $('#localidades').append($('<option>', {
                        value: city['id'],
                        text: city['name']
                    }));
                })
            },
            complete: function () {
                $('#check_otra_localidad').prop("checked", false);
                $('#localidades').removeClass('d-none');
                $("#localidades").prop('disabled', false);
                $('#otra_localidad').addClass('d-none');
                $("#otra_localidad").prop('disabled', true);
            }
        })
    });
});

$("#pais").change(function () {
    let pais = $(this).val();
    //console.log(pais);
    if (pais == 'otro') {
        $('#div_otro_pais_provincia_localidad').removeClass('d-none')
        $('#div_provincia').addClass('d-none')
        $('#div_localidad').addClass('d-none')
    } else {
        $('#div_otro_pais_provincia_localidad').addClass('d-none')
        $('#div_provincia').removeClass('d-none')
        $('#div_localidad').removeClass('d-none')
    }
});

$("#check_otra_localidad").click(function () {
    if ($(this).prop("checked")) {
        $('#localidades').addClass('d-none');
        $("#localidades").prop('disabled', true);
        $('#otra_localidad').removeClass('d-none');
        $("#otra_localidad").prop('disabled', false);
    } else {
        $('#localidades').removeClass('d-none');
        $("#localidades").prop('disabled', false);
        $('#otra_localidad').addClass('d-none');
        $("#otra_localidad").prop('disabled', true);
    }
});
