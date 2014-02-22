<div class="row">
    <div class="span12">
        <div class="alert alert-info">
            @if (Input::has('q'))
                Sorry, no results found for <b>{{ e(Input::get('q')) }}</b>.
            @else
                Sorry, no results found.
            @endif
        </div>
    </div>
</div>
