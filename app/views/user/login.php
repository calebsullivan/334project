<h2 class="content-subhead">Log into your account!</h2>

<form class="pure-form pure-form-aligned" id='login_form' action="/login/" method="post">
    <fieldset>
        <div class="pure-control-group">
            <label for="name">Username or email</label>
            <input id="name" type="text" name="username" placeholder="Username or email">
        </div>

        <div class="pure-control-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password">
        </div>

        <div class="pure-controls">
            <label for="remember" class="pure-checkbox">
                <input id="remember" name="remember" type="checkbox"> Remember me.
            </label>

            <button type="submit" class="pure-button pure-button-primary">Log in</button>
        </div>
    </fieldset>
</form>