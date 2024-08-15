<form class="" action='{{route("asegurados-denuncias-paso10.store")}}' method="POST"
      enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{request('id')}}">

    <div class="container form-denuncia-siniestro p-4">

        <span style="color:#6e4697;font-size: 24px;"><b>Paso 10 </b>| 12 <b>Datos del Siniestro</b></span>

        <div class="row">
            <div class="col-12">
                <label id="rotondaText" class="grafico escenarios">
                    <input class="opacity" type="radio" id="rotonda" name="screen">ROTONDA
                </label>
                <label id="rutaText" class="escenarios grafico">
                    <input class="opacity" type="radio" id="ruta" name="screen">RUTA/CALLE
                </label>
                <label id="interseccionText" class="escenarios grafico">
                    <input class="opacity" type="radio" id="interseccion" name="screen">INTERSECCIÓN
                </label>
                <label id="otrosText" class="escenarios">
                    <input class="opacity" type="radio" id="otros" name="screen">OTROS
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grafico" id="grafico">
                @if(isset($denuncia_siniestro->croquis_url))
                    <div class="col-12">
                        <img class="w-100" id="graficoBD" src="{{$denuncia_siniestro->croquis_url}}" alt="">
                        <div id="container" style="display:none;" class="dropContainer"></div>
                        <div class="pt-3 form-check">
                            <label class="terminos-condiciones-entiendo" style="color:red;"><img
                                    src="/images/siniestros/denuncia_asegurado/informacion_rojo.png"
                                    style=" margin-bottom: 2px;"><span class="pl-1">Para editar el gráfico, apriete en el boton "Limpiar"</span></label>
                        </div>
                    </div>
                @else
                    <div id="container" class="dropContainer"></div>
                @endif

                <div id="cardAutomotor" class="mt-3 w-100 card card-automotor background-card-iconos mx-auto">
                    <div class="ml-4 mr-4 pt-3" id="drag-items">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <span
                                            class="font-weight-bold denuncia-vehiculo-asegurado">Vehiculo asegurado</span>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <img draggable="true" id="auto_asegurado"
                                             src="/images/siniestros/recursos_siniestros/iconos/auto_asegurado.png">
                                        <img draggable="true" id="moto_asegurado"
                                             src="/images/siniestros/recursos_siniestros/iconos/moto_asegurado.png">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">

                                    <div class="col-12 col-md-4">
                                        <span class="font-weight-bold semaforo text-right">Semáforos</span>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <img draggable="true" id="semaforo_rojo"
                                             src="/images/siniestros/recursos_siniestros/iconos/semaforo_rojo.png">
                                        <img draggable="true" id="semaforo_verde"
                                             src="/images/siniestros/recursos_siniestros/iconos/semaforo_verde.png">
                                        <img draggable="true" id="semaforo_amarillo"
                                             src="/images/siniestros/recursos_siniestros/iconos/semaforo_amarillo.png">
                                        <img draggable="true" id="semaforo_roto"
                                             src="/images/siniestros/recursos_siniestros/iconos/semaforo_roto.png">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-2">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <span class="font-weight-bold denuncia-vehiculo-tercero">Terceros</span>

                                    </div>
                                    <div class="col-12 col-md-8">
                                        <img draggable="true" id="auto_tercero"
                                             src="/images/siniestros/recursos_siniestros/iconos/auto_tercero.png">
                                        <img draggable="true" id="moto_tercero"
                                             src="/images/siniestros/recursos_siniestros/iconos/moto_tercero.png">
                                        <img draggable="true" id="animal_tercero"
                                             src="/images/siniestros/recursos_siniestros/iconos/animal_tercero.png">
                                        <img draggable="true" id="cosa_tercero"
                                             src="/images/siniestros/recursos_siniestros/iconos/cosa_tercero.png">
                                        <img draggable="true" id="persona_tercero"
                                             src="/images/siniestros/recursos_siniestros/iconos/persona_tercero.png">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <span class="font-weight-bold sentido-circulacion"> Sentido de circ. </span>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <img draggable="true" id="abajo"
                                             src="/images/siniestros/recursos_siniestros/iconos/abajo.png">
                                        <img draggable="true" id="arriba"
                                             src="/images/siniestros/recursos_siniestros/iconos/arriba.png">
                                        <img draggable="true" id="izquierda"
                                             src="/images/siniestros/recursos_siniestros/iconos/izquierda.png">
                                        <img draggable="true" id="derecha"
                                             src="/images/siniestros/recursos_siniestros/iconos/derecha.png">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row pt-2">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <span
                                            class="font-weight-bold vehiculo-trayectoria">Trayectoria hasta impacto</span>

                                    </div>
                                    <div class="col-12 col-md-8">
                                        <img draggable="true" id="trayectoria_abajo"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_abajo.png">
                                        <img draggable="true" id="trayectoria_arriba"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_arriba.png">
                                        <img draggable="true" id="trayectoria_derecha"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_derecha.png">
                                        <img draggable="true" id="trayectoria_izquierda"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_izquierda.png">
                                        <img draggable="true" id="trayectoria_abajo_derecha"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_abajo_derecha.png">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12">

                                        <img draggable="true" id="trayectoria_arriba_derecha"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_arriba_derecha.png">
                                        <img draggable="true" id="trayectoria_arriba_izquierda"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_arriba_izquierda.png">
                                        <img draggable="true" id="trayectoria_giro_abajoderecha"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_giro_abajoderecha.png">

                                        <img draggable="true" id="trayectoria_abajo_izquierda"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_abajo_izquierda.png">
                                        <img draggable="true" id="trayectoria__giro_abajoizqueirda"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_giro_abajoizquierda.png">
                                        <img draggable="true" id="trayectoria_giro_arribaderecha"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_giro_arribaderecha.png">
                                        <img draggable="true" id="trayectoria_giro_arribaizquierda"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_giro_arribaizquierda.png">
                                        <img draggable="true" id="trayectoria_giro_arribaizquierda"
                                             src="/images/siniestros/recursos_siniestros/iconos/trayectoria_giro_arribaizquierda.png">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="pt-1 row">
                            <div class="col-12">
                                <span class="font-weight-bold arrastrar">Arrastrar íconos correspondientes al escenario seleccionado para graficar el siniestro</span>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-12 pt-3">
                        <button id="clearBtn" class="btn boton-azul mb-0">Limpiar</button>
                        &nbsp
                        <button disabled id="saveBtn" class="btn boton-azul mb-0">Confirmar Dibujo</button>
                </div>

                <div class="col-12">
                    @error('graficoManual') <span class="invalid-feedback pl-2" style="font-size: .9em;"><b>{{ $message }}</b></span> @enderror
                </div>

                <div id="previewImg" class="d-none"></div>
            </div>
            <div id="subidaManual" style="display: none; background-color: #C4C4C4" class="w-100 mx-auto col-12">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 col-md-8 p-4 ">
                        <label class="terminos-condiciones-entiendo" style="color:#2D2D7B;"><img
                                src="/images/siniestros/recursos_siniestros/alert-circle-outline 1frame10-.png"
                                style=" margin-bottom: 2px;"><span class=" font-weight-bold pl-1">En caso de que ningún escenario represente el evento o no pudiera utilizar la herramienta digital, puede adjuntar una foto de un croquis manuscrito.</span></label>
                    </div>
                    <div class="pt-1 pt-md-4 col-12 col-md-4">
                        <div class="form-group row ">
                            <div class="text-center col-12 ">
                                <input onchange="getFileData(this);" type="file" name="graficoManual"
                                       id="graficoManual" accept="image/png,image/jpeg">
                                <label for="graficoManual">
                                    <div class="row">
                                        <div class="col-12  subir-archivo-bg-morado">
                                            <img
                                                src="{{url('/images/siniestros/recursos_siniestros/upload-icon-frame11.png')}}"
                                                class="img-fluid pt-4">
                                            <p class="subir-archivo-morado">Subir Imagen</p>
                                        </div>

                                    </div>
                                </label>
                                </p>
                                @if(isset($denuncia_siniestro->croquis_url))
                                    <div id="databaseIMG" class="row">
                                        <div class="col-12">
                                            <p>
                                                <a target="_blank" class="documento-formato-texto pt-2"
                                                   href={{$denuncia_siniestro->croquis_url}}>Ver Archivo Subido
                                                    Anteriormente</a><i class="pl-2 fas fa-check"></i>
                                            </p>

                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <p>
                                            <a id="subidaReciente" class="documento-formato-texto pt-2"></a><i
                                                id="iconoReciente" class="d-none pl-2 fas fa-check"></i>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <hr class="mt-3">

            <div class="col-12 mt-3">
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea id="description" rows="4"
                              class="form-control form-estilo"
                              readonly
                    >{{ $denuncia_siniestro->descripcion }}</textarea>
                </div>
            </div>

            <div class="col-12 mt-3">
                <div class="form-group">
                    <label for="description">Ampliar descripción del siniestro</label>
                    <textarea name="description" id="description" rows="4"
                              class="form-control form-estilo"
                    ></textarea>
                </div>
            </div>


            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="comisaria">Comisaria</label>
                    <input type="text" name="comisaria" id="comisaria"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denuncia_policial_comisaria }}">
                </div>
            </div>


            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="acta">Número de Acta</label>
                    <input type="text" name="acta" id="acta"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denuncia_policial_acta }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="folio">Folio</label>
                    <input type="text" name="folio" id="folio"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denuncia_policial_folio }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="sumario">Sumario</label>
                    <input type="text" name="sumario" id="sumario"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denuncia_policial_sumario }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="juzgado">Juzgado</label>
                    <input type="text" name="juzgado" id="juzgado"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denuncia_policial_juzgado }}">
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label for="secretaria">Secretaria</label>
                    <input type="text" name="secretaria" id="secretaria"
                           class="form-control form-estilo"
                           value="{{ $denuncia_siniestro->denuncia_policial_secretaria }}">
                </div>
            </div>

        </div>

        <a class="mt-5 boton-enviar-siniestro btn"
           style="border:1px solid #6e4697;font-weight: bold;background: transparent;color: #6e4697;"
           href='{{route('asegurados-denuncias-paso9.create',['id'=> request('id')])}}'>ANTERIOR</a>
        <input type="submit" class="mt-5 boton-enviar-siniestro btn" value='SIGUIENTE'
               style="background:#6e4697;font-weight: bold;"/>

    </div>


    <div class="col-12 text-center text-md-right">
        <div wire:loading class="spinner-border" role="status">
            <span class="sr-only">Cargando...</span>
            <span class="sr-only">Cargando...</span>
        </div>
    </div>
