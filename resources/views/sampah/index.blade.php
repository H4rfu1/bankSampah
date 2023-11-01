@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Management Sampah</h2>
                </div>
                <div class="pull-right pb-4">
                    <a class="btn btn-success" href="{{ route('sampah.create') }}"> Create New Sampah</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th width="280px">Action</th>
            </tr>
            @if(! empty($sampah->items()))
                @foreach ($sampah as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ "Rp " .  number_format($s->harga,2,',','.') }}</td>
                    <td>
                        <form action="{{ route('sampah.destroy',$s->id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('sampah.show',$s->id) }}">Detail</a>

                            <a class="btn btn-warning" href="{{ route('sampah.edit',$s->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                {{ 'No Data' }}
            @endif
        </table>

        {!! $sampah->links() !!}
    </div>
@endsection
