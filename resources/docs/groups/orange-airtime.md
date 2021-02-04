# Orange Airtime


## Submit payment request

<small class="badge badge-darkred">requires authentication</small>

Send payment request to orange API

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/airtime-purchase/orange" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"ducimus","amount":"hic","otp":"ut"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```


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

</form>



