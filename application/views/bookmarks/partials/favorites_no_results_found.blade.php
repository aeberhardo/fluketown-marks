<div class="row">
    <div class="span12">
        <div class="alert alert-info">
            @if (Input::has('t'))
                Sorry, no favorites found for tag <b>{{ e(Input::get('t')) }}</b>.
            @else
                You don't have any favorites yet.
            @endif
        </div>
    </div>
</div>
