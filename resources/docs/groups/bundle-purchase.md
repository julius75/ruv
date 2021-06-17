# Bundle Purchase


## Initiate a Bundle purchase

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/bundle-purchase" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"payment_method":"similique","provider_id":5,"phone_number":"eum","amount":"doloremque","moov_cash_phone_number":"accusamus"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/bundle-purchase"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_method": "similique",
    "provider_id": 5,
    "phone_number": "eum",
    "amount": "doloremque",
    "moov_cash_phone_number": "accusamus"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-bundle-purchase" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-bundle-purchase"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-bundle-purchase"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-bundle-purchase" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-bundle-purchase"></code></pre>
</div>
<form id="form-POSTapi-v1-bundle-purchase" data-method="POST" data-path="api/v1/bundle-purchase" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-bundle-purchase', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-bundle-purchase" onclick="tryItOut('POSTapi-v1-bundle-purchase');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-bundle-purchase" onclick="cancelTryOut('POSTapi-v1-bundle-purchase');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-bundle-purchase" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/bundle-purchase</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-bundle-purchase" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-bundle-purchase" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>payment_method</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="payment_method" data-endpoint="POSTapi-v1-bundle-purchase" data-component="body" required  hidden>
<br>
Method of Payment, either moov or orange.</p>
<p>
<b><code>provider_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="provider_id" data-endpoint="POSTapi-v1-bundle-purchase" data-component="body" required  hidden>
<br>
Phone's Number Provider Id.</p>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-bundle-purchase" data-component="body" required  hidden>
<br>
Orange Recipient Phone Number.</p>
<p>
<b><code>amount</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="amount" data-endpoint="POSTapi-v1-bundle-purchase" data-component="body" required  hidden>
<br>
Airtime Amount.</p>
<p>
<b><code>moov_cash_phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="moov_cash_phone_number" data-endpoint="POSTapi-v1-bundle-purchase" data-component="body" required  hidden>
<br>
Number Used to Pay</p>

</form>


## Get bundles code

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/bundle-code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"provider_id":18}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/bundle-code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "provider_id": 18
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-bundle-code" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-bundle-code"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-bundle-code"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-bundle-code" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-bundle-code"></code></pre>
</div>
<form id="form-POSTapi-v1-bundle-code" data-method="POST" data-path="api/v1/bundle-code" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-bundle-code', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-bundle-code" onclick="tryItOut('POSTapi-v1-bundle-code');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-bundle-code" onclick="cancelTryOut('POSTapi-v1-bundle-code');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-bundle-code" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/bundle-code</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-bundle-code" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-bundle-code" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>provider_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="provider_id" data-endpoint="POSTapi-v1-bundle-code" data-component="body" required  hidden>
<br>
Phone's Number Provider Id.</p>

</form>



