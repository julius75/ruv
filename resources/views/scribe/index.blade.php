<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>RUV Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/style.css") }}" media="screen" />
        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/print.css") }}" media="print" />
        <script src="{{ asset("vendor/scribe/js/all.js") }}"></script>

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/highlight-darcula.css") }}" media="" />
        <script src="{{ asset("vendor/scribe/js/highlight.pack.js") }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>

</head>

<body class="" data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">
<a href="#" id="nav-button">
      <span>
        NAV
            <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="-image" class=""/>
      </span>
</a>
<div class="tocify-wrapper">
                <div class="lang-selector">
                            <a href="#" data-language-name="bash">bash</a>
                            <a href="#" data-language-name="javascript">javascript</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI (Swagger) spec</a></li>
                            <li><a href='http://github.com/knuckleswtf/scribe'>Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: January 26 2021</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>RUV Mobile App API Documentation</p>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
<script>
    var baseUrl = "http://localhost";
</script>
<script src="{{ asset("vendor/scribe/js/tryitout-2.4.2.js") }}"></script>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost</code></pre><h1>Authenticating requests</h1>
<p>This API is not authenticated.</p><h1>Login</h1>
<p>APIs for user authentication</p>
<h2>Register User</h2>
<p>Registers user to the system.
A bearer token is provided after successful registration which you can store and use for authentication while
presenting the OTP Passcode in the next stage before user login.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first_name":"placeat","last_name":"aut","email":"eius","phone":"et","password":"ut","password_confirm":"provident"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
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
<h2>Email Unique Check</h2>
<p>Check whether the provided email in user registration form is unique.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/register/email-unique" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"possimus"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
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
<h2>Phone Number Unique Check</h2>
<p>Check whether the provided phone number in user registration form is unique</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/register/phone-unique" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"hic"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
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
<h2>Verify Passcode (OTP)</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Verify passcode provided by the user for OTP.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/register/verify-passcode" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"passcode":"quia"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
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
<h2>Login</h2>
<p>Log a user into the system. After successful login, a bearer token is returned which you may store and use for
authentication for guarded routes. Note that this token has an expiry duration therefore you should implement
a mechanism to check whether the token has expired before requiring the user to login again.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"et","password":"mollitia"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
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

</form><h1>Orange Airtime</h1>
<h2>Submit payment request</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Send payment request to orange API</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/airtime-purchase/orange" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"ducimus","amount":"hic","otp":"ut"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/airtime-purchase/orange"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "ducimus",
    "amount": "hic",
    "otp": "ut"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-airtime-purchase-orange" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-airtime-purchase-orange"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-airtime-purchase-orange"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-airtime-purchase-orange" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-airtime-purchase-orange"></code></pre>
</div>
<form id="form-POSTapi-v1-airtime-purchase-orange" data-method="POST" data-path="api/v1/airtime-purchase/orange" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-airtime-purchase-orange', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-airtime-purchase-orange" onclick="tryItOut('POSTapi-v1-airtime-purchase-orange');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-airtime-purchase-orange" onclick="cancelTryOut('POSTapi-v1-airtime-purchase-orange');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-airtime-purchase-orange" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/airtime-purchase/orange</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-airtime-purchase-orange" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-airtime-purchase-orange" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-airtime-purchase-orange" data-component="body" required  hidden>
<br>
Orange Recipient Phone Number.</p>
<p>
<b><code>amount</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="amount" data-endpoint="POSTapi-v1-airtime-purchase-orange" data-component="body" required  hidden>
<br>
Orange Airtime Amount.</p>
<p>
<b><code>otp</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="otp" data-endpoint="POSTapi-v1-airtime-purchase-orange" data-component="body" required  hidden>
<br>
OTP Received from Orange Money USSD.</p>

</form><h1>Password Management</h1>
<p>APIs for user reset password</p>
<h2>Send Password Reset Token</h2>
<p>Send password reset token via Email to the user with provided email address.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/login/password/forgot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"amet"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
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
<h2>Update Password</h2>
<p>Update user's password after token verification.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/login/password/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"illum","token":"natus","password":"fuga","password_confirm":"pariatur"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
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
}).then(response =&gt; response.json());</code></pre>
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

