@layout('layout.popup_master')

@section('container')

@include('alert.partials.errors_first')

    <div class="row">
        <div class="offset3 span6">
            <div class="well">

                {{ Form::open('auth/login', 'POST') }}

                    <div class="control-group">
                        <div class="controls">
                            <h4>Login</h4>
                            <hr/>
                        </div>
                    </div>

                    @include('auth.partials.login_form_content')
                    
                    {{ $urlManagerForLogin->toHTML() }}

                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
