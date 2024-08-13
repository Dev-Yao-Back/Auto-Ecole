<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture POS</title>
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
    </style>
</head>

<body>
    <div class="modal-header border-bottom-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="close"></button>
    </div>
    <div class="modal-body py-0">
        <div class="invoice">
            <header>
                <h2>Genius Auto</h2>
            </header>
            <div class="details">
                <div class="client-info">
                    <p>Date : {{ $date . ' ' . $time }}</p>
                    <p>Auto-Ecole : {{ $auto_Store }}</p>
                    <p>Adresse : {{ $auto_Adresse }}</p>
                    <p>Email : {{ $auto_Email }}</p>
                    <p>Teléphone : {{ $auto_Phone }}</p>
                    <p>Client : {{ $name . ' ' . $surname }} </p>
                    <p>Sexe : {{ $sexe }}</p>
                    <p>Né(e) le : {{ $date_born }}</p>
                    <p>Numéro de Téléphone : {{ $phone1 }}</p>
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
                            <td>{{ $lib_categorie }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="summary">
                <table>
                    <tbody>
                        <tr>
                            <th>Prix</th>
                            <td> {{ number_format($prix_normal ?? 0, 0, '', ' ') }} FCFA</td>
                        </tr>
                        <tr>
                            <th>Subvention</th>
                            <td> {{ number_format($lib_subvention ?? 0, 0, '', ' ') }} FCFA</td>
                        </tr>
                        <tr>
                            <th>Payé</th>
                            <td> {{ number_format($montant ?? 0, 0, '', ' ') }} FCFA</td>
                        </tr>
                        <tr>
                            <th>Reste</th>
                            <td> {{ number_format($reste ?? 0, 0, '', ' ') }} FCFA</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="payment-method">
                <p>Moyen de Paiement : Cash</p>
            </div>
            <div class="barcode-wrapper">
                <div class="barcode">
                    <p>Merci Et À Bientôt</p>
                    @if ($qrCode)
                        {!! $qrCode !!}
                    @endif
                </div>
            </div>

        </div>
    </div>
</body>

</html>
