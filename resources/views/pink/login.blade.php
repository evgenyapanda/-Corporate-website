@extends(env('THEME').'.layouts.site')

@section('content')

    <div id="content-home" class="content group">
        <div class="hentry group">

            <form id="contact-form-cotact-us" class="contact-form" method="POST" action="{{ url('/login') }}">

                {{ csrf_field() }}
                <fieldset>
                    <ul>
                        <li class="text-field">
                            <label for="login">
                                <span class="label">E-Mail Address</span>
                                <br />
                                <span class="sublabel">E-Mail Address</span><br />
                             </label>
                            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span><input type="text" name="email" id="email" class="required" vallue=""></div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </li>

                        <li class="text-field">
                            <label for="password">
                                <span class="label">Password</span>
                                <br />					<span class="sublabel">This is a field password</span><br />
                            </label>
                            <div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span><input type="text" name="password" id="password" class="required" value="" /></div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </li>

                        <li class="submit-button">
                            <input type="submit" name="yit_sendmail" value="Отправить" class="sendmail alignright">
                        </li>

                    </ul>
                </fieldset>
            </form>
            

        </div>
    </div>

@endsection