@layout('layout.master')

@section('container')

    @include('alert.partials.errors_first')

    <div class="row">
        <div class="span6">
            <div class="well">

                {{ Form::open('bookmarks/update/' . $id, 'POST') }}

                    <div class="control-group">
                        <div class="controls">
                            <h4><i class="icon-edit"></i> Edit flukemark<a class="btn btn-mini btn-danger pull-right" data-target="#deleteBookmarkModal" data-toggle="modal"><i class="icon-remove icon-white"></i> Delete</a></h4>
                            <hr/>
                        </div>
                    </div>

                    @include('bookmarks.partials.bookmark_form_content')
                    
                    {{ $urlManagerForUpdate->toHTML() }}
                    
                    <div class="control-group">
                        <div class="controls">
                            {{ Form::button('Save', array('class' => 'btn btn-primary', 'type' => 'submit')) }} {{ HTML::link($urlManagerForUpdate->onCancel, 'Cancel', array('class' => 'btn')) }}
                        </div>
                    </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>

    <div id="deleteBookmarkModal" class="modal hide fade" tabindex="-1" role="dialog">
        <div class="modal-header">
            {{ Form::button('&times;', array('class' => 'close', 'type' => 'button', 'data-dismiss' => 'modal')) }}
            <br/>
        </div>
        <div class="modal-body">
            <center><p>Really delete this flukemark?</p></center>
        </div>
        <div class="modal-footer">
            <center>
                {{ Form::open('bookmarks/destroy/'. $id, 'POST', array('class' => 'no-margins')) }}
                    {{ Form::button('Yes', array('class' => 'btn btn-danger', 'type' => 'submit')) }}
                    {{ Form::button('No', array('class' => 'btn', 'type' => 'button', 'data-dismiss' => 'modal')) }}
                    {{ $urlManagerForDestroy->toHTML() }}
                {{ Form::close() }}
            </center>
        </div>
    </div>

@endsection

@section('javascript')
    @render('bookmarks.partials.bookmark_form_js')
@endsection