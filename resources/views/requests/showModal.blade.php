<!-- Modal -->
@foreach ($suppliers as $supplier)

    <div class="modal fade" id="{{'modal-supplier-'.$supplier['id']}}" tabindex="-1" aria-labelledby="{{'modal-supplier-'.$supplier['id']}}-label" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header">
                <h5 class="modal-title" id="{{'modal-supplier-'.$supplier['id']}}-label">Datos del Postulante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body container">
                <!--Avatar-->
                <div class="row w-100 pb-3">
                    <div class="col-12 center-wrapper">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar7.png" height="70">
                    </div>
                </div>
                <!--Datos Personales-->
                <div class="row w-100">
                    <div class="col-12">
                        <h5>Datos Personales</h5>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Nombre</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{$supplier['name'].' '.$supplier['first_last_name'].' '.$supplier['second_last_name']}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Fecha de Nacimiento</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{$supplier['birth_date']}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Doc. Id.</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{$supplier['id_num'].' '.'('.$supplier['id_type'].')'}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Teléfono</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{$supplier['phone']}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Domicilio</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{$supplier['home_address']}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Datos Profesionales-->
                <div class="row w-100">
                    <div class="col-12">
                        <h5>Datos Profesionales</h5>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Profesión</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{implode(', ',$supplier['professions'])}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Experiencia</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{$supplier['experience']}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Dirección Laboral</label>
                            <div class="col-sm-9 input-group-append">
                                <input name="" type=text value="{{$supplier['work_address']}}" class="form-control-plaintext" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Datos Servicios-->
                <div class="row w-100">
                    <div class="col-12">
                        <h5>Servicios Prestados</h5>
                        @foreach ($supplies as $supply_group)
                            @foreach ($supply_group as $supplier_id => $supplier_supplies)
                                @if ($supplier['id']==$supplier_id)
                                    @foreach ($supplier_supplies as $num => $supply)
                                        @foreach ($services as $ser_num => $service)
                                            @if ($service['id']==$supply['service_id']) <h6 class="pt-3">{{$service['name']}}</h6> @endif
                                        @endforeach
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Precio</label>
                                            <div class="col-sm-9 input-group-append">
                                                <input name="" type=text value="{{$supply['price']}}" class="form-control-plaintext" readonly>
                                            </div>
                                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Descripción</label>
                                            <div class="col-sm-9 input-group-append">
                                                <input name="" type=text value="{{$supply['description']}}" class="form-control-plaintext" readonly>
                                            </div>
                                            <label class="col-sm-3 col-form-label text-right font-weight-bold">Horarios</label>
                                            <div class="col-sm-9 input-group-append">
                                                <ul>
                                                @foreach ($schedules as $sch_num => $schedule)
                                                    @if(in_array($schedule['id'], $supply['schedules'])) <li>{{$schedule['week_day'].', '.$schedule['start'].'-'.$schedule['end']}}</li> @endif
                                                @endforeach
                                                <ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </div>
    </div>

@endforeach


