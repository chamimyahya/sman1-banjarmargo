-- Jalankan hanya pada database pengujian cms_sekolahku_test.
-- Skrip ini hanya memperbarui tabel settings, tidak mengubah konten pengguna, berita, atau akun.
UPDATE `settings`
SET `value` = CASE `key`
  WHEN 'site_name' THEN 'SMAN 1 Banjar Margo'
  WHEN 'site_tagline' THEN 'Berilmu, Berkarakter, Berprestasi'
  WHEN 'site_description' THEN 'Website resmi SMAN 1 Banjar Margo untuk informasi profil sekolah, berita, pengumuman, agenda, prestasi, dan layanan pendidikan.'
  WHEN 'site_logo_text' THEN 'SMAN 1 BANJAR MARGO'
  WHEN 'site_logo_icon' THEN 'fas fa-school'
  WHEN 'contact_phone' THEN ''
  WHEN 'contact_email' THEN ''
  WHEN 'contact_address' THEN ''
  WHEN 'contact_hours' THEN ''
  WHEN 'social_facebook' THEN ''
  WHEN 'social_instagram' THEN ''
  WHEN 'social_youtube' THEN ''
  WHEN 'social_tiktok' THEN ''
  WHEN 'meta_author' THEN 'SMAN 1 Banjar Margo'
  WHEN 'meta_keywords' THEN 'SMAN 1 Banjar Margo, sekolah menengah atas, pendidikan, berita sekolah, pengumuman sekolah, prestasi siswa'
  WHEN 'meta_description' THEN 'Website resmi SMAN 1 Banjar Margo. Informasi profil, kegiatan, berita, pengumuman, agenda, prestasi, dan layanan sekolah.'
  WHEN 'hero_badge' THEN 'Website Resmi Sekolah'
  WHEN 'hero_title' THEN 'Selamat Datang di <span class="text-gradient">SMAN 1 Banjar Margo</span>'
  WHEN 'hero_subtitle' THEN 'Mewujudkan Generasi Cerdas, Berkarakter, dan Berdaya Saing Global.'
  WHEN 'hero_btn_primary_text' THEN 'Profil Sekolah'
  WHEN 'hero_btn_primary_url' THEN '#profile'
  WHEN 'hero_btn_secondary_text' THEN 'Hubungi Kami'
  WHEN 'hero_btn_secondary_url' THEN '#contact'
  WHEN 'spmb_url' THEN '#contact'
  WHEN 'hero_stats' THEN '[]'
  WHEN 'principal' THEN '{}'
  WHEN 'about' THEN '{"image":"/images/sman1-school-placeholder.svg","content_title":"Profil SMAN 1 Banjar Margo","content_1":"SMAN 1 Banjar Margo menyajikan informasi resmi mengenai profil, kegiatan, berita, prestasi, dan layanan sekolah melalui website ini.","content_2":"Informasi visi, misi, sejarah, fasilitas, serta data sekolah perlu dilengkapi oleh pengelola berdasarkan data resmi sekolah.","accreditation":"","accreditation_label":"","highlights":["Informasi profil sekolah","Berita dan pengumuman","Agenda dan kegiatan","Prestasi dan galeri"]}'
  WHEN 'section_settings' THEN REPLACE(`value`, 'SekolahKu', 'SMAN 1 Banjar Margo')
  WHEN 'page_banners' THEN REPLACE(`value`, 'SekolahKu', 'SMAN 1 Banjar Margo')
  WHEN 'footer_description' THEN 'Website resmi SMAN 1 Banjar Margo sebagai pusat informasi sekolah, kegiatan, prestasi, dan layanan pendidikan.'
  WHEN 'footer_copyright' THEN 'Informasi resmi sekolah.'
  WHEN 'footer_services' THEN '[{"label":"Akademik","url":"#programs"},{"label":"Kesiswaan","url":"#extracurriculars"},{"label":"Prestasi Siswa","url":"#achievements"},{"label":"Agenda Sekolah","url":"#events"}]'
  WHEN 'footer_links' THEN '[{"label":"Berita & Informasi","url":"/news"},{"label":"Galeri","url":"#gallery"},{"label":"Pusat Unduhan","url":"/downloads"},{"label":"Kontak Sekolah","url":"/contact"}]'
  WHEN 'theme_color' THEN 'default'
  WHEN 'counter_stats' THEN '[]'
  ELSE `value`
END,
`updated_at` = CURRENT_TIMESTAMP
WHERE `key` IN (
  'site_name','site_tagline','site_description','site_logo_text','site_logo_icon',
  'contact_phone','contact_email','contact_address','contact_hours',
  'social_facebook','social_instagram','social_youtube','social_tiktok',
  'meta_author','meta_keywords','meta_description','hero_badge','hero_title',
  'hero_subtitle','hero_btn_primary_text','hero_btn_primary_url','hero_btn_secondary_text',
  'hero_btn_secondary_url','spmb_url','hero_stats','principal','about','section_settings',
  'page_banners','footer_description','footer_copyright','footer_services','footer_links',
  'theme_color','counter_stats'
);
