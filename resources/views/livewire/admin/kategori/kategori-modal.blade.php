<div>
    <!-- Modal -->
    <div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content" style="overflow-y: auto;">
                <div class="modal-header {{ $updateMode ? 'alert-success' : 'alert-secondary' }}">
                    <h5 class="modal-title" id="kategoriModalLabel">
                        {{ $updateMode ? 'Edit Kategori' : 'Buat Kategori' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="modal-body ">
                        <input type="hidden" wire:model.defer="{{ $updateMode ? 'idKategori' : '' }}">
                        <div class="mb-3 form-group">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" wire:model.defer="state.nama"
                                class="form-control @error('nama') is-invalid @enderror" id="nama"
                                aria-describedby="namaHelp" placeholder="Masukkan nama kategori">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="btnModal" @if ($updateMode)
                            data-bs-dismiss="modal"
                            @endif
                            >{{ $updateMode ? 'Update Kategori' : 'Buat Kategori' }} <div wire:loading
                                wire:target="{{ $updateMode ? 'update' : 'store' }}">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
