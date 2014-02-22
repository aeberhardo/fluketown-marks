<?php
use ch\aeberhardo\url\TagURLHelper;
?>

<div class="well">
    <h5>FAVORITE TAGS</h5>
    @forelse($favoriteTagCounts as $favoriteTagCount)
        <div>
            <a style="vertical-align: middle;" href="{{ TagURLHelper::to_action('bookmarks@favorites', $favoriteTagCount->name) }}"><span class="label label-warning">{{ e($favoriteTagCount->name) }}</span></a> {{ e($favoriteTagCount->count) }}
        </div>
    @empty
        No related tags
    @endforelse
</div>