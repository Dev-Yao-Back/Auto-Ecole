<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Piece;
use App\Models\Source;
use App\Models\Subvention;
use App\Models\Candidat;
use App\Models\CandidatOnline;
use App\Models\CategorieModel;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PDF;
use App\Models\User;

class WizardForm extends Component
{
    use WithFileUploads;

    public $matricule; // Add this property to capture matricule
    public $date, $time;
    public $name, $surname, $phone1, $phone2, $father, $mother;
    public $sexe, $date_born, $source, $piece, $ref_piece, $piece_r, $piece_v;
    public $categorie, $subvention, $autre;
    public $subventions, $sources, $categories, $pieces;
    public $lib_categorie, $lib_subvention, $lib_piece, $lib_source;
    public $total, $reste, $apayer, $prix_normal, $montant;
    public $step = 1;
    public $isOpen = false;
    public $piece_rUrl, $piece_vUrl;
    public $qrCode, $ticketNumber, $receiptUrl;
    public $receipt = false;
    public $candidateRegistered = false;


    public function loadSources()
    {
        $this->sources = User::whereHas('roles', function ($query) {
            $query->where('name', 'commerciaux');
        })->get(['id', 'name', 'referral_code']);
    }

    public function mount($categories, $subventions, $sources, $pieces)
    {

        $this->name = '';
        $this->surname = '';
        $this->phone1 = '';
        $this->phone2 = '';
        $this->father = '';
        $this->mother = '';
        $this->sexe = '';
        $this->source = '';
        $this->piece = '';
        $this->ref_piece = '';
        $this->piece_r = '';
        $this->piece_v = '';
        $this->categorie = null; // Initialize the selected category
        $this->autre = '';
        $this->lib_piece = '';
        $this->lib_source = '';

        $this->date = now()->format('d/m/Y');
        $this->time = now()->format('H:i:s');
        $this->prix_normal = 180000;
        $this->loadSources();
        $this->subventions = $subventions;
        $this->categories = $categories;
        $this->pieces = $pieces;

    }

    public function fetchCandidatOnline()
    {
        // Validate matricule input
        $validatedData = $this->validate([
            'matricule' => 'required|string|exists:candidat_onlines,matricule',
        ]);

        // Find the CandidatOnline using the matricule
        $candidatOnline = CandidatOnline::where('matricule', $this->matricule)->first();

        if (!$candidatOnline) {
            session()->flash('error', 'Le Candidat est introuvable.');
            return;
        }

        // Check if the CandidatOnline is already marked as "Inscrit"
    if ($candidatOnline->libelle === 'Inscrit') { // Assuming there is a 'status' field
      session()->flash('error', 'Ce Candidat est déjà inscrit.');
      return;
  }

        // Populate the form fields with CandidatOnline data
        $this->name = $candidatOnline->name;
        $this->surname = $candidatOnline->surname;
        $this->phone1 = $candidatOnline->tel_number1;
        $this->phone2 = ''; // Assuming there's no phone2 in CandidatOnline
        $this->father = ''; // Assuming no father information in CandidatOnline
        $this->mother = ''; // Assuming no mother information in CandidatOnline
        $this->sexe = $candidatOnline->sexe;
        $this->date_born = optional($candidatOnline->date_birth)->format('d/m/Y');

        $this->source = $candidatOnline->promo_code;
        $this->piece = ''; // Assuming piece is not part of CandidatOnline
        $this->ref_piece = ''; // Assuming reference piece is not part of CandidatOnline
        $this->categorie = $candidatOnline->categorie_permis_id;
        $this->subvention = $candidatOnline->subvention_id;
        $this->autre = ''; // Assuming no other information in CandidatOnline

        // Calculate payments based on subvention
        $this->calculatePayment();

        // Flash success message
        session()->flash('success', 'Les données du Candidat Online ont été chargées avec succès.');
    }

