<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isncription Auto Ecole</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice {
            width: 80mm;
            padding: 10px;
            margin: 0 auto;
        }

        .invoice header {
            text-align: center;
            margin-bottom: 10px;
        }

        .invoice header img {
            max-width: 50px;
        }

        .invoice .details,
        .invoice .items,
        .invoice .summary {
            margin-bottom: 10px;
        }

        .invoice .details .client-info,
        .invoice .details .store-info {
            margin-bottom: 0px;
        }

        .invoice .details .client-info p {
            margin: 2px 0;
        }

        .invoice .items table,
        .invoice .summary table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice .items table th,
        .invoice .items table td,
        .invoice .summary table th,
        .invoice .summary table td {
            border: 1px dashed #000;
            padding: 5px;
            text-align: left;
        }

        .invoice .summary {
            margin-top: 10px;
        }

        .invoice .payment-method {
            margin-top: 10px;
        }

        .invoice .barcode {
            text-align: center;
            margin-top: 10px;
        }

        .invoice .barcode img {
            max-width: 100%;
        }

        .barcode-wrapper {
            display: flex;
            justify-content: center;
            /* Centre l'élément horizontalement */
        }

        .invoice .footer {
            text-align: center;
            margin-top: 10px;
        }

        .invoice .print-button {
            text-align: center;
            margin-top: 10px;
        }

        .barcode-wrapper {
            display: flex;
            justify-content: center;
            /* Centre l'élément horizontalement */
            width: 100%;
            /* Assure que le wrapper prend toute la largeur disponible */
        }

        .barcode {
            text-align: center;
            /* Centre le contenu textuel et les images à l'intérieur */
        }
    </style>
</head>

<body>

    <div class="modal-body py-0">
        <div class="invoice">
            <header>
                <h2>Inscription Genius Auto</h2>
            </header>
            <div class="details">
                <div class="client-info">
                    <p>Date : {{ $date }}</p>
                    <p>Adresse : {{ $address }}</p>
                    <p>Email : {{ $email }}</p>
                    <p>Télé : {{ $phone }}</p>
                    <p>Client : {{ $client }}</p>
                    <p>Sexe : {{ $gender }}</p>
                    <p>Né(e) le : {{ $birth_date }}</p>
                    <p>Numéro de Téléphone : {{ $client_phone }}</p>
                    <p>Magasin : {{ $store }}</p>
                </div>
            </div>
            <div class="items">
                <table>
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Catégorie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Permis de Conduire</td>
                            <td>{{ $category }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="summary">
                <table>
                    <tbody>
                        <tr>
                            <th>Prix</th>
                            <td> {{ number_format($total ?? 0, 0, '', ' ') }} FCFA</td>
                        </tr>
                        <tr>
                            <th>Subvention</th>
                            <td> {{ number_format($subsidy ?? 0, 0, '', ' ') }} FCFA</td>
                        </tr>

                        <tr>
                            <th>Reste</th>
                            <td> {{ number_format($reste ?? 0, 0, '', ' ') }} FCFA</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="payment-method">
                <p>Moyen de Paiement : {{ $payment_method }}</p>
            </div>
            <div class="barcode-wrapper">
                <div class="barcode">
                    @if ($qrCode)
                        {!! $qrCode !!}
                    @endif
                    {{ $ticketNumber }}
                    <p>Passer dans nos locaux avec ce reçu</p>
                    <p>By Auto.Genius.Ci</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
