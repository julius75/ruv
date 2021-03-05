# User Devices

APIs for managing user device tokens for push notifications

## Create/Update users device token


Registers Users' Device tokens for sending push notifications
presenting the OTP Passcode in the next stage before user login.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/device" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"aliquid","token":"qui","type":"sed"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```


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

</form>



