@if ($errors->has())
    <div class="row">
        <div class="span12">
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        </div>
    </div>
@endif
