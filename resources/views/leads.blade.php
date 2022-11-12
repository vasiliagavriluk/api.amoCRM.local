@extends('layouts.app')
@section('content')
<section class="col-lg-12 connectedSortable ui-sortable">

    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">Список сделок</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">НАЗВАНИЕ СДЕЛКИ</th>
                    <th scope="col">БЮДЖЕТ, ₽</th>
                    <th scope="col">ОТВЕТСТВЕННЫЙ</th>
                    <th scope="col">ЭТАП СДЕЛКИ</th>
                    <th scope="col">КОМПАНИЯ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($item as $items)
                    <tr>
                        <th scope="col">{{ $items->leads_id }}</th>
                        <th scope="col">{{ $items->name }}</th>
                        <th scope="col">{{ $items->price }}</th>
                        <th scope="col">{{ $items->users[0]->name }}</th>
                        <th scope="col">{{ $items->statuses[0]->name }}</th>
                        <th scope="col">{{ $items->companies[0]->name }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/.direct-chat -->

</section>
@endsection
