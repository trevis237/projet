<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Orange Money</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .payment-container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #FF8C00; /* Couleur Orange */
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #FF8C00; /* Couleur Orange */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #e07b00; /* Couleur Orange plus foncé */
        }
    </style>
    <head>

<script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>

</head>

</head>
<body>
<script>
        function checkout() {
            CinetPay.setConfig({
                apikey: '17661112167d274de585f05.66654002',//   YOUR APIKEY
                site_id: '105889779',//YOUR_SITE_ID
                notify_url: 'http://mondomaine.com/notify/',
                //close_after_response: true,
                mode: 'PRODUCTION'
            });
            CinetPay.getCheckout({
                transaction_id: Math.floor(Math.random() * 100000000).toString(), // YOUR TRANSACTION ID
                amount: 100,
                currency: 'XAF',
                channels: 'ALL',
                description: 'Test de paiement',   
                 //Fournir ces variables pour le paiements par carte bancaire
                customer_name:"Joe",//Le nom du client
                customer_surname:"Down",//Le prenom du client
                customer_email: "down@test.com",//l'email du client
                customer_phone_number: "088767611",//l'email du client
                customer_address : "BP 0024",//addresse du client
                customer_city: "Antananarivo",// La ville du client
                customer_country : "CM",// le code ISO du pays
                customer_state : "CM",// le code ISO l'état
                customer_zip_code : "06510", // code postal

            });
            CinetPay.waitResponse(function(data) {
         // En cas d'échec
          if (data.status == "REFUSED") {
              if (alert("Votre paiement a échoué")) {
                  window.location.reload();
              }
          }
          // En cas de succès
          else if (data.status == "ACCEPTED") {
              if (alert("Votre paiement a été effectué avec succès")) {
                  // correct, on delivre le service
                  window.location.reload();
              }
          }
   });

       // À l'écoute de la fermeture du guichet
   //    CinetPay.onClose(function(data) {
   //     if (data.status === "REFUSED") {
            // Afficher un message de paiement échec à l'utilisateur (Facultatif)
      //      alert("Votre paiement a échoué");
       // } else if (data.status === "ACCEPTED") {
            // Afficher un message de paiement succès à l'utilisateur (Facultatif)
         //   alert("Votre paiement a été effectué avec succès");
       // } else {
            // Afficher un message de fermeture du guichet (Facultatif)
         //   alert('Fermeture du guichet');
       // }

        // Rafraichir la page après fermeture du guichet 
        // (Permet de recharger le Seamless pour un éventuel nouveau paiement)
       // window.location.reload();
   // });

    CinetPay.onError(function(data) {
                console.log(data);
            });
        }
    </script>

<div class="payment-container">
    <h2>Paiement Orange Money</h2>
    <form>
        <div class="form-group">
            <label for="phone">Numéro de téléphone</label>
            <input type="text" id="phone" placeholder="+221 77 123 45 67" >
        </div>
        <div class="form-group">
            <label for="amount">Montant</label>
            <input type="number" id="amount" placeholder="Montant en FCFA" required>
        </div>
        <button onclick="checkout()" >Payer</button>
    </form>
</div>

</body>
</html>