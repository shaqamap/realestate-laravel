@extends('home.layouts.frame')
@section('title', 'Dashboard @ruma')
@section('description')

    <div class="form-group form-group-default form-group-default-select2 pull-right {{ $errors->has('id_location') ? 'has-error' : ''}}"
         style="width: 220px;margin-top: -30px;">
        {!! Form::label('id_location', "Lokasi") !!}
        {{ Form::select('id_location', $locations, null, ['class' => 'full-width', 'required' => 'required', 'data-init-plugin' => 'select2']) }}
    </div>
    @rumah management, <label class="kosong">Kosong</label> | <label class="akad">Akad</label> | <label class="isi">Terisi</label>


@endsection


@section('content')
    <div class="container-fluid container-fixed-lg">
        <div class="row">


            <div class="col-lg-12" id="so_do_you">
                {!! (count($blocks) == 0) ? '
                    <div class="panel panel-default">
                        <div class="panel-body" style="background: #FFF;">
                            <h5>Kosong</h5>
                        </div>
                    </div>' : '' !!}
                @foreach($blocks as $block)
                    <div class="panel panel-default">
                        <div class="panel-body" style="background: #FFF;">
                            <h5>Perumahan {{ $block->location->name }} | Blok, {{ $block->name }},
                                <small class="pull-right m-t-10">
                                    Jumlah: <b>{{ count($block->houses) }}</b> |
                                    Terisi: <b>{{ count($block->housesIsi) }}</b> |
                                    Akad: <b>{{ count($block->housesAkad) }}</b> |
                                    Kosong: <b>{{ count($block->housesKosong) }}</b>
                                </small></h5>
                            <hr/>
                            <div>
                                <div class="row m-t-20">
                                    @foreach($block->houses as $house)
                                        <div class="col-xs-4 col-md-1 col-sm-2 text-center">
                                            <a >
                                                <div class="wrap {{ $house->status }}" style="color: #101010;">
                                                    <div class="col-xs-4 indicator {{ ($house->indicator_satu == '1') ? "done" : '' }}"></div>
                                                    <div class="col-xs-4 indicator {{ ($house->indicator_dua == '1') ? "done" : '' }}"></div>
                                                    <div class="col-xs-4 indicator {{ ($house->indicator_tiga == '1') ? "done" : '' }}"></div>
                                                    <h5>
                                                        <a class="btn btn-default btn-xs fs-12" >{{ $house->number }}</a>
                                                    </h5>
                                                    <label>{{ ucwords($house->status) }}</label>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <input type="hidden" id="deleteID"/>
@endsection


@push('script')
<script type="text/javascript">

    $(document).ajaxStart(function() { Pace.restart(); });

    $(document).ready(function() {

        $('#id_location').on('change', function (e) {
            var id = $("#id_location option:selected").val();
            $.ajax({
                url: '{{url("dashboard")}}' + "/" + id + '?' + $.param({"_token" : '{{ csrf_token() }}' }),
                type: 'GET',
                complete: function(data) {
                    $("#so_do_you").html(data.responseText);
                }
            });
        });

    });

</script>
@endpush
