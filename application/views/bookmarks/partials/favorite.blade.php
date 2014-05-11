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

        <div>
            <div class="pull-right">&nbsp;&nbsp;<i class="icon-edit"></i> {{ HTML::link_to_action('bookmarks@edit', 'edit', array($bookmark->id)) }}</div> <div class="ellipsis">{{ HTMLFavicon::faviconImage($bookmark->url) }} {{ HTML::link($bookmark->url, $bookmark->url) }}</div>
        </div>

    </div>

</div>
