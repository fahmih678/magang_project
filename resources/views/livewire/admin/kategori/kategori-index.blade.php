<div>
    @include('livewire.admin.kategori.kategori-modal')
    <div class="table-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <div class="card-style mb-30">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Daftar Kategori</h6>
                        <button type="button" wire:click.prevent="resetInputFields" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#kategoriModal">
                            <i class="lni lni-pencil-alt" aria-hidden="true"></i> Add New Kategori
                        </button>
                    </div>
                    <div class="mt-3"></div>
                    <div class="table-wrapper">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($kategoris as $kategori)
                                        <tr>
                                            <td>{{ ($kategoris->currentpage() - 1) * $kategoris->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td>{{ $kategori->nama }}</td>
                                            <td>
                                                <button wire:click.prevent="edit({{ $kategori->id }})" type="button"
                                                    class="btn text-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#kategoriModal">
                                                    <i class="lni lni-pencil" aria-hidden="true"></i>
                                                </button>
                                                <button class="btn text-danger"
                                                    wire:click="confirmDestroy({{ $kategori->id }})">
                                                    <i class="lni lni-trash-can" aria-hidden="true"></i>
                                                </button>
                                                <div wire:loading wire:target="edit({{ $kategori->id }})">
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                </div>
                                                <div wire:loading wire:target="confirmDestroy({{ $kategori->id }})">
                                                    <span class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $kategoris->links() }}

</div>
