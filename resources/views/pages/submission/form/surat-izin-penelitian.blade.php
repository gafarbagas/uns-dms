
<div class="row mb-3">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="service_type">Jenis Layanan</label>
            <input type="text" class="form-control @error('service_type') is-invalid @enderror" id="service_type" name="service_type" placeholder="Jenis Layanan" value="{{ old('service_type') }}">
            @error('service_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
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
            <label for="pob">Tempat Lahir</label>
            <input type="text" class="form-control @error('pob') is-invalid @enderror" id="pob" name="pob" placeholder="Tempat Lahir" value="{{ old('pob') }}">
            @error('pob')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="bod">Tanggal Lahir</label>
            <input type="date" class="form-control @error('bod') is-invalid @enderror" id="bod" name="bod" placeholder="Tanggal Lahir" value="{{ old('bod') }}">
            @error('bod')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Alamat">{{ old('address') }}</textarea>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="font-weight-bold mb-3">Data Penelitian</div>
<div class="row mb-3">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="thesis_title">Judul Skripsi</label>
            <input type="text" class="form-control @error('thesis_title') is-invalid @enderror" id="thesis_title" name="thesis_title" placeholder="Judul Skripsi" value="{{ old('thesis_title') }}">
            @error('thesis_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="institution_name">Nama Instansi</label>
            <input type="text" class="form-control @error('institution_name') is-invalid @enderror" id="institution_name" name="institution_name" placeholder="Nama Instansi" value="{{ old('institution_name') }}">
            @error('institution_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="institution_city">Kota Instansi</label>
            <input type="text" class="form-control @error('institution_city') is-invalid @enderror" id="institution_city" name="institution_city" placeholder="Kota Instansi" value="{{ old('institution_city') }}">
            @error('institution_city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="head_of_institution">Nama Atasan Instansi</label>
            <input type="text" class="form-control @error('head_of_institution') is-invalid @enderror" id="head_of_institution" name="head_of_institution" placeholder="Nama Atasan Instansi" value="{{ old('head_of_institution') }}">
            @error('head_of_institution')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="research_address">Alamat Penelitian</label>
            <textarea type="text" class="form-control @error('research_address') is-invalid @enderror" id="research_address" name="research_address" placeholder="Alamat Penelitian">{{ old('research_address') }}</textarea>
            @error('research_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="research_date">Tanggal Mulai Penelitian</label>
            <input type="date" class="form-control @error('research_date') is-invalid @enderror" id="research_date" name="research_date" placeholder="Tanggal Mulai Penelitian" value="{{ old('research_date') }}">
            @error('research_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="research_object">Objek Penelitian</label>
            <input type="text" class="form-control @error('research_object') is-invalid @enderror" id="research_object" name="research_object" placeholder="Objek Penelitian" value="{{ old('research_object') }}">
            @error('research_object')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
