# Login

APIs for user authentication

## Register User


Registers user to the system.
A bearer token is provided after successful registration which you can store and use for authentication while
presenting the OTP Passcode in the next stage before user login.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first_name":"placeat","last_name":"aut","email":"eius","phone":"et","password":"ut","password_confirm":"provident"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "placeat",
    "last_name": "aut",
    "email": "eius",
    "phone": "et",
    "password": "ut",
    "password_confirm": "provident"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-register" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-register"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-register"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-register"></code></pre>
</div>
<form id="form-POSTapi-v1-user-register" data-method="POST" data-path="api/v1/user/register" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-register', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-register" onclick="tryItOut('POSTapi-v1-user-register');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-register" onclick="cancelTryOut('POSTapi-v1-user-register');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-register" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/register</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="first_name" data-endpoint="POSTapi-v1-user-register" data-component="body" required  hidden>
<br>
First Name.</p>
<p>
<b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="last_name" data-endpoint="POSTapi-v1-user-register" data-component="body" required  hidden>
<br>
Last Name.</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-register" data-component="body" required  hidden>
<br>
Email Address.</p>
<p>
<b><code>phone</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone" data-endpoint="POSTapi-v1-user-register" data-component="body" required  hidden>
<br>
Phone Number, prefixed.</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-user-register" data-component="body" required  hidden>
<br>
Password min 8 characters.</p>
<p>
<b><code>password_confirm</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password_confirm" data-endpoint="POSTapi-v1-user-register" data-component="body" required  hidden>
<br>
Password, must match password.</p>

</form>


## Email Unique Check


Check whether the provided email in user registration form is unique.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/register/email-unique" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"possimus"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/register/email-unique"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "possimus"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-register-email-unique" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-register-email-unique"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-register-email-unique"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-register-email-unique" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-register-email-unique"></code></pre>
</div>
<form id="form-POSTapi-v1-user-register-email-unique" data-method="POST" data-path="api/v1/user/register/email-unique" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-register-email-unique', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-register-email-unique" onclick="tryItOut('POSTapi-v1-user-register-email-unique');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-register-email-unique" onclick="cancelTryOut('POSTapi-v1-user-register-email-unique');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-register-email-unique" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/register/email-unique</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-register-email-unique" data-component="body" required  hidden>
<br>
Email address.</p>

</form>


## Phone Number Unique Check


Check whether the provided phone number in user registration form is unique

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/register/phone-unique" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"hic"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/register/phone-unique"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "hic"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-register-phone-unique" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-register-phone-unique"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-register-phone-unique"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-register-phone-unique" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-register-phone-unique"></code></pre>
</div>
<form id="form-POSTapi-v1-user-register-phone-unique" data-method="POST" data-path="api/v1/user/register/phone-unique" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-register-phone-unique', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-register-phone-unique" onclick="tryItOut('POSTapi-v1-user-register-phone-unique');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-register-phone-unique" onclick="cancelTryOut('POSTapi-v1-user-register-phone-unique');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-register-phone-unique" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/register/phone-unique</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-user-register-phone-unique" data-component="body" required  hidden>
<br>
Phone number.</p>

</form>


## Verify Passcode (OTP)

<small class="badge badge-darkred">requires authentication</small>

Verify passcode provided by the user for OTP.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/register/verify-passcode" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"passcode":"quia"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/register/verify-passcode"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "passcode": "quia"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-register-verify-passcode" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-register-verify-passcode"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-register-verify-passcode"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-register-verify-passcode" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-register-verify-passcode"></code></pre>
</div>
<form id="form-POSTapi-v1-user-register-verify-passcode" data-method="POST" data-path="api/v1/user/register/verify-passcode" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-register-verify-passcode', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-register-verify-passcode" onclick="tryItOut('POSTapi-v1-user-register-verify-passcode');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-register-verify-passcode" onclick="cancelTryOut('POSTapi-v1-user-register-verify-passcode');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-register-verify-passcode" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/register/verify-passcode</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-register-verify-passcode" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-register-verify-passcode" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>passcode</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="passcode" data-endpoint="POSTapi-v1-user-register-verify-passcode" data-component="body" required  hidden>
<br>
Passcode that was sent via Email.</p>

</form>


## Login


Log a user into the system. After successful login, a bearer token is returned which you may store and use for
authentication for guarded routes. Note that this token has an expiry duration therefore you should implement
a mechanism to check whether the token has expired before requiring the user to login again.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"et","password":"mollitia"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "et",
    "password": "mollitia"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-login" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login" data-method="POST" data-path="api/v1/user/login" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login" onclick="tryItOut('POSTapi-v1-user-login');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login" onclick="cancelTryOut('POSTapi-v1-user-login');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-login" data-component="body" required  hidden>
<br>
Email address.</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-user-login" data-component="body" required  hidden>
<br>
Password.</p>

</form>