</form>

@section('scripts')

    <script>
        function getFileData(myFile) {


            var file = myFile.files[0];
            var filename = file.name;
            document.getElementById('subidaReciente').innerHTML = filename;
            document.getElementById('iconoReciente').style.display = "block"; // hide

            if ($("#databaseIMG") != null) {
                $("#databaseIMG").remove();
            }


        }

        $(document).ready(function () {


            // KONVA
            const width = 697;
            const height = 300;
            const options = {container: 'container', width, height}
            const stage = new Konva.Stage(options);
            const layer = new Konva.Layer();
            stage.add(layer);

            // KONVA

            const canvas = document.querySelector('canvas');


            const inputs = document.querySelectorAll('input[type="radio"]');
            // const ctx = canvas.getContext('2d');

            const base_image = new Image();
            const rotonda = '/images/siniestros/recursos_siniestros/iconos/escenarios/rotonda.png';
            const avenida = '/images/siniestros/recursos_siniestros/iconos/escenarios/avenida.png';
            const intersección = '/images/siniestros/recursos_siniestros/iconos/escenarios/interseccion.png'

            inputs[0].checked = true; // check primer radio button
            base_image.src = rotonda;
            $("#rotondaText").removeClass("escenarios").addClass("escenarioSelect");
            canvas.style.backgroundImage = `url(${base_image.src})`;
            canvas.style.backgroundRepeat = 'no-repeat';
            canvas.parentElement.classList.add("mx-auto")

            if (window.innerWidth <= 1200) {
                base_image.src = '';
                canvas.style.backgroundImage = '';
                document.getElementById('grafico').style.display = "none"; // hide
                document.getElementById('subidaManual').style.display = "block"; // show
                $("#otrosText").removeClass("escenarios").addClass("escenarioSelect");
                $("#rotondaText").removeClass("escenarioSelect").addClass("escenarios");
                $("#rutaText").removeClass("escenarioSelect").addClass("escenarios");
                $("#interseccionText").removeClass("escenarioSelect").addClass("escenarios");
            }

            window.addEventListener('resize', function () {
                if(window.innerWidth <= 1200)
                {
                    $("#otros").click();
                }
            });

            inputs.forEach(input => {
                input.addEventListener('change', (e) => {
                    if (e.srcElement.id === 'rotonda') {
                        base_image.src = rotonda;
                        canvas.style.backgroundImage = `url(${base_image.src})`;
                        $("#rotondaText").removeClass("escenarios").addClass("escenarioSelect");
                        $("#rutaText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#interseccionText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#otrosText").removeClass("escenarioSelect").addClass("escenarios");
                        document.getElementById('grafico').style.display = "block"; // hide
                        document.getElementById('subidaManual').style.display = "none"; // show
                    } else if (e.srcElement.id === 'ruta') {
                        base_image.src = avenida;
                        canvas.style.backgroundImage = `url(${base_image.src})`;
                        $("#rutaText").removeClass("escenarios").addClass("escenarioSelect");
                        $("#rotondaText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#interseccionText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#otrosText").removeClass("escenarioSelect").addClass("escenarios");
                        document.getElementById('grafico').style.display = "block"; // hide
                        document.getElementById('subidaManual').style.display = "none"; // show
                    } else if (e.srcElement.id === 'interseccion') {
                        base_image.src = intersección;
                        canvas.style.backgroundImage = `url(${base_image.src})`;
                        $("#interseccionText").removeClass("escenarios").addClass("escenarioSelect");
                        $("#rotondaText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#rutaText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#otrosText").removeClass("escenarioSelect").addClass("escenarios");
                        document.getElementById('grafico').style.display = "block"; // hide
                        document.getElementById('subidaManual').style.display = "none"; // show
                    } else if (e.srcElement.id === 'otros') {
                        base_image.src = '';
                        canvas.style.backgroundImage = '';
                        document.getElementById('grafico').style.display = "none"; // hide
                        document.getElementById('subidaManual').style.display = "block"; // show
                        $("#otrosText").removeClass("escenarios").addClass("escenarioSelect");
                        $("#rotondaText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#rutaText").removeClass("escenarioSelect").addClass("escenarios");
                        $("#interseccionText").removeClass("escenarioSelect").addClass("escenarios");
                    }

                });
            })

            const listImg = document.querySelectorAll('img');
            listImg.forEach(img => {
                img.addEventListener('drag', (e) => {
                    e.preventDefault();


                    //   document
                    // .getElementById('container').style.display = 'block';
                    // console.log('Lo estas arrastrando');
                    // e.dataTransfer.setData('text/plain', e.target.id);
                });

                img.addEventListener('dragend', (e) => {
                    e.preventDefault();
                    if (layer.children.length > 0) {
                        $('#saveBtn').attr('disabled', false);
                    } else {
                        $('#saveBtn').attr('disabled', true);
                    }


                    // console.log('Lo soltaste ' + e.target.id);
                    // e.dataTransfer.setData('text/plain', e.target.id);
                });
            });

            canvas.addEventListener('dragover', (e) => {

                // console.log(e.offsetX, e.offsetY);
            });


            // KONVA
            let itemURL = '';
            document
                .getElementById('drag-items')
                .addEventListener('dragstart', e => {
                    itemURL = e.target.src;

                });

            const con = stage.container();
            con.addEventListener('dragover', e => {
                e.preventDefault(); // !important
            });

            con.addEventListener('drop', e => {
                e.preventDefault();
                stage.setPointersPositions(e);

                // layer.add(layer.children[0]);
                // layer.draw();


                Konva.Image.fromURL(itemURL, (image) => {
                    const base_path = "{{url('/')}}";

                    // lista de los posibles asegurados
                    const noRepeat = [base_path + '/images/siniestros/recursos_siniestros/iconos/auto_asegurado.png',
                        base_path + '/images/siniestros/recursos_siniestros/iconos/moto_asegurado.png']
                    layer.add(image);
                    // recopilo en el canvas la cantidad de asegurados
                    let asegurados = layer.children.filter(child => noRepeat.includes(child.attrs.image.src))

                    // analiZo la lista de asegurados y elimino los duplicados para agregar el nuevo
                    if (asegurados.length > 1) {
                        asegurados.forEach(asegurado => {
                            asegurado.remove();
                            layer.add(image);
                        })
                    }

                    image.position(stage.getPointerPosition());
                    image.draggable(true);
                });
            });

            document.getElementById("clearBtn").addEventListener("click", (e) => {
                e.preventDefault();
                layer.destroyChildren();
                $('#saveBtn').attr('disabled', true);
                if (document.getElementById("graficoBD") != null) {
                    document.getElementById("graficoBD").remove();
                    $.when($('graficoBD').remove()).then(document.getElementById("container").style.display = 'block');
                }
            });

            document.getElementById('saveBtn').addEventListener(
                'click',
                function (e) {
                    e.preventDefault();
                    document.getElementById('previewImg').innerHTML = "";

                    // do some drawing
                    //   $('#signature').empty();
                    //   var dataUrl = stage.toDataURL();
                    //   var img = $('<img>').attr('src', dataUrl);
                    //   document.getElementById('signature').style.backgroundImage = `url(${base_image.src})`;
                    //   document.getElementById('signature').style.backgroundRepeat = "no-repeat";
                    //   $('#signature').append(img);
                    html2canvas(document.getElementById("container")).then(function (canvas) {

                        let preview_img = document.getElementById("previewImg");
                        //  elem.empty();
                        let anchorTag = document.createElement("a");
                        document.body.appendChild(anchorTag);
                        preview_img.appendChild(canvas);
                        // canvas.style.backgroundImage = `url(${base_image.src})`;
                        ctx = canvas.getContext("2d");

                        var background = new Image();
                        background.src = base_image.src;

                        //console.log(canvas.toDataURL());

                        // Make sure the image is loaded first otherwise nothing will draw.
                        background.onload = function () {
                            ctx.drawImage(background, 0, 0);
                            url = '{{ route('asegurados-denuncias.storeCroquis') }}';
                            $.ajax({
                                type: 'POST',
                                url: url,
                                dataType: 'json',
                                data:
                                    {
                                        "_token": "{{ csrf_token() }}",
                                        "id": "{{ $denuncia_siniestro->id }}",
                                        "croquis": canvas.toDataURL()
                                    },
                                success: function (data) {
                                    //console.log(data);
                                    //console.log("Grafico seteado correctamente");
                                    preview_img.classList.remove("d-none")
                                },
                                error: function (data) {
                                    //console.log('ERROR: ', data);
                                    alert('Hubo un error.');
                                },
                            });
                        }

                    });

                },
                false
            );
            // KONVA


        });

    </script>

@endsection
