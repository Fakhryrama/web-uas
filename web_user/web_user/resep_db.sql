CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(64) NOT NULL,
  `pass` varchar(64) NOT NULL
);


INSERT INTO `admin` (`id_admin`, `nama_admin`, `pass`) VALUES
(1, 'admin', 'admin123');

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `judul_resep` varchar(255) NOT NULL,
  `deskripsi_resep` varchar(255) NOT NULL,
  `bahan_resep` text NOT NULL,
  `cara_resep` text NOT NULL,
  `gambar_resep` varchar(255) NOT NULL
);

INSERT INTO `resep` (`id_resep`, `judul_resep`, `deskripsi_resep`, `bahan_resep`, `cara_resep`, `gambar_resep`) VALUES
(3, 'Nasi Goreng', 'Nasi goreng adalah hidangan khas Indonesia berupa nasi goreng berbumbu gurih, biasanya disajikan dengan telur, daging, dan pelengkap seperti kerupuk.', '+ Nasi putih - 2 piring (gunakan nasi yang sudah dingin agar teksturnya tidak lembek)\r\n+ Bawang putih - 3 siung\r\n+ Bawang merah - 2 butir\r\n+ Cabai merah atau rawit (opsional) - sesuai selera, iris halus\r\n+ Kecap manis - 2 sendok makan\r\n+ Garam - secukupnya\r\n+ Merica bubuk - secukupnya\r\n+ Telur - 1 butir (opsional, untuk membuat telur orak-arik)\r\n+ Minyak goreng atau margarin - 2 sendok makan\r\n+ Sayuran (opsional) - seperti wortel cincang, kacang polong, atau daun bawang iris\r\n+ ayam suwir, udang, sosis, atau bakso.', '+ Panaskan wajan dengan minyak goreng atau margarin. Jika menggunakan telur, buat orak-arik terlebih dahulu, lalu sisihkan.\r\n+ Tumis bawang putih, bawang merah, dan cabai hingga harum.\r\n+ Masukkan ayam, udang, sosis, atau bakso. Tumis hingga matang.\r\n+ Masukkan nasi putih dingin ke dalam wajan. + Aduk rata dengan bumbu dan bahan lainnya.\r\n+ Tambahkan kecap manis, garam, dan merica bubuk. Aduk hingga bumbu merata dan nasi berwarna kecokelatan.\r\n+ Jika tadi telur orak-arik disisihkan, campurkan kembali ke dalam nasi goreng. Aduk sebentar hingga semuanya tercampur.\r\n+ Pindahkan nasi goreng ke piring saji. \r\n+ Tambahkan kerupuk, irisan mentimun, dan tomat sebagai pelengkap.', 'img/nasi_goreng.jpg'),
(4, 'Bubur Ayam', 'Bubur ayam adalah bubur nasi khas Indonesia yang disajikan dengan ayam suwir, kerupuk, kacang, daun bawang, dan kuah kuning gurih.', '+ Beras - 200 gram (1 gelas)\r\n+ Air - 1,5 liter (atau sesuai kekentalan yang diinginkan)\r\n+ Daun salam - 2 lembar\r\n+ Garam - 1 sendok teh\r\n+ Kaldu ayam - secukupnya (opsional, untuk rasa lebih gurih)\r\n+ Daging ayam - 300 gram (paha atau dada)\r\n+ Bawang putih - 3 siung (haluskan)\r\n+ Bawang merah - 3 butir (haluskan)\r\n+ Kunyit - 1 ruas (haluskan)\r\n+ Jahe - 1 ruas (haluskan)\r\n+ Lengkuas - 1 ruas (geprek)\r\n+ Serai - 1 batang (geprek)\r\n+ Kecap manis - 2 sendok makan\r\n+ Garam dan gula - secukupnya\r\n+ Kaldu bubuk - secukupnya\r\n+ Kerupuk - secukupnya\r\n+ Irisan daun bawang - 2 batang\r\n+ Irisan seledri - 1 batang\r\n+ Bawang goreng - secukupnya\r\n+ Sambal - sesuai seleraKecap manis dan kecap asin - secukupnya', '+ Cuci beras hingga bersih, lalu masukkan ke dalam panci.\r\n+ Masak beras dengan air, tambahkan daun salam dan garam. Aduk sesekali agar tidak lengket di dasar panci.\r\n+ Masak hingga tekstur beras menjadi bubur. Jika air berkurang, tambahkan sedikit demi sedikit. Sesuaikan kekentalan bubur sesuai selera.\r\n+ Tumis bumbu halus (bawang putih, bawang merah, kunyit, jahe) bersama lengkuas, serai, daun salam, dan daun jeruk hingga harum.\r\n+ Masukkan ayam ke dalam tumisan bumbu. \r\n+ Tambahkan air, kecap manis, garam, gula, dan kaldu bubuk. Masak hingga ayam matang dan kuah meresap.\r\n+ Angkat ayam, lalu suwir-suwir. Sisihkan kuah untuk disiram ke bubur.\r\n+ Ambil bubur panas ke dalam mangkuk.\r\n+ Tambahkan suwiran ayam di atasnya.\r\n+ Siram dengan kuah ayam.\r\n+ Taburkan daun bawang, seledri, dan bawang goreng.\r\n+ Tambahkan kerupuk, sambal, kecap manis, dan kecap asin sesuai selera.', 'img/bubur_ayam.jpg'),
(5, 'Mie Goreng Jawa', 'Mie goreng Jawa adalah mie goreng khas Indonesia dengan bumbu rempah seperti bawang, kemiri, dan kecap manis, disajikan dengan telur, sayuran, dan ayam atau udang.', '+ Mie telur - 200 gram (rebus dan tiriskan)\r\n+ Daging ayam - 100 gram (rebus, suwir-suwir)\r\n+ Kol - 100 gram (iris tipis)\r\n+ Daun bawang - 2 batang (iris kasar)\r\n+ Telur ayam - 1 butir (untuk orak-arik)\r\n+ Garam - secukupnya\r\n+ Kecap manis - 3-4 sendok makan (sesuai selera)\r\n+ Bawang merah goreng - untuk taburan\r\n+ Minyak goreng - 2-3 sendok makan\r\n+ Bawang putih - 4 siung\r\n+ Merica bubuk - 1/2 sendok teh\r\n+ Kemiri - 2 butir (sangrai) ', '+ Rebus mie hingga matang, tiriskan, dan tambahkan sedikit minyak agar tidak lengket.\r\n+ Haluskan semua bumbu halus menggunakan blender atau cobek.\r\n+ Panaskan minyak di wajan. Tumis bumbu halus hingga harum.\r\n+ Geser bumbu ke sisi wajan, lalu tuang telur. Aduk hingga menjadi orak-arik.\r\n+ Masukkan ayam suwir, aduk hingga merata.\r\n+ Masukkan kol, Tumis hingga sayuran sedikit layu.\r\n+ Masukkan mie yang sudah direbus. \r\n+ Tambahkan kecap manis, garam, dan merica bubuk.\r\nAduk hingga semua bahan tercampur rata dan mie berubah warna kecokelatan.\r\nMasukkan irisan daun bawang, aduk sebentar, lalu angkat.\r\nPindahkan mie goreng ke piring saji. Taburi bawang merah goreng di atasnya. Sajikan dengan acar, kerupuk, dan potongan jeruk nipis untuk menambah kesegaran.', 'img/mie_goreng_jawa.jpg'),
(6, 'Nasi Pecel', 'Nasi pecel adalah hidangan khas Indonesia berupa nasi dengan sayuran rebus, disiram bumbu kacang, dan dilengkapi lauk seperti tempe, rempeyek, atau tahu.', '+ Nasi putih secukupnya.\r\n+ Bayam, petik daunnya.\r\n+ Kacang panjang, potong-potong.\r\n+ Tauge, bersihkan.\r\n+ Kol, iris tipis.\r\n+ Daun kemangi (opsional).\r\n+ Timun, potong dadu kecil.\r\n+ 200 gram kacang tanah, goreng.\r\n+ 4 siung bawang putih.\r\n+ 3 lembar daun jeruk (buang tulangnya).\r\n+ 3 buah cabai rawit merah (sesuaikan tingkat kepedasan).\r\n+ 2 buah cabai merah keriting.\r\n+ 1 sendok teh garam.\r\n+ 2 sendok makan gula merah, sisir.\r\n+ 1 sendok teh asam jawa, larutkan dengan sedikit air panas.\r\n+ Air matang secukupnya (untuk mengencerkan bumbu).\r\n+ Rempeyek kacang.\r\n+ Tempe goreng.\r\n+ Tahu goreng.', '+ Rebus masing-masing jenis sayuran (bayam, kacang panjang, tauge, dan kol) secara terpisah hingga matang, kemudian tiriskan.\r\n+ Tata sayuran rebus di piring saji.\r\n+ Goreng kacang tanah hingga matang, tiriskan, lalu haluskan menggunakan ulekan atau blender.\r\n+ Haluskan bawang putih, cabai rawit, cabai merah, daun jeruk, garam, dan gula merah.\r\n+ Campur kacang tanah yang sudah dihaluskan dengan bumbu halus tadi.\r\n+ Tambahkan air asam jawa dan air matang sedikit demi sedikit hingga mencapai kekentalan bumbu yang diinginkan.\r\n+ Letakkan nasi putih di piring.\r\n+ Tata sayuran rebus di atas nasi.\r\n+ Siram dengan bumbu pecel secukupnya.\r\n+ Tambahkan pelengkap seperti tempe, tahu goreng, rempeyek.', 'img/nasi_pecel.jpg'),
(7, 'Nasi Gudeg', 'Gudeg adalah makanan khas Yogyakarta yang terbuat dari nangka muda yang dimasak dengan santan dan bumbu-bumbu hingga menghasilkan rasa manis gurih.', '+ 1 kg nangka muda, potong kecil-kecil\r\n+ 10 butir telur rebus (opsional, dikupas)\r\n+ 500 ml santan kental\r\n+ 1 liter santan cair\r\n+ 5 lembar daun salam\r\n+ 3 cm lengkuas, memarkan\r\n+ 10 butir bawang merah\r\n+ 6 siung bawang putih\r\n+ 3 butir kemiri, sangrai\r\n+ 1 sdt ketumbar\r\n+ 100 gram gula merah (sesuai selera)\r\n+ 1 sdt garam', '+ Siapkan nangka muda yang sudah dipotong-potong kecil. Rebus hingga empuk dan tiriskan.\r\n+ Masukkan nangka rebus ke dalam panci besar. Tambahkan daun salam, lengkuas, dan telur rebus.\r\n+ Tuangkan santan cair hingga nangka terendam.\r\n+ Haluskan semua bahan bumbu, lalu masukkan ke dalam panci bersama gula merah dan garam. Aduk rata.\r\n+ Masak dengan api kecil hingga santan hampir habis, lalu tuang santan kental.\r\n+ Aduk perlahan agar santan tidak pecah. Masak selama 3-4 jam atau hingga bumbu meresap dan warna berubah kecokelatan.\r\n+ Sajikan gudeg dengan nasi putih hangat.\r\n+ Tambahkan lauk pelengkap seperti ayam opor, tahu, tempe, telur pindang, dan sambal goreng krecek.', 'img/nasi_gudeg.jpeg');

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `resep_favorit` text NOT NULL
);

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);


ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;