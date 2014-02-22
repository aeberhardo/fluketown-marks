<?php

use ch\aeberhardo\html\HTMLFavicon;
use ch\aeberhardo\url\URLHelper;
use ch\aeberhardo\url\ThumbnailURLHelper;
?>

<div class="span3">

    <div class="well well-transparent">
        <div class="ellipsis">
            <b>{{ e($bookmark->title) }}</b>
        </div>

        <div class="hidden-phone ellipsis">
            {{ HTML::link($bookmark->url, $bookmark->url) }}
        </div>

        <div class="visible-phone ellipsis">
            {{ HTMLFavicon::faviconImage($bookmark->url) }}
            {{ HTML::link($bookmark->url, $bookmark->url) }}
        </div>

        <div class="hidden-phone">
            <br/>
            {{ HTMLFavicon::faviconImage($bookmark->url) }}
            <span class="pull-right"><i class="icon-edit"></i> {{ HTML::link_to_action('bookmarks@edit', 'edit', array($bookmark->id)) }}</span>
        </div>

    </div>

</div>
