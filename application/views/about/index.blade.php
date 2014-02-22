@layout('layout.master')

@section('container')

<div class="row">
    <div class="span12">

        <h4>About</h4>
        <b>Version:</b> {{ e($version) }}, <b>Build:</b> {{ e($timestamp) }}

    </div>

</div>

@endsection
