@extends('...app')
@section('content')
    <div class="container-fluid">
        <a href="javascript:" id="return-to-top"><i class="icon-chevron-up"></i></a>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-offset-2">
                    <h1 class="title">{{Lang::get('participation_overview.title')}}</h1>
                </div>
                <br>
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-xs-12 col-sm-6 col-lg-5 col-lg-offset-3">
                        @include('participations.filter', ['years' => $years, 'distances' => $distances])
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <a href="{{url('csv/export/participations')}}" class="btn btn-sm btn-dark pull-right"><span class="glyphicon glyphicon-floppy-save"></span> {{Lang::get('buttons.exportbtn')}}</a>
                    </div>
                </div>
                <div id="table" class="table-responsive">
                    @include('participations.table', ['participations' => $participations])
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    {!! Html::script('/javascript/jquery.tablesorter.js') !!}
    {!! Html::script('/javascript/slider.js')!!}
    {!! Html::script('/javascript/filterAjax.js') !!}
    {!! Html::script('/javascript/scrollToTop.js') !!}
@endsection