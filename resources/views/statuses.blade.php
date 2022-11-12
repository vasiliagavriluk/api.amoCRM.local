@extends('layouts.app')
@section('content')
<section class="col-lg-12 connectedSortable ui-sortable">
    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">Статусы</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">НАЗВАНИЕ</th>
                    <th scope="col">ЦВЕТ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($item as $items)
                    <tr>
                        <th scope="col">{{ $items->statuses_id }}</th>
                        <th scope="col">{{ $items->name }}</th>
                        <th scope="col"> <div style="width: 16px; height: 16px; background:{{ $items->color }}"></div></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/.direct-chat -->

</section>
@endsection
