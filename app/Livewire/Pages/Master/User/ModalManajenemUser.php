<?php

namespace App\Livewire\Pages\Master\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Validation\Rule;

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

    // Update user
    #[On('editUser')]
    public function editUser($id)
    {
        $this->isEdit = true;
        $user = User::find($id);
        $this->userId = $user->id;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()->first();

        // open modal
        $this->dispatch('modal-crud-user');
    }

    public function updateUser()
    {
        try {
            // Validasi input
            $validated = $this->validate([
                'email' => 'required|string|email:dns,rfc,strict|unique:users,email,' . $this->userId,
                'password' => 'nullable|confirmed|min:6',
                'role' => 'required|string',
            ]);

            // Temukan user yang akan diupdate
            $user = User::findOrFail($this->userId);

            // Update email
            $user->email = $validated['email'];

            // Update password jika diisi
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            // Simpan perubahan
            $user->save();

            // Update role
            $user->syncRoles([]); // Hapus semua role yang ada
            if ($validated['role'] === 'kurikulum') {
                $user->assignRole('kurikulum');
            } elseif ($validated['role'] === 'master') {
                $user->assignRole('master');
            } elseif ($validated['role'] === 'tu') {
                $user->assignRole('tu');
            }

            // Menampilkan data real-time
            $this->dispatch('manajemen-user')->to(ManajemenUser::class);

            // Reset input
            $this->resetInput();

            // Kirim notifikasi success
            $this->dispatch('notificationMaster', [
                'type' => 'success',
                'message' => 'Berhasil mengupdate data user.',
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
    // End Update user
    
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
