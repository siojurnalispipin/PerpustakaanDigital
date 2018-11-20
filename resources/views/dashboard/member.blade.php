@extends('layouts.app')

@section('dashboard')
    Dashboard
    <small>Member</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <!-- Welcome -->
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-success">
              <h4>Selamat Datang di Perpusstakaan Digital</h4>

              <p>Aplikasi perpustakaan digital dengan DRM System dengan sistem rekomendasi MFCM berbasis mobile dan web</p>
              
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Buku Dipinjam</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    Selamat datang di Larabuk

                    <table class="table table-striped table-hovered">
                        <tr>
                            <td class="text-muted">Buku dipinjam</td>
                            <td>
                                @if ($borrowLogs->count() == 0)
                                    Tidak ada buku dipinjam
                                @endif
                                <ul>
                                    @foreach ($borrowLogs as $borrowLog)
                                        <li>
                                            {!! Form::open(['url' => route('member.books.return', $borrowLog->book_id), 'method' => 'put', 'class' => 'form-inline js-confirm', 'data-confirm' => "Anda yakin hendak mengembalikan " . $borrowLog->book->title . "?"]) !!}

                                            {!! $borrowLog->book->title !!}
                                            {!! Form::submit('Kembalikan', ['class' => 'btn btn-default']) !!}

                                            {!! Form::close() !!}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
