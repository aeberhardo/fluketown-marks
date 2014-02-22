@layout('layout.master')

<?php 
use \ch\aeberhardo\html\SearchHighlight;
?>

@section('container')

    @if ($bookmarks->total > 0)
        <div class="row">
            <div class="span12">
                {{ render_each('bookmarks.partials.bookmark', $bookmarks->results, 'bookmark') }}
            </div>
        </div>
    @else
        @include('bookmarks.partials.search_no_results_found')
    @endif

    <div class="row">
        <div class="span12">
            {{ $bookmarks->appends(Input::only(array('q')))->links(2) }}
            <br/>
        </div>
    </div>

@endsection

@section('javascript')

    @if (Input::has('q'))

        {{ Asset::container('jquery.highlight')->scripts() }}
        <script type="text/javascript">
            $(document).ready(function(){  
                $(".highlightable").highlight(<?php echo SearchHighlight::toJson(Input::get('q')) ?>);
            });  
        </script>

    @endif

@endsection
