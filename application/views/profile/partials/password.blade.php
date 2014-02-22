<div class="row">
    <div class="span6">
        <div class="well">
            {{ Form::open('profile/update_password', 'POST') }}
                <div class="control-group">
                    <div class="controls">
                        <h4><i class="icon-lock"></i> Password</h4>
                        <hr/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="current_password">Current Password<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::password('current_password', array('class' => 'input-block-level', 'placeholder' => 'Current Password', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="password">New Password<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::password('new_password', array('class' => 'input-block-level', 'placeholder' => 'New Password', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="password_confirmation">Re-enter new Password<span class="mandatory"> *</span></label>
                    <div class="controls">
                        {{ Form::password('new_password_confirmation', array('class' => 'input-block-level', 'placeholder' => 'Re-enter new Password', 'autocapitalize' => 'off', 'required')) }}
                    </div>
                </div>            

                <div class="control-group">
                    <div class="controls">
                        {{ Form::button('Change Password', array('class' => 'btn btn-primary', 'type' => 'submit')) }} {{ HTML::link(URL::home(), 'Cancel', array('class' => 'btn')) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>

    </div>
</div>
