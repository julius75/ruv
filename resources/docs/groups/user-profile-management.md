# User Profile Management

APIs for managing user profile and phone numbers

## User&#039;s Profile

<small class="badge badge-darkred">requires authentication</small>

Provides data for the profile page e.g. first_name, last_name, email and phone numbers

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


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


## Edit User&#039;s Profile

<small class="badge badge-darkred">requires authentication</small>

Change User Profile details

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/profile/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first_name":"reiciendis","last_name":"labore","email":"temporibus"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/profile/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "reiciendis",
    "last_name": "labore",
    "email": "temporibus"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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


## Delete Account

<small class="badge badge-darkred">requires authentication</small>

Deactivates user account

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/profile/delete-account" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/profile/delete-account"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


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


## Add Phone Number

<small class="badge badge-darkred">requires authentication</small>

Adds additional Phone Number to a users profile

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/profile/add-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"qui","provider_id":"rerum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/profile/add-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "qui",
    "provider_id": "rerum"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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
<p>
<b><code>provider_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="provider_id" data-endpoint="POSTapi-v1-user-profile-add-phone_number" data-component="body" required  hidden>
<br>
Teleco Provider ID.</p>

</form>


## Delete Phone Number

<small class="badge badge-darkred">requires authentication</small>

Delete registered Phone Number

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/profile/delete-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"nobis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/profile/delete-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "nobis"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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


## Verify Added Phone Number

<small class="badge badge-darkred">requires authentication</small>

Verify passcode provided by the user on adding a new phone number.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/profile/validate-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"quod","passcode":"non"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/profile/validate-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "quod",
    "passcode": "non"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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


## Set Default Phone Number

<small class="badge badge-darkred">requires authentication</small>

Mark Registered PhoneNumber as Default.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/profile/set-default-phone_number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"molestiae"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/profile/set-default-phone_number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "molestiae"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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

</form>



