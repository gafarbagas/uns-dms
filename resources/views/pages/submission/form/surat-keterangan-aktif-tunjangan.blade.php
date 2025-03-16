
<div class="font-weight-bold mb-3">Data Mahasiswa</div>
<div class="row mb-3">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="student_name">Nama</label>
            <input type="text" class="form-control @error('student_name') is-invalid @enderror" id="student_name" name="student_name" placeholder="Nama" value="{{ old('student_name') }}">
            @error('student_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="NIM" value="{{ old('nim') }}">
            @error('nim')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="study_program">Program Studi</label>
            <select type="text" class="form-control @error('study_program') is-invalid @enderror" id="study_program" name="study_program" placeholder="Program Studi">
                <option value="">Program Studi</option>
                <option value="Pendidikan Jasmani, Kesehatan, dan Rekreasi" {{ old('study_program') == 'Pendidikan Jasmani, Kesehatan, dan Rekreasi' ? 'selected' : '' }}>Pendidikan Jasmani, Kesehatan, dan Rekreasi</option>
                <option value="Pendidikan Kepelatihan Olahraga" {{ old('study_program') == 'Pendidikan Kepelatihan Olahraga' ? 'selected' : '' }}>Pendidikan Kepelatihan Olahraga</option>
            </select>
            @error('study_program')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="tingkat">Tingkat</label>
            <input type="text" class="form-control @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat" placeholder="Tingkat" value="{{ old('tingkat') }}">
            @error('tingkat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" placeholder="Semester" value="{{ old('semester') }}">
            @error('semester')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="font-weight-bold mb-3">Data Orang Tua/Wali</div>
<div class="row mb-3">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="parent_name">Nama Orang Tua</label>
            <input type="text" class="form-control @error('parent_name') is-invalid @enderror" id="parent_name" name="parent_name" placeholder="Nama" value="{{ old('parent_name') }}">
            @error('parent_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="nip">NIP / NRP</label>
            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="NIP / NRP" value="{{ old('nip') }}">
            @error('nip')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="rank">Jabatan</label>
            <input type="text" class="form-control @error('rank') is-invalid @enderror" id="rank" name="rank" placeholder="Jabatan" value="{{ old('rank') }}">
            @error('rank')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="group">Golongan</label>
            <input type="text" class="form-control @error('group') is-invalid @enderror" id="group" name="group" placeholder="Golongan" value="{{ old('group') }}">
            @error('group')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="room">Ruang</label>
            <input type="text" class="form-control @error('room') is-invalid @enderror" id="room" name="room" placeholder="Ruang" value="{{ old('room') }}">
            @error('room')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="institution_name">Instansi</label>
            <input type="text" class="form-control @error('institution_name') is-invalid @enderror" id="institution_name" name="institution_name" placeholder="Instansi" value="{{ old('institution_name') }}">
            @error('institution_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="marital_status">Pensiun / Janda</label>
            <input type="text" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status" name="marital_status" placeholder="Pensiun / Janda" value="{{ old('marital_status') }}">
            @error('marital_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="retirement_payment_book_number">Buku Pembayaran Pensiun No</label>
            <input type="text" class="form-control @error('retirement_payment_book_number') is-invalid @enderror" id="retirement_payment_book_number" name="retirement_payment_book_number" placeholder="Buku Pembayaran Pensiun No" value="{{ old('retirement_payment_book_number') }}">
            @error('retirement_payment_book_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
