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
            <textarea type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Alamat">
                {{ old('address') }}
            </textarea>
            @error('address')
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
            <label for="year">Tahun Masuk</label>
            <input type="text" class="yearpicker form-control @error('year') is-invalid @enderror" id="year" name="year" placeholder="Tahun Masuk" value="{{ old('year') }}">
            @error('year')
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
    <div class="col-sm-12">
        <div class="form-group">
            <label for="institution_name">Institusi</label>
            <input type="text" class="form-control @error('institution_name') is-invalid @enderror" id="institution_name" name="institution_name" placeholder="Institusi" value="{{ old('institution_name') }}">
            @error('institution_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/yearpicker/yearpicker.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/yearpicker/yearpicker.js') }}" async></script>
    <script>
        document.getElementById('year').addEventListener('keydown', function(event) {
            event.preventDefault(); // Prevent any keypress
        });
    
        document.getElementById('year').addEventListener('keypress', function(event) {
            event.preventDefault(); // Prevent any keypress
        });
    </script>
@endpush