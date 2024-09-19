<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="https://assets.edlin.app/favicon/favicon.ico">

    <link rel="stylesheet" href="https://assets.edlin.app/bootstrap/v5.3/bootstrap.css">

    <script src="https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}&currency=GBP&intent=capture&components=buttons,funding-eligibility"></script>

    <!-- Title -->
    <title>PayPal Laravel</title>
</head>
<body>
<div class="container text-center">
    <div class="row mt-3">
        <div class="col-12">
            <img src="https://assets.edlin.app/logo/codewithross/logo-symbol-dark.png" height='100' alt="Ross Edlin Logo"/>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <h1>PayPal Laravel</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">

            <div class="row mt-3" id="paypal-success" style="display: none;">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="alert alert-success" role="alert">
                        You have successfully sent me money! Thank you!
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-lg-6 offset-lg-3">
                    <div class="input-group">
                        <span class="input-group-text">£</span>
                        <input type="text"
                               class="form-control"
                               id="paypal-amount"
                               value="100"
                               aria-label="Amount (to the nearest pound)">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-lg-6 offset-lg-3" id="payment_options"></div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    const fundingSources = [
        paypal.FUNDING.PAYPAL,    // PayPal
        paypal.FUNDING.CARD,      // بطاقات الائتمان
        paypal.FUNDING.APPLEPAY,  // Apple Pay
    ];

    fundingSources.forEach(function(fundingSource) {
        paypal.Buttons({
            fundingSource: fundingSource,  // تحديد وسيلة الدفع

            createOrder: function () {
                return fetch("/create/" + document.getElementById("paypal-amount").value)
                    .then((response) => response.text())
                    .then((id) => {
                        return id;
                    });
            },

            onApprove: function () {
                return fetch("/complete", {
                    method: "post",
                    headers: {"X-CSRF-Token": '{{csrf_token()}}'}
                })
                    .then((response) => response.json())
                    .then((order_details) => {
                        console.log(order_details);
                        document.getElementById("paypal-success").style.display = 'block';
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            onCancel: function (data) {
                // معالجة الإلغاء
            },

            onError: function (err) {
                // معالجة الخطأ
                console.log(err);
            }
        }).render('#payment_options'); // قم بعرض الزر في الحاوية
    });
</script>
</html>
