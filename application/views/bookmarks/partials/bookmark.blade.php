<?php
 use ch\aeberhardo\html\HTMLFavicon;
 use ch\aeberhardo\url\URLHelper;
 use ch\aeberhardo\url\ThumbnailURLHelper;
 ?>

        <div class="media">

            <!-- Grosses Thumbnail nicht anzeigen bei Phone. -->
            <div class="hidden-phone">
                <a class="pull-left thumbnail bookmark-thumbnail" href="{{ $bookmark->url }}">
                    <img class="media-object" src="{{ ThumbnailURLHelper::to_thumbnail($bookmark->id) }}">
                </a>
            </div>

            <div class="media-body">
                <div class="highlightable">
                    <h4 class="media-heading">{{ e($bookmark->title) }}</h4>

                    <div class="ellipsis">
                        {{ HTMLFavicon::faviconImage($bookmark->url) }}
                        {{ HTML::link($bookmark->url, $bookmark->url) }}
                    </div>

                    <br class="hidden-phone"/>

                    {{ e($bookmark->description) }}<br/>

                    <br class="hidden-phone"/>
                </div>
                <span class="pull-left">
                    <i class="icon-tags"></i>

                    @if ($bookmark->favorite)
                    <a href="{{ URL::to_action('bookmarks@favorites') }}"><span class="label label-warning"><i class="icon-star"></i></span></a>
                    @endif
                    
                    @foreach ($bookmark->tags() as $tag)
                        <a href="{{ URLHelper::to_action_with_query_string('bookmarks@tags', array('t' => $tag->name)) }}"><span class="label label-info">{{ e($tag->name) }}</span></a>
                    @endforeach
                    | <i class="icon-calendar"></i> {{ date('Y-m-d', strtotime($bookmark->created_at)) }}
                    | {{ HTML::link_to_action('bookmarks@edit', 'edit', array($bookmark->id)) }}
                </span>

            </div>

        </div>      

        <hr/>
