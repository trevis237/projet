<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    <style>
        .sdk {
            display: block;
            position: absolute;
            background-position: center;
            text-align: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <script>
        function checkout() {
    CinetPay.setConfig({
        apikey: '17661112167d274de585f05.66654002', // remplacer par ton apiKey
        site_id: '105889779', // remplacer par ton site_id
        notify_url: 'http://127.0.0.1:5500/index.html', // remplacer par ton url
        mode: 'PRODUCTION'
    });

    CinetPay.getCheckout({
        transaction_id: Math.floor(Math.random() * 100000000).toString(),
        amount: 1000,
        currency: 'XAF',
        channels: 'ALL',
        description: 'YOUR_PAYMENT_DESCRIPTION',
        //Fournir ces variables obligatoirement pour le paiements par carte bancaire
        customer_name: "Joe", //Le nom du client
        customer_surname: "Down", //Le prenom du client
        customer_email: "down@test.com", //l'email du client
        customer_phone_number: "088767611", //l'email du client
        customer_address: "BP 0024", //addresse du client
        customer_city: "Antananarivo", // La ville du client
        customer_country: "CM", // le code ISO du pays
        customer_state: "CM", // le code ISO l'état
        customer_zip_code: "06510", // code postal
    });

    CinetPay.waitResponse(function (data) {
        // En cas d'échec
        if (data.status == "REFUSED") {
            addFailedSubscription()
        }
        // En cas de succès
        else if (data.status == "ACCEPTED") {
            addSubscription()
        }
    });

    CinetPay.onError(function (data) {
        console.log(data);
    });
}
    </script>
</head>
<body>
    </head>
    <body>
        <div class="sdk">
            <h1>SDK SEAMLESS</h1>
            <button onclick="checkout()">Checkout</button>
        </div>
    </body>
</html>  