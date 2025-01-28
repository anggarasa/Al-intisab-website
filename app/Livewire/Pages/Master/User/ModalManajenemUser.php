<?php

namespace App\Livewire\Pages\Master\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ModalManajenemUser extends Component
{
    public $email, $role, $password, $password_confirmation;
    public $isEdit = false, $userId;

    // tambah user
    public function tambahUser()
    {
        try {
            $validated = $this->validate([
                'email' => 'required|string|email:dns,rfc,strict|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'role' => 'required|string',
            ]);

            // simpan user
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // simpan role
            if ($this->role === 'kurikulum') {
                $user->assignRole('kurikulum');
            } elseif ($this->role === 'master') {
                $user->assignRole('master');
            } elseif ($this->role === 'tu') {
                $user->assignRole('tu');
            }

            // menampilkan data real-time
            $this->dispatch('manajemen-user')->to(ManajemenUser::class);

            // reset input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil menambahkan data user.',
                'title' => 'Berhasil!',
            ]);
        } catch (\Exception $e) {
            // Kirim notifikasi error
            $this->dispatch('notificationMaster', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal!',
            ]);
        }
    }
    // End tambah user
    
    public function render()
    {
        return view('livewire.pages.master.user.modal-manajenem-user');
    }

    // reset input
    public function resetInput()
    {
        $this->reset(['email', 'password', 'role', 'password_confirmation', 'userId']);
        $this->isEdit = false;

        // close modal
        $this->dispatch('close-modal-crud-user');
    }

    // custom message
    protected $messages = [
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Email harus berupa alamat email yang valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password harus diisi.',
        'password.confirmed' => 'Password tidak cocok.',
        'password.min' => 'Password minimal 6 karakter.',
        'role.required' => 'Role harus diisi.',
    ];
}
