@extends('app')

@section('content')

    <!-- Options -->
    <div class="row mb-3">
        <div class="col-12">
            <!--Reset-->
            <a type="button" class="btn btn-dark float-left  ml-2" href="/requests/index"><i class="ri-restart-line"></i></a>
            <!--Search-->
            <a type="button" class="btn btn-dark float-left  ml-2" data-toggle="collapse" data-target="#collapsableQueryBuilder"><i class="ri-search-line"></i></a>
        </div>
    </div>


    <!-- Query builder -->
    <div id="collapsableQueryBuilder" class="row collapse">
        <div class="col-12 py-4" style="background-color: lightSteelBlue">
            <form method="POST" action="/requests/index">
                @csrf

                <!--Type-->
                <div class="form-group row">
                    <label for="IDENTIFICADOR1" class="col-sm-2 col-form-label text-right font-weight-bold">Estado</label>
                    <div class="col-sm-10">
                        <select name="selTypes[]" id="IDENTIFICADOR1" class="form-control custom-select-sm" multiple size="3" aria-describedby="ID1-HELP">
                            @foreach ($types as $type)
                                <option value={{$type}} @if(in_array($type, (old('selTypes') ?? session('types')))) selected @endif>{{$type}}</option>
                            @endforeach
                        </select>
                        <small id="ID1-HELP" class="form-text text-muted">Seleccione más de una opción con Ctrl (Pc) o Cmd (Mac).</small>
                    </div>
                </div>

                <!--Dates-->
                <div class="form-group row">
                    <label for="selStart" class="col-sm-2 col-form-label text-right font-weight-bold">Rango de Fechas</label>
                    <div class="col-sm-5 input-group-append">
                        <input id="selStart" name="selStart" type="date" value="{{old('selStart') ?? session('start')}}" min="{{$dates_range['min']}}" max="{{$dates_range['max']}}" class="form-control @error('selStart') is-invalid @enderror">
                    </div>
                    @error('selStart')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    <div class="col-sm-5 input-group-append">
                        <input id="selEnd"   name="selEnd"   type="date" value="{{old('selEnd') ?? session('end')}}" min="{{$dates_range['min']}}" max="{{$dates_range['max']}}" class="form-control @error('selEnd') is-invalid @enderror">
                    </div>
                    @error('selEnd')  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>

                <!--Pages-->
                <div class="form-group row">
                    <label for="IDENTIFICADOR2" class="col-sm-2 col-form-label text-right font-weight-bold">Elementos</label>
                    <div class="col-sm-10">
                        <input type="number" name="elements" value={{old('elements') ?? session('elements')}} class="form-control">
                    </div>
                </div>

                <!--Buttons-->
                <div class="row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary"><i class="ri-search-line"></i> Buscar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if(Session::has('message'))
                <div class="alert alert-danger">
                    {{Session::get('message')}}
                </div>
            @endif
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
                            <form method="POST" action="/requests/accept" class="d-inline-block">
                                @csrf
                                <input name="supplier_id" type="text" class="d-none" value="{{$supplier['id']}}">
                                <button type="submit" class="btn btn-success btn-sm"><i class="ri-check-line"></i></button>
                            </form>
                            <form method="POST" action="/requests/reject" class="d-inline-block">
                                @csrf
                                <input name="supplier_id" type="text" class="d-none" value="{{$supplier['id']}}">
                                <button type="submit" class="btn btn-danger  btn-sm"><i class="ri-close-line"></i></button>
                            </form>
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
            <form method="POST" action="/requests/index" class="m-0">
                @csrf
                <select class="d-none" name="selTypes[]" multiple> @foreach ($types as $type) <option value={{$type}} @if(in_array($type, session('types'))) selected @endif>{{$type}}</option> @endforeach </select>
                <input  class="d-none" name="selStart" type="date" value="{{session('start')}}">
                <input  class="d-none" name="selEnd" type="date" value="{{session('end')}}">
                <input  class="d-none" name="elements" type="number" value={{old('elements') ?? session('elements')}}>
                <nav aria-label="Index-Navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item @if ($currentPage<1) disabled @endif">
                            <button type="submit" class="page-link" name="page" value="{{$currentPage-1}}">Anterior</button>
                        </li>
                        <li class="page-item @if ($currentPage==$pages-1) disabled @endif">
                            <button type="submit" class="page-link" name="page" value="{{$currentPage+1}}">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </form>
        </div>
    </div>

    <!-- Modals -->
    @include('requests.showModal')

@endsection
