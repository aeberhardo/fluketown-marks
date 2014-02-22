<div class="control-group">
    <label class="control-label" for="username">Username<span class="mandatory"> *</span></label>
    <div class="controls">
        {{ Form::text('username', $username, array('class' => 'input-block-level', 'placeholder' => 'Username', 'autocapitalize' => 'off', 'required')) }}
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="password">Password<span class="mandatory"> *</span></label>
    <div class="controls">
        {{ Form::password('password', array('class' => 'input-block-level', 'placeholder' => 'Password', 'autocapitalize' => 'off', 'required')) }}
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <label class="checkbox">
            {{ Form::checkbox('remember', 1, false, array()) }} Keep me logged in
        </label>
    </div>
</div>

<br/>

<div class="control-group">
    <div class="controls">
        {{ Form::button('Log In', array('class' => 'btn btn-primary', 'type' => 'submit')) }}
    </div>
</div>