    public function first_check()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone1' => 'required',
            'phone2' => '',
            'father' => 'required',
            'mother' => 'required',
            'date_born' => 'required',
            'sexe' => 'required',
            'piece' => 'required',
            'source' => 'required',
            'categorie' => 'required',
            'subvention' => 'required',
            'ref_piece' => 'required',
            'piece_r' => 'required|file',
            'piece_v' => 'required|file',
            'autre' => '',
        ]);

        $this->piece_rUrl = $this->piece_r ? $this->piece_r->temporaryUrl() : null;
        $this->piece_vUrl = $this->piece_v ? $this->piece_v->temporaryUrl() : null;
        $this->ticketNumber = $this->generateTicketNumber();
        $this->qrCode = $this->generateBarcode($this->ticketNumber);

        $this->lib_categorie = CategorieModel::find($this->categorie)->type ?? 'N/A';
        $this->lib_subvention = Subvention::find($this->subvention)->type_subvention ?? 'N/A';
        $this->lib_piece = Piece::find($this->piece)->type_piece ?? 'N/A';
       // $this->lib_source = Source::find($this->source)->name ?? 'N/A';

        $this->next_step();
    }

    public function calc_check()
    {
        $this->validate([
            'montant' => 'required|numeric|min:0',
        ]);

        $this->calculatePayment();
    }

    private function calculatePayment()
    {
        $subventionValue = $this->lib_subvention ?? 0;
        $montantPaye = $this->montant ?? 0;

        $this->apayer = $this->prix_normal - $subventionValue;
        $this->reste = $this->apayer - $montantPaye;
        $this->total = $montantPaye + $subventionValue;
    }

    private function resetCalculation()
    {
        $this->apayer = 0;
        $this->reste = 0;
        $this->total = 0;
        $this->montant = 0;
    }

    public function next_step()
    {
      if ($this->step == 3) {
        $this->step = 3;
      } else {
        $this->step = $this->step + 1;
      }

      $this->calculatePayment();
    }

    public function preview_step()
    {
      if ($this->step == 1) {
        $this->step = 1;
      } else {
        $this->step = $this->step - 1;
      }
      $this->calculatePayment();
    }

    public function upload_check()
    {
        $this->validate([
            'piece_r' => 'required|file',
            'piece_v' => 'required|file',
        ]);

        $this->piece_rUrl = $this->piece_r->temporaryUrl();
        $this->piece_vUrl = $this->piece_v->temporaryUrl();
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    private function generateTicketNumber()
    {
        return strtoupper(Str::random(12));
    }

    private function generateBarcode($code)
    {
        $generator = new BarcodeGeneratorHTML();
        return $generator->getBarcode($code, $generator::TYPE_CODE_128, 1, 40);
    }

    public function store()
    {
        $rectoPath = $this->piece_r->store('uploads', 'public');
        $versoPath = $this->piece_v->store('uploads', 'public');

        $validatedData = $this->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone1' => 'required',
            'phone2' => '',
            'father' => 'required',
            'mother' => 'required',
            'date_born' => 'required',
            'sexe' => 'required',
            'piece' => 'required',
            'source' => 'required',
            'categorie' => 'required',
            'subvention' => 'required',
            'ref_piece' => 'required',
            'piece_r' => 'required|file',
            'piece_v' => 'required|file',
            'autre' => '',
        ]);

        // Vérifiez d'abord si un Candidat Online avec le même matricule existe
    $candidatOnline = CandidatOnline::where('matricule', $this->matricule)->first();

    if ($candidatOnline) {
        // Changez le statut du Candidat Online

        $candidatOnline->libelle = 'Inscrit';
        $candidatOnline->save();

        // Utilisez le matricule du Candidat Online pour le nouveau candidat
        $newMatricule = $candidatOnline->matricule;
    } else {
        // Générez un nouveau matricule si aucun Candidat Online n'est trouvé
        $newMatricule = $this->generateTicketNumber();
    }

        Candidat::create([
            'name' => $this->name,
            'matricule' => $newMatricule,
            'surname' => $this->surname,
            'tel_number1' => $this->phone1,
            'tel_number2' => $this->phone2,
            'name_dad' => $this->father,
            'name_moom' => $this->mother,
            'date_birth' => $this->date_born,
            'sexe' => $this->sexe,
            'number_piece' => $this->ref_piece,
            'piece_id' => $this->piece,
            'promo_code' => $this->source,
            'amont' => $this->total,
            'categorie_permis' => $this->categorie,
            'subvention_id' => $this->subvention,
            'lib_subvention' => $this->lib_subvention,
            'reste' => $this->reste,
            'autre' => $this->autre,
            'piece_rec' => $rectoPath,
            'piece_ver' => $versoPath,
            'moyen_payement' => 1,
            'statut_id' => 1 ,

        ]);

        $this->open();
        $this->candidateRegistered = true;
    }

    public function generateAndPrintReceipt()
    {
        $data = [
            'date' => "{$this->date} {$this->time}",
            'address' => 'Bonoumin, Cocody - Abidjan',
            'email' => 'Stock@Genius.Ci',
            'phone' => '+225 07 04 750 465',
            'client' => "{$this->name} {$this->surname}",
            'gender' => $this->sexe,
            'birth_date' => $this->date_born,
            'client_phone' => $this->phone1,
            'store' => 'Genius Auto',
            'category' => $this->lib_categorie,
            'price' => $this->prix_normal,
            'subsidy' => $this->lib_subvention,
            'paid' => $this->montant,
            'remaining' => $this->reste,
            'total' => $this->total,
            'payment_method' => 'Cash',
            'qrCode' => $this->qrCode,
            'ticketNumber' => $this->ticketNumber
        ];

        $queryParams = http_build_query($data);
        $this->receiptUrl = route('show.receipt') . '?' . $queryParams;
        $this->receipt = true;
    }

    public function resetReceipt()
    {
        $this->receipt = false;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->surname = '';
        $this->phone1 = '';
        $this->phone2 = '';
        $this->father = '';
        $this->mother = '';
        $this->sexe = '';
        $this->date_born = '';
        $this->source = '';
        $this->piece = '';
        $this->ref_piece = '';
        $this->piece_r = '';
        $this->piece_v = '';
        $this->categorie = '';
        $this->subvention = '';
        $this->autre = '';
        $this->lib_categorie = '';
        $this->lib_subvention = '';
        $this->lib_piece = '';
        $this->lib_source = '';
        $this->total = 0;
        $this->reste = 0;
        $this->apayer = 0;
        $this->montant = 0;
        $this->piece_rUrl = '';
        $this->piece_vUrl = '';
        $this->qrCode = '';
        $this->ticketNumber = '';
        $this->receiptUrl = '';
        $this->receipt = false;
        $this->candidateRegistered = false;
    }

    public function restartComponent()
    {
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.wizard-form');
    }
}