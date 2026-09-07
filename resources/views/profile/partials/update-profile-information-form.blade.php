<section class="my-4">
    <div class="card shadow rounded-3 border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="card-title mb-0">{{ __('Informasi Profil') }}</h5>
            <small class="text-muted d-block mt-1">
                {{ __("Perbarui informasi nama dan email akun Anda.") }}
            </small>
        </div>

        <div class="card-body">
            {{-- Form Verifikasi Email --}}
            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                @csrf
            </form>

            {{-- Form Update Profil --}}
            <form method="POST" action="{{ route('profile.update') }}" class="needs-validation mt-3" novalidate>
                @csrf
                @method('PATCH')

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">{{ __('Nama') }}</label>
                    <input type="text" id="name" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">

                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required autocomplete="username">

                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    {{-- Verifikasi Email --}}
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2 text-warning small">
                            <p class="mb-1">
                                <i class="fas fa-exclamation-circle me-1"></i> {{ __('Alamat email Anda belum diverifikasi.') }}
                            </p>
                            <button form="send-verification" class="btn btn-sm btn-outline-secondary">
                                {{ __('Kirim Ulang Email Verifikasi') }}
                            </button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="text-success mt-2 small">
                                    {{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Tombol Submit --}}
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> {{ __('Simpan') }}
                    </button>

                    {{-- Notifikasi Berhasil --}}
                    @if (session('status') === 'profile-updated')
                        <span x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 3000)"
                            class="text-success small"
                        >
                            <i class="fas fa-check-circle me-1"></i> {{ __('Tersimpan.') }}
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