</form><h1>Teleco Providers</h1>
<h2>Fetch Teleco Providers</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/providers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/providers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-providers" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-providers"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-providers"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-providers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-providers"></code></pre>
</div>
<form id="form-POSTapi-v1-providers" data-method="POST" data-path="api/v1/providers" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-providers', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-providers" onclick="tryItOut('POSTapi-v1-providers');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-providers" onclick="cancelTryOut('POSTapi-v1-providers');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-providers" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/providers</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-providers" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-providers" data-component="header"></label>
</p>
</form><h1>User Devices</h1>
<p>APIs for managing user device tokens for push notifications</p>
<h2>Create/Update users device token</h2>
<p>Registers Users' Device tokens for sending push notifications
presenting the OTP Passcode in the next stage before user login.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/device" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"aliquid","token":"qui","type":"sed"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/device"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "aliquid",
    "token": "qui",
    "type": "sed"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-device" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-device"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-device"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-device" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-device"></code></pre>
</div>
<form id="form-POSTapi-v1-user-device" data-method="POST" data-path="api/v1/user/device" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-device', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-device" onclick="tryItOut('POSTapi-v1-user-device');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-device" onclick="cancelTryOut('POSTapi-v1-user-device');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-device" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/device</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-device" data-component="body" required  hidden>
<br>
Email Address.</p>
<p>
<b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="token" data-endpoint="POSTapi-v1-user-device" data-component="body" required  hidden>
<br>
Device Token.</p>
<p>
<b><code>type</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="type" data-endpoint="POSTapi-v1-user-device" data-component="body" required  hidden>
<br>
Device Type, submit either ios OR android.</p>

</form><h1>User Profile Management</h1>
<p>APIs for managing user profile and phone numbers</p>
<h2>User&#039;s Profile</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Provides data for the profile page e.g. first_name, last_name, email and phone numbers</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-profile" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-profile"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-profile"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-profile"></code></pre>
</div>
<form id="form-POSTapi-v1-user-profile" data-method="POST" data-path="api/v1/user/profile" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-profile', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-profile" onclick="tryItOut('POSTapi-v1-user-profile');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-profile" onclick="cancelTryOut('POSTapi-v1-user-profile');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-profile" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/profile</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-profile" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-profile" data-component="header"></label>
</p>
</form>
<h2>Edit User&#039;s Profile</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Change User Profile details</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/profile/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first_name":"cum","last_name":"reprehenderit","email":"sit"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/profile/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "cum",
    "last_name": "reprehenderit",
    "email": "sit"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-profile-edit" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-profile-edit"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-profile-edit"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-profile-edit" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-profile-edit"></code></pre>
</div>
<form id="form-POSTapi-v1-user-profile-edit" data-method="POST" data-path="api/v1/user/profile/edit" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-profile-edit', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-profile-edit" onclick="tryItOut('POSTapi-v1-user-profile-edit');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-profile-edit" onclick="cancelTryOut('POSTapi-v1-user-profile-edit');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-profile-edit" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/profile/edit</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-profile-edit" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-profile-edit" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>first_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="first_name" data-endpoint="POSTapi-v1-user-profile-edit" data-component="body" required  hidden>
<br>
Last Name.</p>
<p>
<b><code>last_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="last_name" data-endpoint="POSTapi-v1-user-profile-edit" data-component="body" required  hidden>
<br>
First Name.</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-profile-edit" data-component="body" required  hidden>
<br>
Email Address.</p>

</form>
<h2>Delete Account</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Deactivates user account</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/profile/delete-account" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/profile/delete-account"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-profile-delete-account" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-profile-delete-account"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-profile-delete-account"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-profile-delete-account" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-profile-delete-account"></code></pre>
</div>
<form id="form-POSTapi-v1-user-profile-delete-account" data-method="POST" data-path="api/v1/user/profile/delete-account" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-profile-delete-account', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-profile-delete-account" onclick="tryItOut('POSTapi-v1-user-profile-delete-account');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-profile-delete-account" onclick="cancelTryOut('POSTapi-v1-user-profile-delete-account');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-profile-delete-account" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/profile/delete-account</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-profile-delete-account" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-profile-delete-account" data-component="header"></label>
</p>
</form>
<h2>Add Phone Number</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Adds additional Phone Number to a users profile</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/profile/add-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"dicta"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/profile/add-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "dicta"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-profile-add-phone_number" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-profile-add-phone_number"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-profile-add-phone_number"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-profile-add-phone_number" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-profile-add-phone_number"></code></pre>
</div>
<form id="form-POSTapi-v1-user-profile-add-phone_number" data-method="POST" data-path="api/v1/user/profile/add-phone_number" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-profile-add-phone_number', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-profile-add-phone_number" onclick="tryItOut('POSTapi-v1-user-profile-add-phone_number');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-profile-add-phone_number" onclick="cancelTryOut('POSTapi-v1-user-profile-add-phone_number');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-profile-add-phone_number" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/profile/add-phone_number</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-profile-add-phone_number" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-profile-add-phone_number" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-user-profile-add-phone_number" data-component="body" required  hidden>
<br>
PhoneNumber.</p>

