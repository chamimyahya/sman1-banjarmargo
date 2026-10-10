<label>Tanggal
    <input type="date" name="tanggal" value="{{ old('tanggal', isset($ubah) ? $ubah->tanggal->toDateString() : now()->toDateString()) }}" required>
</label>
<label>Judul
    <input type="text" name="judul" maxlength="160" value="{{ old('judul', $ubah->judul ?? '') }}" required>
</label>
<label>Ringkas
    <input type="text" name="ringkas" maxlength="220" value="{{ old('ringkas', $ubah->ringkas ?? '') }}" required>
</label>
<label>Isi
    <textarea name="isi" rows="5" maxlength="5000" required>{{ old('isi', $ubah->isi ?? '') }}</textarea>
</label>
