<label>Tanggal
    <input type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" required>
</label>
<label>Judul
    <input type="text" name="judul" maxlength="160" required>
</label>
<label>Ringkas
    <input type="text" name="ringkas" maxlength="220" required>
</label>
<label>Isi
    <textarea name="isi" rows="5" maxlength="5000" required></textarea>
</label>
