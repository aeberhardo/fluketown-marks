<div class="control-group">
    <label class="control-label" for="url">URL<span class="mandatory"> *</span></label>
    <div class="controls">
        {{ Form::text('url', $url, array('class' => 'input-block-level', 'placeholder' => 'URL', 'autocapitalize' => 'off', 'required')) }}
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="title">Title<span class="mandatory"> *</span></label>
    <div class="controls">
        {{ Form::text('title', $title, array('class' => 'input-block-level', 'placeholder' => 'Title', 'required')) }}
    </div>
</div>

<div class="control-group">
    {{ Form::label('description', 'Description', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('description', $description, array('class' => 'input-block-level', 'placeholder' => 'Description')) }}
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="tags">Tags<span class="help-inline" rel="tooltip" title="Comma-separated"><i class="icon-question-sign cursor-default"></i></span></label>
    <div class="controls">
        {{ Form::text('tags', $tags, array('class' => 'input-block-level', 'placeholder' => 'Tags', 'autocapitalize' => 'off')) }}
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <label class="checkbox">
            {{ Form::checkbox('favorite', 1, $favorite) }} Add to favorites
        </label>
    </div>
</div>

<br/>