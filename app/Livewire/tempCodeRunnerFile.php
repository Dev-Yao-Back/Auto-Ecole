<?php
$first_check_data = $this->validate([
        'name' => 'required',
        'surname' => 'required',
        'phone1' => 'required',
        'phone2' => '',
        'father' => 'required',
        'mother' => 'required',
        'date_born' => 'required',
        'sexe' => 'required',
        'source' => 'required',
        'categorie' => 'required',
        'subvention' => 'required',
        'autre' => '', 
      ]);