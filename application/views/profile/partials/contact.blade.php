<div class="row">
    <div class="span6">

        <div class="well">
            {{ Form::open('profile/update_contact', 'POST') }}
                <div class="control-group">
                    <div class="controls">
                        <h4><i class="icon-envelope-alt"></i> Contact Data</h4>
                        <hr/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="email">Email<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::text('email', $email, array('class' => 'input-block-level', 'placeholder' => 'Email', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        {{ Form::button('Save', array('class' => 'btn btn-primary', 'type' => 'submit')) }} {{ HTML::link(URL::home(), 'Cancel', array('class' => 'btn')) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
