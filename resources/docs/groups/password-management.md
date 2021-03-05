# Password Management

APIs for user reset password

## Send Password Reset Token


Send password reset token via Email to the user with provided email address.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/login/password/forgot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"amet"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/login/password/forgot"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "amet"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-login-password-forgot" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login-password-forgot"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login-password-forgot"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login-password-forgot" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login-password-forgot"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login-password-forgot" data-method="POST" data-path="api/v1/user/login/password/forgot" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login-password-forgot', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login-password-forgot" onclick="tryItOut('POSTapi-v1-user-login-password-forgot');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login-password-forgot" onclick="cancelTryOut('POSTapi-v1-user-login-password-forgot');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login-password-forgot" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login/password/forgot</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-login-password-forgot" data-component="body" required  hidden>
<br>
Email address.</p>

</form>


## Update Password


Update user's password after token verification.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/login/password/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"illum","token":"natus","password":"fuga","password_confirm":"pariatur"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/login/password/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "illum",
    "token": "natus",
    "password": "fuga",
    "password_confirm": "pariatur"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-login-password-update" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login-password-update"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login-password-update"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login-password-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login-password-update"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login-password-update" data-method="POST" data-path="api/v1/user/login/password/update" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login-password-update', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login-password-update" onclick="tryItOut('POSTapi-v1-user-login-password-update');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login-password-update" onclick="cancelTryOut('POSTapi-v1-user-login-password-update');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login-password-update" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login/password/update</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-login-password-update" data-component="body" required  hidden>
<br>
Email address.</p>
<p>
<b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="token" data-endpoint="POSTapi-v1-user-login-password-update" data-component="body" required  hidden>
<br>
Email token.</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-user-login-password-update" data-component="body" required  hidden>
<br>
Password.</p>
<p>
<b><code>password_confirm</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password_confirm" data-endpoint="POSTapi-v1-user-login-password-update" data-component="body" required  hidden>
<br>
Password, must match password.</p>

</form>



