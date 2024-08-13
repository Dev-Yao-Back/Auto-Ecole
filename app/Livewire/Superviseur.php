<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidat;
use Carbon\Carbon;

class Superviseur extends Component
{
    public $candidates;
    public $totalRevenue;
    public $validatedRevenue;
    public $remainingRevenue;
    public $todayRevenue;
    public $totalCandidates, $validatedCandidates, $notValidatedCandidates, $nowValidatedCandidates, $weekValidatedCandidates;


    public function mount()
    {

      $this->filters['statut_id'] = '1';  // Initialize the filter to only show 'Pending' candidates
      $this->updateCandidateList();
        $this->statsRevenue();
      $this->loadCandidates();

      }

    public $filters = [
      'statut_id' => ''
  ];

  public function updatedFilters()
  {
      //$this->resetPage(); // If using pagination, reset to page 1
      $this->updateCandidateList();
  }


  public function resetFilters()
  {
      $this->filters = [
          'statut_id' => ''
      ];
      $this->updateCandidateList();
  }

  public function loadCandidates()
{
    $autoEcoleId = auth()->user()->auto_ecole_id; // Assurez-vous que l'utilisateur est lié à une auto-école
    $this->candidates = Candidat::query()
        ->when($this->filters['statut_id'], function ($query) {
            $query->where('statut_id', $this->filters['statut_id']);
        })
        ->where('auto_ecole_id', $autoEcoleId) // Filtrer par auto-école de l'utilisateur connecté
        ->get();
}


    public function validateCandidat($id)
    {
        $candidat = Candidat::find($id);
        if ($candidat && $candidat->statut_id != 2) {
            $candidat->statut_id = 2;
            $candidat->updated_at = Carbon::now();
            $candidat->save();
            $this->loadCandidates();
            $this->statsRevenue();
            session()->flash('success', 'Candidate validated successfully!');
        }
    }

  public function updateCandidateList()
  {
      $query = Candidat::query();

      if ($this->filters['statut_id']) {
          $query->where('statut_id', $this->filters['statut_id']);
      }

      $this->candidates = $query->get();
  }



  public function statsRevenue()
  {
      $autoEcoleId = auth()->user()->auto_ecole_id; // Obtenez l'ID de l'auto-école de l'utilisateur connecté

      // Utiliser 'when' pour ajouter conditionnellement le filtrage par auto-école
      $this->totalCandidates = Candidat::where('auto_ecole_id', $autoEcoleId)->count();
      $this->validatedCandidates = Candidat::where('auto_ecole_id', $autoEcoleId)->where('statut_id', 2)->count();
      $this->notValidatedCandidates = $this->totalCandidates - $this->validatedCandidates;
      $this->nowValidatedCandidates = Candidat::where('auto_ecole_id', $autoEcoleId)->where('statut_id', 2)->whereDate('updated_at', Carbon::today())->count();

      // Calculating this week's validated candidates
      $startOfWeek = Carbon::now()->startOfWeek();
      $endOfWeek = Carbon::now()->endOfWeek();
      $this->weekValidatedCandidates = Candidat::where('auto_ecole_id', $autoEcoleId)
          ->where('statut_id', 2)
          ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
          ->count();

      $this->totalRevenue = Candidat::where('auto_ecole_id', $autoEcoleId)->sum('amont');
      $this->validatedRevenue = Candidat::where('auto_ecole_id', $autoEcoleId)->where('statut_id', 2)->sum('amont');
      $this->remainingRevenue = $this->totalRevenue - $this->validatedRevenue;
      $this->todayRevenue = Candidat::where('auto_ecole_id', $autoEcoleId)->whereDate('updated_at', Carbon::today())->sum('amont');
  }


    public function render()
    {
        return view('livewire.superviseur');
    }
}