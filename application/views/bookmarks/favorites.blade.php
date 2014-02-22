@layout('layout.master')

@section('container')

    @if ($bookmarks->total > 0)
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="span9">
                        <div class="row">
                            {{ render_each('bookmarks.partials.favorite', $bookmarks->results, 'bookmark') }}
                        </div>
                    </div>
                    <div class="span3">
                        @include('bookmarks.partials.tags_favorite')
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('bookmarks.partials.favorites_no_results_found')
    @endif

    <div class="row">
        <div class="span12">
            {{ $bookmarks->appends(Input::only(array('t')))->links(2) }}
            <br/>
        </div>
    </div>

@endsection
