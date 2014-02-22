@layout('layout.master')

@section('container')

    @include('alert.partials.errors_first')

    <div class="row">
        <div class="span6">
            <div class="well">

                {{ Form::open('bookmarks/create', 'POST') }}

                    <div class="control-group">
                        <div class="controls">
                            <h4><i class="icon-plus"></i> Add flukemark</h4>
                            <hr/>
                        </div>
                    </div>

                    @include('bookmarks.partials.bookmark_form_content')
                    
                    {{ $urlManagerForCreate->toHTML() }}
                    
                    <div class="control-group">
                        <div class="controls">
                            {{ Form::button('Save', array('class' => 'btn btn-primary', 'type' => 'submit')) }} {{ HTML::link($urlManagerForCreate->onCancel, 'Cancel', array('class' => 'btn')) }}
                        </div>
                    </div>

                {{ Form::close() }}
                
                Use the bookmarklet to quickly add flukemarks. Click {{ HTML::link_to_action('bookmarklet', 'here') }} to see how.

            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @render('bookmarks.partials.bookmark_form_js')
@endsection
