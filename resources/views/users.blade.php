@extends('layouts.app')
@section('content')
<section class="col-lg-12 connectedSortable ui-sortable">

    <!-- DIRECT CHAT -->
    <div class="card direct-chat direct-chat-primary">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">Список пользователей</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Фамилия Имя</th>
                    <th scope="col">Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($item as $items)
                    <tr>
                        <th scope="col">{{ $items->name }}</th>
                        <th scope="col">{{ $items->email }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/.direct-chat -->

</section>
@endsection
