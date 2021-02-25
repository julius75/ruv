# Teleco Providers


## Fetch Teleco Providers

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/providers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/providers"
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
</form>



