@layout('layout.master')

@section('container')

@include('alert.partials.errors_first')
@include('alert.partials.success')

<div class="row">
    <div class="span12">
        <h3>Welcome!</h3>
        Log in or create a new account for free.<br/>
    </div>
</div>

<br/>

<div class="row">
    <div class="span7">
        
        <table class="table feature">
            <tbody>
                
                <tr>
                    <td>
                        <center><i class="icon-cloud-upload icon-2x"></i></center>
                    </td>
                    <td>
                        <b>Online</b><br/>
                        Bookmarks are stored in the cloud. Access them everywhere and anytime.
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <center><i class="icon-search icon-2x"></i></center>
                    </td>
                    <td>
                        <b>Find</b><br/>
                        Comprehensive search function makes finding bookmarks a snap.
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><i class="icon-tags icon-2x"></i></center>
                    </td>
                    <td>
                        <b>Organize</b><br/>
                        Keep your bookmark collection organized by assigning tags.
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <center><i class="icon-mobile-phone icon-3x"></i></center>
                    </td>
                    <td>
                        <b>Mobile</b><br/>
                        Manage your bookmarks on the go on iPhone, iPod Touch and iPad.
                    </td>
                </tr>

                <tr>
                    <td>
                        <center><i class="icon-picture icon-2x"></i></center>
                    </td>
                    <td>
                        <b>And there's more</b><br/>
                        Clean and simple interface, automatic thumbnail creation, bookmarklets and much more!
                    </td>
                </tr>

            </tbody>
        </table>        

    </div>

    <div class="span5">
        <div class="well">

            {{ Form::open('auth/login', 'POST') }}

                <div class="control-group">
                    <div class="controls">
                        <h4><i class="icon-signin"></i> Login</h4>
                        <hr/>
                    </div>
                </div>

                @include('auth.partials.login_form_content')
                
                {{ $urlManagerForLogin->toHTML() }}

            {{ Form::close() }}

            Don't have an account? {{ HTML::link_to_action('auth@signup', 'Sign up!') }}

        </div>
    </div>
</div>

@endsection
