<div class="row">
    <div class="span12">
        <div class="alert alert-info">
            @if (Input::has('t'))
                Sorry, no results found for tag <b>{{ e(Input::get('t')) }}</b>.
            @else
                Sorry, no results found.
            @endif
        </div>
    </div>
</div>
