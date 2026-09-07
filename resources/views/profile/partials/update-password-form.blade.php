<section class="my-4">
    <div class="card shadow rounded-3 border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="card-title mb-0">{{ __('Perbarui Kata Sandi') }}</h5>
            <small class="text-muted d-block mt-1">
                {{ __('Gunakan kata sandi yang panjang dan acak untuk meningkatkan keamanan akun Anda.') }}
            </small>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}" class="needs-validation mt-3" novalidate>
                @csrf
                @method('PUT')

                {{-- Kata Sandi Saat Ini --}}
                <div class="mb-3">
                    <label for="current_password" class="form-label fw-semibold">{{ __('Kata Sandi Saat Ini') }}</label>
                    <input type="password" name="current_password" id="current_password"
                        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                        required autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kata Sandi Baru --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">{{ __('Kata Sandi Baru') }}</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                        required autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Konfirmasi Kata Sandi --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">{{ __('Konfirmasi Kata Sandi') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                        required autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Simpan & Notifikasi --}}
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-key me-1"></i> {{ __('Simpan') }}
                    </button>

                    @if (session('status') === 'password-updated')
                        <span x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 3000)"
                            class="text-success small"
                        >
                            <i class="fas fa-check-circle me-1"></i> {{ __('Kata sandi berhasil diperbarui.') }}
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
