@layout('layout.master')

@section('container')

@include('alert.partials.errors_first')

<div class="row">

    <div class="span5">
        <div class="well">

            {{ Form::open('auth/signup', 'POST') }}

                <div class="control-group">
                    <div class="controls">
                        <h4><i class="icon-hand-right"></i> Sign Up</h4>
                        <hr/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="username">Username<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::text('username', $username, array('class' => 'input-block-level', 'placeholder' => 'Username', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">Email<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::text('email', $email, array('class' => 'input-block-level', 'placeholder' => 'Email', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="password">Password<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::password('password', array('class' => 'input-block-level', 'placeholder' => 'Password', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="password_confirmation">Re-enter Password<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::password('password_confirmation', array('class' => 'input-block-level', 'placeholder' => 'Re-enter Password', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>

                <br/>
            
                <div class="control-group">
                    <div class="controls">
                        {{ Form::button('Sign Up', array('class' => 'btn btn-primary', 'type' => 'submit')) }} {{ HTML::link(URL::home(), 'Cancel', array('class' => 'btn')) }}
                    </div>
                </div>

            {{ Form::close() }}

        </div>
    </div>
</div>

@endsection
