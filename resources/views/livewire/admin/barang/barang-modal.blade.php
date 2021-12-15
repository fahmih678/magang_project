<div>
    <!-- Modal -->
    <div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content" style="overflow-y: auto;">
                <div class="modal-header {{ $updateMode ? 'alert-success' : 'alert-secondary' }}">
                    <h5 class="modal-title" id="barangModalLabel">
                        {{ $updateMode ? 'Edit Barang' : 'Tambah Barang' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" wire:submit.prevent={{ $updateMode ? 'update' : 'store' }}>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="state.nama" class="form-label">Nama Barang</label>
                            <input type="text" wire:model.defer="state.nama"
                                class="form-control @error('state.nama') is-invalid @enderror" id="state.nama"
                                aria-describedby="namaHelp" placeholder="Masukkan Nama Barang">
                            @error('state.nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="state.jumlah" class="form-label">Jumlah Barang</label>
                            <input type="number" wire:model.defer="state.jumlah"
                                class="form-control @error('state.jumlah') is-invalid @enderror" id="state.jumlah"
                                aria-describedby="jumlahHelp" placeholder="Masukkan Jumlah Barang">
                            @error('state.jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="state.deskripsi" class="form-label">Deskripsi Barang</label>
                            <input type="text" wire:model.defer="state.deskripsi"
                                class="form-control @error('state.deskripsi') is-invalid @enderror" id="state.deskripsi"
                                aria-describedby="deskripsiHelp" placeholder="Masukkan Deskripsi Barang">
                            @error('state.deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>

                            @foreach ($kategoris as $kategori)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        wire:model.defer="barang_kategori.{{ $kategori->id }}"
                                        value="{{ $kategori->nama }}" id="{{ $kategori->id }}">
                                    <label class="form-check-label" for="{{ $kategori->id }}">
                                        {{ $kategori->nama }}
                                    </label>
                                </div>
                            @endforeach

                        </div>


                        <div class="mb-3">
                            <label for="state.path_file" class="form-label">Photo</label>
                            <input class="form-control @error('state.path_file') is-invalid @enderror" type="file"
                                id="state.path_file" wire:model.defer="state.path_file">
                            @error('state.path_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="resetInputFields" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" @if ($updateMode)
                            data-bs-dismiss="modal"
                            @endif
                            id="btnModal">{{ $updateMode ? 'Update Barang' : 'Tambah Barang' }} <div wire:loading
                                wire:target="{{ $updateMode ? 'update' : 'store' }}, state.path_file">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
