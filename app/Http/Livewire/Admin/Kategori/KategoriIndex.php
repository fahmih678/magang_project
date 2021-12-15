<?php

namespace App\Http\Livewire\Admin\Kategori;


use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class KategoriIndex extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $alertName = "Kategori";

    public $state = [];
    public $kategori;
    public $kategoriId;

    public $updateMode = false;

    protected $listeners = [
        'destroy',
        'resetInputFields',
    ];


    public function render()
    {
        return view('livewire.admin.kategori.kategori-index', [
            'kategoris' => Kategori::paginate(10)
        ]);
    }


    public function store()
    {
        $validatedData = Validator::make($this->state, [
            'nama' => 'required'
        ])->validate();

        try {
            Kategori::create($this->state);
            $this->alert('success', 'Berhasil membuat ' . $this->alertName, [
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
            $this->alert('error', 'Gagal membuat ' . $this->alertName, [
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

    public function edit(Kategori $kategori)
    {
        $this->resetInputFields();
        $this->updateMode = true;
        $this->kategori = $kategori;
        $this->state = $kategori->toArray();
    }

    public function update()
    {
        $validatedData = Validator::make($this->state, [
            'nama' => 'required'
        ])->validate();
        try {
            $this->kategori->update($this->state);
            $this->alert('success', $this->alertName . ' berhasil update', [
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
            $this->alert('error', $this->alertName . ' Gagal update', [
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

    public function confirmDestroy($id)
    {
        $this->kategoriId = $id;
        $this->confirm('Hapus Kategori ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'batal',
            'onConfirmed' => 'destroy',
            'onCancelled' => 'resetInputFields',
            'text' =>  'Anda dapat membuat penilaian yang lain',
        ]);
    }

    public function destroy()
    {
        $id = $this->kategoriId;;
        try {
            Kategori::destroy($id);
            $this->alert('success', $this->alertName . ' berhasil di hapus', [
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
    public function resetInputFields()
    {
        $this->updateMode = false;
        $this->state = [];
        $this->kategoriId = null;
    }
}
