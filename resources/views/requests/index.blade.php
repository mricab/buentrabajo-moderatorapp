@extends('app')

@section('content')

    <!-- Options -->
    <div class="row mb-3">
        <div class="col-12">
            <!--Reset-->
            <a type="button" class="btn btn-dark float-left  ml-2" href="/request/index"><i class="ri-restart-line"></i></a>
            <!--Search-->
            <a type="button" class="btn btn-dark float-left  ml-2" data-toggle="collapse" data-target="#collapsableQueryBuilder"><i class="ri-search-line"></i></a>
        </div>
    </div>


    <!-- Query builder -->
    <div id="collapsableQueryBuilder" class="row collapse">
        <div class="col-12 py-4" style="background-color: lightSteelBlue">
            <form method="GET" action="/jobs">
                @csrf

                <!--Query Flag-->
                <input name="queryFlag" type="text" class="d-none" value="1">

                <!--Buttons-->
                <div class="row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="ri-search-line"></i> Buscar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!-- Query results -->
    <div class="row mt-3">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha de Solicitud</th>
                        <th>Nombre</th>
                        <th>Profesion</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $supplier)
                    <tr>
                        <td>{{$supplier['request_date']}}</td>
                        <td>{{$supplier['name'].' '.$supplier['first_last_name']}}</td>
                        <td>{{$supplier['profession']}}</td>
                        @if ($supplier['request_state']=='Pendiente')
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="{{'#modal-ot'.'$job->id'}}"><i class="ri-check-line"></i></button>
                            <button type="button" class="btn btn-danger  btn-sm" data-toggle="modal" data-target="{{'#modal-ot'.'$job->id'}}"><i class="ri-close-line"></i></button>
                        </td>
                        @else
                        <td>{{$supplier['request_state']}}</td>
                        @endif
                        <td><button type="button" class="btn btn-dark    btn-sm" data-toggle="modal" data-target="#{{'modal-supplier-'.$supplier['id']}}"><i class="ri-eye-line"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="row">
        <div class="col-12">
            <form method="GET" action="/jobs" class="m-0">
                @csrf
            </form>
        </div>
    </div>

    <!-- Modals -->
    @include('requests.showModal')

@endsection
