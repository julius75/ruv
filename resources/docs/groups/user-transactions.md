# User-Transactions


## Fetch user transactions

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/transactions"
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


## Initiate a Payment (Customer Facing)

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/airtime-purchase" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"payment_method":"quia","provider_id":3,"phone_number":"cumque","amount":"officia"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/airtime-purchase"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_method": "quia",
    "provider_id": 3,
    "phone_number": "cumque",
    "amount": "officia"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-airtime-purchase" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-airtime-purchase"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-airtime-purchase"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-airtime-purchase" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-airtime-purchase"></code></pre>
</div>
<form id="form-POSTapi-v1-airtime-purchase" data-method="POST" data-path="api/v1/airtime-purchase" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-airtime-purchase', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-airtime-purchase" onclick="tryItOut('POSTapi-v1-airtime-purchase');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-airtime-purchase" onclick="cancelTryOut('POSTapi-v1-airtime-purchase');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-airtime-purchase" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/airtime-purchase</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-airtime-purchase" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-airtime-purchase" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>payment_method</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="payment_method" data-endpoint="POSTapi-v1-airtime-purchase" data-component="body" required  hidden>
<br>
Method of Payment, either moov or orange.</p>
<p>
<b><code>provider_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="provider_id" data-endpoint="POSTapi-v1-airtime-purchase" data-component="body" required  hidden>
<br>
Phone's Number Provider Id.</p>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-airtime-purchase" data-component="body" required  hidden>
<br>
Orange Recipient Phone Number.</p>
<p>
<b><code>amount</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="amount" data-endpoint="POSTapi-v1-airtime-purchase" data-component="body" required  hidden>
<br>
Airtime Amount.</p>

</form>



