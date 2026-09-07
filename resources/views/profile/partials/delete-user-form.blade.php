<section class="my-4">
    <div class="card shadow border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="card-title mb-0 text-danger">
                <i class="fas fa-user-slash me-1"></i> {{ __('Hapus Akun') }}
            </h5>
            <small class="text-muted d-block mt-1">
                {{ __('Setelah akun Anda dihapus, semua data akan hilang secara permanen. Harap unduh data penting sebelum melanjutkan.') }}
            </small>
        </div>

        <div class="card-body">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
                <i class="fas fa-trash-alt me-1"></i> {{ __('Hapus Akun') }}
            </button>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ __('Konfirmasi Hapus Akun') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">
                        <p class="mb-3">
                            {{ __('Setelah dihapus, akun dan data Anda akan hilang secara permanen. Masukkan kata sandi Anda untuk melanjutkan.') }}
                        </p>

                        <div class="mb-3">
                            <label for="delete_password" class="form-label fw-semibold">{{ __('Kata Sandi') }}</label>
                            <input type="password" name="password" id="delete_password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" placeholder="{{ __('Masukkan kata sandi Anda') }}" required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> {{ __('Hapus Permanen') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
