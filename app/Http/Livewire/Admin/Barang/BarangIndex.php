<?php

namespace App\Http\Livewire\Admin\Barang;

use App\Models\Barang;
use App\Models\BarangKategori;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BarangIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    public $alertName = "Barang";
    public $state = [];
    public $barang;
    public $barangId;
    public $barang_kategori = [];
    public $kategoriBarang;
    public $listKategori;

    public $updateMode = false;

    protected $listeners = [
        'destroy',
        'cancelled'
    ];

    public function render()
    {
        return view('livewire.admin.barang.barang-index', [
            'barangs' => Barang::paginate(10),
            'kategoris' => Kategori::all(),

        ]);
    }
    public function store()
    {
        $this->validate(
            [
                'state.nama' => ['required'],
                'state.deskripsi' => ['required'],
                'state.jumlah' => ['integer'],
                'state.path_file' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]
        );
        $ekstensi = $this->state['path_file']->getClientOriginalExtension();
        $file = $this->state['path_file'];
        $name = $this->state['nama'] . "-" . Carbon::now()->timestamp . "." . $ekstensi;

        try {
            $this->state['path_file'] = $file->storePubliclyAs(
                '/barang',
                $name,
                'public'
            );
            $this->barang = Barang::create($this->state);

            foreach ($this->barang_kategori as $key => $value) {
                if (!($this->barang->hasKategori($value))) {
                    if ($value) {
                        BarangKategori::create(['id_barang' =>  $this->barang->id, 'id_kategori' => $key]);
                    }
                } else if (!($value)) {
                    BarangKategori::where(['id_barang' => $this->barang->id, 'id_kategori' => $key])->delete();
                }
            }

            $this->alert('success', 'Berhasil membuat ' . $this->alertName . ' ' . $this->state['nama'], [
                'position' =>  'center',
                'timer' =>  1500,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
            $this->resetInputFields();
        } catch (\Throwable $th) {
            dd($th);
            $this->alert('error', 'Gagal membuat ' . $this->alertName . ' ' . $this->state['nama'], [
                'position' =>  'center',
                'timer' =>  1500,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        }
    }
    public function edit(Barang $barang)
    {
        if ($barang) {
            $this->resetInputFields();
            $this->updateMode = true;
            $this->barang = $barang;
            $this->state = $barang->toArray();

            $this->kategoriBarang = $barang->barangKategori->map(fn ($kategori) => $kategori->kategori);

            foreach ($this->kategoriBarang as $kategori) {

                $this->barang_kategori[$kategori->id] = $kategori->nama;
            }
        }
    }

    public function update()
    {
        $validatedData = Validator::make($this->state, [
            'state.nama' => 'required',
            'state.deskripsi' => ['required'],
            'state.jumlah' => ['integer'],
            'state.path_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $barang = Barang::where('id', $this->barang->id)->first();

        try {
            if ($this->state['path_file'] != $barang->path_file) {
                if (Storage::disk('public')->exists($barang->path_file)) {
                    Storage::disk('public')->delete($barang->path_file);
                }

                $ekstensi = $this->state['path_file']->getClientOriginalExtension();
                $file = $this->state['path_file'];
                $name = $this->state['nama'] . "-" . Carbon::now()->timestamp . "." . $ekstensi;
                $this->state['path_file'] = Storage::putFileAs('barang', $file, $name);
                $this->state['path_file'] = $file->storePubliclyAs(
                    '/barang',
                    $name,
                    'public'
                );

                $this->barang->update($this->state);
            } else {
                $name = $this->state['path_file'];
                $this->barang->update($this->state);
            }


            foreach ($this->barang_kategori as $key => $value) {
                if (!($this->barang->hasKategori($value))) {
                    if ($value) {
                        BarangKategori::create(['id_barang' =>  $this->barang->id, 'id_kategori' => $key]);
                    }
                }
                if (!($value)) {
                    BarangKategori::where(['id_barang' => $this->barang->id, 'id_kategori' => $key])->delete();
                }
            }
            $this->alert('success', $this->alertName . ' berhasil di update menjadi ' . $this->barang['nama'], [
                'position' =>  'center',
                'timer' =>  1500,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
            $this->resetInputFields();
        } catch (\Throwable $th) {
            dd($th);
            $this->resetInputFields();
            $this->alert('error', $this->alertName . ' ' . $barang['nama'] . ' Gagal di update', [
                'position' =>  'center',
                'timer' =>  1500,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        }
    }


    public function destroy()
    {
        $id = $this->barangId;
        try {
            $barang = Barang::where('id', $id)->first();
            $save = $barang;
            Storage::disk('public')->delete($barang->path_file);
            Barang::destroy($barang->id);

            $this->alert('success', $this->alertName . ' ' .  $save['nama'] . ' berhasil di hapus', [
                'position' =>  'center',
                'timer' =>  1500,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Gagal menghapus ' . $this->alertName, [
                'position' =>  'center',
                'timer' =>  1500,
                'toast' =>  false,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        }
    }
    public function confirmDelete($id)
    {
        $this->barangId = $id;
        $barang = Barang::where('id', $id)->get();
        $this->confirm('Hapus Barang ' . $barang[0]->nama . '?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'destroy',
            'onCancelled' => 'cancelled',
            'text' =>  'Pastikan barang yang dipilih benar...',
        ]);
    }


    public function cancelled()
    {
        $this->alert('info', 'info cancel', [
            'position' =>  'center',
            'timer' =>  3000,
            'toast' =>  false,
            'text' =>  'Pastikan data barang yang di pilih benar',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    public function resetInputFields()
    {
        $this->state = [];
        $this->barang = null;
        $this->updateMode = false;
        $this->barangId = null;
        $this->barang_kategori = [];
    }
}
