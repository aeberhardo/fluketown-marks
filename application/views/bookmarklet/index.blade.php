@layout('layout.master')

@section('container')

<?php

use ch\aeberhardo\bookmarklet\Bookmarklet;
?>

<div class="row">
    <div class="span12">

        <h4>Bookmarklet</h4>

        <h5>Desktop</h5>

        Drag the following bookmarklet to your browser's bookmarks and click it whenever you want to add the page you are on to fluketown|marks:
        <a class="label" href="{{ Bookmarklet::get() }}">Add flukemark</a>
        <br/>
        <br/>

        <h5>Mobile</h5>
        <ol>
            <li><b>Create a new bookmark:</b> Open this page in Safari on your iPad, iPhone or iPod Touch, and then tap the <i class="icon-share"></i> symbol. Choose "Add Bookmark".</li>
            <li><b>Copy the javascript code on this page:</b> Select all the javascript code below and copy it to the clipboard.</li>
            <li><b>Edit the new bookmark (to turn it into a bookmarklet):</b> Open your bookmarks, scroll to the bookmark you made in Step 1, tap the "Edit" button and select it. Delete the title and URL contents, then retitle it and paste the code (which you copied in Step 2) into the URL field. Hit "Done" when finished.</li>
        </ol>

        Javascript code:<br/>
        {{ Form::textarea('bookmarklet', Bookmarklet::get(), array( 'class' => 'span6')) }}

    </div>

</div>

@endsection
