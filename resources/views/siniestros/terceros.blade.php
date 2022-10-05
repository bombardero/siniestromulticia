@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="pt-5 text-center es-muy-facil">Estamos para <strong class="facil">asistirte</strong></h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-10 offset-md-1 px-0 pb-5">
            @livewire('siniestro.form-terceros')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            IMask(
                document.getElementById('dominio'),
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
                document.getElementById('dominio_asegurado'),
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
                document.getElementById('telefono'),
                {
                    mask: '0000000000'
                });
            IMask(
                document.getElementById('telefono_confirmation'),
                {
                    mask: '0000000000'
                });
        })
    </script>

@endsection
