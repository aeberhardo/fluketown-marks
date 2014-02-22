<?php
use ch\aeberhardo\url\TagURLHelper;
?>

<div class="well">
    <h5>SELECTED TAGS</h5>
    @foreach($searchTags as $searchTag)
        <div>
            @if (count($searchTags) > 1)
            <a style="vertical-align: middle;" href="{{ TagURLHelper::to_action_removing_tag('bookmarks@tags', Input::get('t'), $searchTag) }}" class="btn btn-mini"><i class="icon-minus"></i></a>
            @endif
            <a style="vertical-align: middle;" href="{{ TagURLHelper::to_action('bookmarks@tags', $searchTag) }}"><span class="label label-info">{{ e($searchTag) }}</span></a>
        </div>
    @endforeach
    
    <br/>
    
    <h5>RELATED TAGS</h5>
    @forelse($relatedTagCounts as $relatedTagCount)
        <div>
            <a style="vertical-align: middle;" href="{{ TagURLHelper::to_action_adding_tag('bookmarks@tags', Input::get('t'), $relatedTagCount->name) }}" class="btn btn-mini"><i class="icon-plus"></i></a>
            <a style="vertical-align: middle;" href="{{ TagURLHelper::to_action('bookmarks@tags', $relatedTagCount->name) }}"><span class="label label-info">{{ e($relatedTagCount->name) }}</span></a> {{ e($relatedTagCount->count) }}
        </div>
    @empty
        No related tags
    @endforelse
</div>