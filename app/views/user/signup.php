<h2 class="content-subhead">Create an account!</h2>

<form class="pure-form pure-form-aligned" id="signup-form" action="/signup/" method="post">
    <fieldset>
        <div class="pure-control-group">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" placeholder="Username">
        </div>

        <div class="pure-control-group">
            <label for="name">Full Name</label>
            <input id="name" name="name" type="text" placeholder="First Last">
        </div>

        <div class="pure-control-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="Password">
        </div>

        <div class="pure-control-group">
            <label for="email">Email Address</label>
            <input id="email" name="email" type="email" placeholder="Email Address">
        </div>

        <div class="pure-controls">
            <label for="remember" class="pure-checkbox">
                <input id="remember" name="remember" type="checkbox"> Remember me.
            </label>

            <button type="submit" class="pure-button pure-button-primary">Sign up</button>
        </div>
    </fieldset>
</form>