</form>
<h2>Delete Phone Number</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Delete registered Phone Number</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/profile/delete-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"laborum"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/profile/delete-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "laborum"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-profile-delete-phone_number" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-profile-delete-phone_number"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-profile-delete-phone_number"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-profile-delete-phone_number" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-profile-delete-phone_number"></code></pre>
</div>
<form id="form-POSTapi-v1-user-profile-delete-phone_number" data-method="POST" data-path="api/v1/user/profile/delete-phone_number" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-profile-delete-phone_number', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-profile-delete-phone_number" onclick="tryItOut('POSTapi-v1-user-profile-delete-phone_number');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-profile-delete-phone_number" onclick="cancelTryOut('POSTapi-v1-user-profile-delete-phone_number');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-profile-delete-phone_number" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/profile/delete-phone_number</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-profile-delete-phone_number" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-profile-delete-phone_number" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-user-profile-delete-phone_number" data-component="body" required  hidden>
<br>
Phone Number is to be deleted.</p>

</form>
<h2>Verify Added Phone Number</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Verify passcode provided by the user on adding a new phone number.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/profile/validate-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"quibusdam","passcode":"aperiam"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/profile/validate-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "quibusdam",
    "passcode": "aperiam"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-profile-validate-phone_number" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-profile-validate-phone_number"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-profile-validate-phone_number"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-profile-validate-phone_number" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-profile-validate-phone_number"></code></pre>
</div>
<form id="form-POSTapi-v1-user-profile-validate-phone_number" data-method="POST" data-path="api/v1/user/profile/validate-phone_number" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-profile-validate-phone_number', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-profile-validate-phone_number" onclick="tryItOut('POSTapi-v1-user-profile-validate-phone_number');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-profile-validate-phone_number" onclick="cancelTryOut('POSTapi-v1-user-profile-validate-phone_number');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-profile-validate-phone_number" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/profile/validate-phone_number</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-profile-validate-phone_number" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-profile-validate-phone_number" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-user-profile-validate-phone_number" data-component="body" required  hidden>
<br>
Phone Number that received OTP.</p>
<p>
<b><code>passcode</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="passcode" data-endpoint="POSTapi-v1-user-profile-validate-phone_number" data-component="body" required  hidden>
<br>
Passcode that was sent via SMS.</p>

</form>
<h2>Set Default Phone Number</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Mark Registered PhoneNumber as Default.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/profile/set-default-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"placeat"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/profile/set-default-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "placeat"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-profile-set-default-phone_number" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-profile-set-default-phone_number"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-profile-set-default-phone_number"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-profile-set-default-phone_number" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-profile-set-default-phone_number"></code></pre>
</div>
<form id="form-POSTapi-v1-user-profile-set-default-phone_number" data-method="POST" data-path="api/v1/user/profile/set-default-phone_number" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-profile-set-default-phone_number', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-profile-set-default-phone_number" onclick="tryItOut('POSTapi-v1-user-profile-set-default-phone_number');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-profile-set-default-phone_number" onclick="cancelTryOut('POSTapi-v1-user-profile-set-default-phone_number');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-profile-set-default-phone_number" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/profile/set-default-phone_number</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-profile-set-default-phone_number" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-profile-set-default-phone_number" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-user-profile-set-default-phone_number" data-component="body" required  hidden>
<br>
Phone Number that received OTP.</p>

</form><h1>User Transactions</h1>
<h2>Fetch user transactions</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/transactions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-transactions" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-transactions"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-transactions"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-transactions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-transactions"></code></pre>
</div>
<form id="form-POSTapi-v1-user-transactions" data-method="POST" data-path="api/v1/user/transactions" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-transactions', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-transactions" onclick="tryItOut('POSTapi-v1-user-transactions');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-transactions" onclick="cancelTryOut('POSTapi-v1-user-transactions');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-transactions" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/transactions</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-transactions" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-transactions" data-component="header"></label>
</p>
</form>
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var languages = ["bash","javascript"];
        setupLanguages(languages);
    });
</script>
</body>
</html>