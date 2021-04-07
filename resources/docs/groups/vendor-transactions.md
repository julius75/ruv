# Vendor Transactions
* @authenticated
APIs for managing vendor transactions

## Fetch All Vendor transactions

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/vendor/transactions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/vendor/transactions"
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


<div id="execution-results-POSTapi-v1-user-vendor-transactions" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-vendor-transactions"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-vendor-transactions"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-vendor-transactions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-vendor-transactions"></code></pre>
</div>
<form id="form-POSTapi-v1-user-vendor-transactions" data-method="POST" data-path="api/v1/user/vendor/transactions" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-vendor-transactions', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-vendor-transactions" onclick="tryItOut('POSTapi-v1-user-vendor-transactions');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-vendor-transactions" onclick="cancelTryOut('POSTapi-v1-user-vendor-transactions');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-vendor-transactions" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/vendor/transactions</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-vendor-transactions" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-vendor-transactions" data-component="header"></label>
</p>
</form>


## Send Airtime to User

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/vendor/send-airtime" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"transaction_id":7}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/vendor/send-airtime"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "transaction_id": 7
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-vendor-send-airtime" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-vendor-send-airtime"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-vendor-send-airtime"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-vendor-send-airtime" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-vendor-send-airtime"></code></pre>
</div>
<form id="form-POSTapi-v1-user-vendor-send-airtime" data-method="POST" data-path="api/v1/user/vendor/send-airtime" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-vendor-send-airtime', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-vendor-send-airtime" onclick="tryItOut('POSTapi-v1-user-vendor-send-airtime');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-vendor-send-airtime" onclick="cancelTryOut('POSTapi-v1-user-vendor-send-airtime');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-vendor-send-airtime" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/vendor/send-airtime</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-vendor-send-airtime" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-vendor-send-airtime" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>transaction_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="transaction_id" data-endpoint="POSTapi-v1-user-vendor-send-airtime" data-component="body" required  hidden>
<br>
Transaction ID.</p>

</form>


## Update Transaction Status

<small class="badge badge-darkred">requires authentication</small>

Depending on the vendor's ussd interaction, on successfully sending airtime set complete as true, else false

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/vendor/update-transaction-status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"transaction_id":17,"complete":false}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/vendor/update-transaction-status"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "transaction_id": 17,
    "complete": false
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-vendor-update-transaction-status" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-vendor-update-transaction-status"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-vendor-update-transaction-status"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-vendor-update-transaction-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-vendor-update-transaction-status"></code></pre>
</div>
<form id="form-POSTapi-v1-user-vendor-update-transaction-status" data-method="POST" data-path="api/v1/user/vendor/update-transaction-status" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-vendor-update-transaction-status', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-vendor-update-transaction-status" onclick="tryItOut('POSTapi-v1-user-vendor-update-transaction-status');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-vendor-update-transaction-status" onclick="cancelTryOut('POSTapi-v1-user-vendor-update-transaction-status');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-vendor-update-transaction-status" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/vendor/update-transaction-status</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-vendor-update-transaction-status" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-vendor-update-transaction-status" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>transaction_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="transaction_id" data-endpoint="POSTapi-v1-user-vendor-update-transaction-status" data-component="body" required  hidden>
<br>
Transaction ID.</p>
<p>
<b><code>complete</code></b>&nbsp;&nbsp;<small>boolean</small>  &nbsp;
<label data-endpoint="POSTapi-v1-user-vendor-update-transaction-status" hidden><input type="radio" name="complete" value="true" data-endpoint="POSTapi-v1-user-vendor-update-transaction-status" data-component="body" required ><code>true</code></label>
<label data-endpoint="POSTapi-v1-user-vendor-update-transaction-status" hidden><input type="radio" name="complete" value="false" data-endpoint="POSTapi-v1-user-vendor-update-transaction-status" data-component="body" required ><code>false</code></label>
<br>
Mark Transaction as Complete or Incomplete.</p>

</form>



