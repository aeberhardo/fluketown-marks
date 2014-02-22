@layout('layout.master')

@section('container')

    @if ($bookmarks->total > 0)
        <div class="row">
            <div class="span12">
                {{ render_each('bookmarks.partials.bookmark', $bookmarks->results, 'bookmark') }}
            </div>
        </div>
    @else
        @include('bookmarks.partials.index_no_results_found')
    @endif

    <div class="row">
        <div class="span12">
            {{ $bookmarks->links(2) }}
            <br/>
        </div>
    </div>

@endsection
