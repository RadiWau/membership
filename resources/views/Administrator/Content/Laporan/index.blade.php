@extends('Administrator.app')

@push('custom-css')


@endpush

@section('title','Data Laporan')

@section('content')
    COMING SOON
@endsection

@push('custom-script')
    <script>
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token()}}"
                }
        });

    </script>
@endpush
