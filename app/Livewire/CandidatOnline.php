<?php

namespace App\Livewire;

use Kreait\Firebase\Messaging;

use Livewire\Component;
use App\Models\Candidat;
use App\Models\Piece;
use App\Models\Subvention;
use App\Models\Source;
use App\Models\CategorieModel;
use Illuminate\Validation\ValidationException;
use App\Models\CandidatOnline as CandidatModel;
use App\Models\Commune;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PDF;
use Illuminate\Support\Facades\Storage;





class CandidatOnline extends Component
{
  // Public properties for form data
  public $categories;
  public $subventions;
  public $sources;
  public $pieces;
  public $communes;

  public $name;
  public $surname;
  public $email;
  public $tel_number1;
  public $sexe;
  public $date_birth;
  public $commune_residence;
  public $categorie_permis_id;
  public $subvention_id;
  public $moyen_payement;
  public $promo_code;

  // Derived properties
  public $lib_subvention;
  public $lib_categorie;
  public $reste;
  public $total;
  public $apayer;


  // State properties
  public $progress = 0;
  public $step = 1;

  public $qrCode, $ticketNumber, $receiptUrl;
  public $date, $time;


  public function mount()
  {
      $this->date = now()->format('d/m/Y');
       $this->time = now()->format('H:i:s');
      $this->categories = CategorieModel::all();
      $this->subventions = Subvention::all();
      $this->sources = Source::all();
      $this->pieces = Piece::all();
      $this->communes = Commune::all();

      $this->calculateTotal();
  }


  public function nextStep()
  {
  // Validate before moving to the next step
  if ($this->step == 1) {
        $this->validateFirstStep();
        $this->fetchAdditionalDetails();

}     if ($this->step < 2) {
          $this->step++;
      }
  }

  public function prevStep()
  {
      if ($this->step > 1) {
          $this->step--;
      }
  }

  protected function validateFirstStep()
  {
      $this->validate([
          'name' => 'required|string',
          'surname' => 'required|string',
          'email' => 'nullable',
          'tel_number1' => 'required',
          'sexe' => 'nullable',
          'date_birth' => 'nullable',
          'commune_residence' => 'required',
          'categorie_permis_id' => 'required',
          'subvention_id' => 'nullable',
          'promo_code' => 'nullable',
      ]);
  }

  private function generateBarcode($code)
    {
        $generator = new BarcodeGeneratorHTML();
        return $generator->getBarcode($code, $generator::TYPE_CODE_128, 1, 40);
    }

    public function generateAndPrintReceipt($candidat)
    {
        $data = [
            'date' => "{$this->date} {$this->time}",
            'address' => 'Bonoumin, Cocody - Abidjan',
            'email' => 'Stock@Genius.Ci',
            'phone' => '+225 07 04 750 465',
            'client' => "{$this->name} {$this->surname}",
            'gender' => $this->sexe,
            'birth_date' => $this->date_birth,
            'client_phone' => $this->tel_number1,
            'store' => 'Genius Auto',
            'category' => $this->lib_categorie,
            'subsidy' => $this->lib_subvention,
            'remaining' => $this->reste,
            'total' => $this->total,
            'payment_method' => $this->moyen_payement,
            'qrCode' => $this->qrCode,
            'ticketNumber' => $candidat->matricule
        ];

        $pdf = PDF::loadView('candidat.receipt', $data);
        $pdfOutput = $pdf->output();
        $filename = "invoice_{$candidat->matricule}.pdf";
        $path = public_path("pdf/$filename");  // Chemin dans public

        // Vérifiez si le répertoire existe, sinon créez-le
        if (!file_exists(public_path('pdf'))) {
            mkdir(public_path('pdf'), 0777, true);
        }

        // Sauvegardez le fichier
        file_put_contents($path, $pdfOutput);

        // Stocker l'URL pour accéder au PDF
        session()->put('path_to_pdf', asset("pdf/$filename"));

        session()->put('moyen_payement', $this->moyen_payement);
        session()->put('reste', $this->reste);

        return $filename;


        // Passer l'URL du PDF à la vue pour téléchargement

      }



  protected function fetchAdditionalDetails()
  {
      $this->lib_categorie = CategorieModel::find($this->categorie_permis_id)->type ?? 'N/A';
      $this->lib_subvention = Subvention::find($this->subvention_id)->type_subvention ?? 0;
      $this->calculateTotal();
    }

  protected function calculateTotal()
  {
      $this->total = 180000; // Set the total amount
      $this->reste = $this->total - $this->lib_subvention;
      $this->apayer = $this->total - $this->reste;
    }

    public function store (){

      $validatedData = $this->validate([
          'name' => 'required|string',
          'surname' => 'required|string',
          'email' => 'nullable',
          'tel_number1' => 'required',
          'sexe' => 'nullable',
          'date_birth' => 'nullable',
          'commune_residence' => 'nullable',
          'categorie_permis_id' => 'required',
          'subvention_id' => 'nullable',
          'promo_code' => 'nullable',
          'moyen_payement' => 'nullable',
      ]);

     $candidat = CandidatModel::create([
          'name' => $this->name,
          'surname' => $this->surname,
          'email' => $this->email,
          'tel_number1' => $this->tel_number1,
          'sexe' => $this->sexe,
          'date_birth' => $this->date_birth,
          'commune_residence' => $this->commune_residence,
          'categorie_permis_id' => $this->categorie_permis_id,
          'subvention_id' => $this->subvention_id,
          'promo_code' => $this->promo_code,
          'moyen_payement' => $this->moyen_payement,
      ]);

     $this->qrCode = $this->generateBarcode($candidat->matricule);

     $this->generateAndPrintReceipt($candidat);


       // Redirection avec déclenchement du téléchargement
    return redirect()->to('/candidat/congrat')->with('downloadPdf', true);
    }

    public function restartComponent()
    {
      $this->reset();

        return redirect(request()->header('Referer'));
    }


    public function render()
    {
        return view('livewire.candidat-online');
    }
}
