@layout('layout.master')

@section('container')

    @include('alert.partials.errors_first')
    @include('alert.partials.success')

    @include('profile.partials.contact')
    @include('profile.partials.password')

@endsection
