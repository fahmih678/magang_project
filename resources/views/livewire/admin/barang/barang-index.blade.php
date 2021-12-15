<div>
    @include('livewire.admin.barang.barang-modal')

    <div class="table-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Daftar Barang</h6>
                        <button type="button" wire:click.prevent="resetInputFields" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#barangModal">
                            <i class="lni lni-pencil-alt" aria-hidden="true"></i> Tambah Barang Baru
                        </button>
                    </div>
                    <div class="mt-3"></div>
                    <div class="table-wrapper">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Edit</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ ($barangs->currentpage() - 1) * $barangs->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td>

                                                <img class="mw-100" style="height: 100px;" src="{{ asset('storage/' . $barang->path_file) }}
                                                    ">
                                            </td>
                                            <td>{{ $barang->nama }}</td>
                                            <td>{{ $barang->jumlah }}</td>
                                            <td>{{ $barang->deskripsi }}</td>
                                            <td>
                                                @foreach ($barang->kategoris as $kategori)
                                                    <span
                                                        class="status-btn btn-success">{{ $kategori->nama ?? 'Tidak Memiliki Role' }}</span>
                                                @endforeach
                                            </td>

                                            <td>
                                                <button wire:click.prevent="edit({{ $barang->id }})" type="button"
                                                    class="btn text-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#barangModal">
                                                    <i class="lni lni-pencil" aria-hidden="true"></i>
                                                </button>
                                                <button class="btn text-danger"
                                                    wire:click="confirmDelete({{ $barang->id }})">
                                                    <i class="lni lni-trash-can" aria-hidden="true"></i>
                                                </button>
                                                <div wire:loading wire:target="edit({{ $barang->id }})">
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
    {{ $barangs->links() }}

</div>
