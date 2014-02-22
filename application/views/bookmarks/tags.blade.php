@layout('layout.master')

@section('container')

    @if ($bookmarks->total > 0)
        <div class="row">
            <div class="span9">
                {{ render_each('bookmarks.partials.bookmark', $bookmarks->results, 'bookmark') }}
            </div>
            <div class="span3">
                @include('bookmarks.partials.tags_related')
            </div>
        </div>
    @else
        @include('bookmarks.partials.tags_no_results_found')
    @endif

    <div class="row">
        <div class="span12">
            {{ $bookmarks->appends(Input::only(array('t')))->links(2) }}
            <br/>
        </div>
    </div>

@endsection
