# Notifications
* @authenticated
APIs for mobile app notifications

## Fetch All Notifications

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/notifications/all" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/notifications/all"
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


<div id="execution-results-POSTapi-v1-user-notifications-all" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-notifications-all"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-notifications-all"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-notifications-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-notifications-all"></code></pre>
</div>
<form id="form-POSTapi-v1-user-notifications-all" data-method="POST" data-path="api/v1/user/notifications/all" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-notifications-all', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-notifications-all" onclick="tryItOut('POSTapi-v1-user-notifications-all');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-notifications-all" onclick="cancelTryOut('POSTapi-v1-user-notifications-all');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-notifications-all" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/notifications/all</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-notifications-all" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-notifications-all" data-component="header"></label>
</p>
</form>


## Fetch All Unread Notifications

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/notifications/unread" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/notifications/unread"
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


<div id="execution-results-POSTapi-v1-user-notifications-unread" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-notifications-unread"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-notifications-unread"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-notifications-unread" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-notifications-unread"></code></pre>
</div>
<form id="form-POSTapi-v1-user-notifications-unread" data-method="POST" data-path="api/v1/user/notifications/unread" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-notifications-unread', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-notifications-unread" onclick="tryItOut('POSTapi-v1-user-notifications-unread');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-notifications-unread" onclick="cancelTryOut('POSTapi-v1-user-notifications-unread');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-notifications-unread" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/notifications/unread</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-notifications-unread" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-notifications-unread" data-component="header"></label>
</p>
</form>


## api/v1/user/notifications/notify-vendor




> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/notifications/notify-vendor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/notifications/notify-vendor"
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


<div id="execution-results-POSTapi-v1-user-notifications-notify-vendor" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-notifications-notify-vendor"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-notifications-notify-vendor"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-notifications-notify-vendor" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-notifications-notify-vendor"></code></pre>
</div>
<form id="form-POSTapi-v1-user-notifications-notify-vendor" data-method="POST" data-path="api/v1/user/notifications/notify-vendor" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-notifications-notify-vendor', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-notifications-notify-vendor" onclick="tryItOut('POSTapi-v1-user-notifications-notify-vendor');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-notifications-notify-vendor" onclick="cancelTryOut('POSTapi-v1-user-notifications-notify-vendor');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-notifications-notify-vendor" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/notifications/notify-vendor</code></b>
</p>
</form>



