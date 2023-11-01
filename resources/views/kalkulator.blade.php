@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kalkulator') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> <br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('kalkulasi') }}" method="POST" >
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Jenis Sampah:</strong>
                                <select name="jenis" class="custom-select">
                                    <option selected>Choose...</option>
                                    @foreach($sampah as $s)
                                        <option value="{{ $s->harga }}">{{ $s->nama .' | ' .$s->harga }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jumlah:</strong>
                                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah per kilo">
                                </div>
                            </div>

                            @if (session('total'))
                                <div class="alert alert-success" role="alert">
                                    {{ 'Total = ' . "Rp " . number_format(session('total'),2,',','.') }}
                                </div>
                            @endif
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center p-4">
                                <button type="submit" class="btn btn-success ">Kalkulasi</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
