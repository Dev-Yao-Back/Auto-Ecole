<div class="modal modal-sheet position-absolute  d-block bg-secondary bg-opacity-10 py-2 " style="height:100vh;"   role="dialog" id="modalSheet">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
        @include('dons.components.receipt')
      <div class="modal-footer flex-column border-top-0">
        <a wire:click="generateAndPrintReceipt" class="btn btn-lg btn-primary w-100 mx-0 mb-2">Immprimé</a>
      </div>
       @if($receipt)
        <iframe src="{{ $receiptUrl }}" style="display:none;" onload="this.contentWindow.print(); @this.call('resetReceipt');"></iframe>
    @endif
    </div>
  </div>
</div>

