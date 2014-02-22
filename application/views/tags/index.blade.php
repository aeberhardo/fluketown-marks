@layout('layout.master')

<?php

use ch\aeberhardo\url\TagURLHelper;
?>

@section('container')

    @if (count($tagCounts) > 0)
        <div class="row">
            <div class="span6">
                <div class="well">

                    <h4><i class="icon-tags"></i> Tags</h4>
                    <hr/>

                    @foreach($tagCounts as $tagCount)
                        <a href="{{ TagURLHelper::to_action('bookmarks@tags', $tagCount->name) }}"><span class="label label-info">{{ e($tagCount->name) }}</span></a> {{ e($tagCount->count) }}
                        <br/>
                    @endforeach

                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="span12">
                <div class="alert alert-info">
                    You haven't added any tags yet.
                </div>
            </div>
        </div>
    @endif

@endsection
