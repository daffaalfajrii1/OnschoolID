-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Des 2022 pada 22.09
-- Versi server: 10.3.37-MariaDB-cll-lve
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onschool_web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Onschool Indonesia', 'admin@school.id', '$2y$10$S537UsFvWXFrRmBxI6UPJuVIgnVpBCQ2erl/dAlRaXR1l1YM4H1OS', '2022-02-21 06:30:03', '2022-12-11 19:45:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_mentor` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `biaya` int(11) DEFAULT NULL,
  `kode_unik` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` enum('Belum Bayar','Terbayar','Menunggu Konfirmasi') DEFAULT NULL,
  `status_kelas` enum('Tidak Aktif','Berjalan','Selesai') DEFAULT NULL,
  `snap_token` text DEFAULT NULL,
  `bukti_transfer` text DEFAULT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `billing`
--

INSERT INTO `billing` (`id`, `id_member`, `id_mentor`, `id_kelas`, `biaya`, `kode_unik`, `total`, `status`, `status_kelas`, `snap_token`, `bukti_transfer`, `nilai_akhir`, `created_at`, `updated_at`) VALUES
(15, 5, 2, 5, 5000000, 719, 5000719, 'Terbayar', 'Selesai', '5f8ffbcf-bbdd-497b-bc59-8258ec947187', '1668394605.jpg', 100, '2022-11-14 02:38:53', '2022-11-14 08:29:43'),
(17, 6, 2, 5, 5000000, 401, 5000401, 'Belum Bayar', 'Tidak Aktif', 'f6a4c0da-58d6-40f9-a412-b6c80410bf22', NULL, NULL, '2022-11-14 09:45:23', '2022-11-14 09:45:24'),
(20, 7, 2, 5, 5000000, 350, 5000350, 'Terbayar', 'Selesai', '279ec87f-eea7-4f39-99f5-ee3e091cd3ac', NULL, 100, '2022-11-14 09:55:11', '2022-11-14 12:10:44'),
(24, 6, 7, 9, 0, 0, 0, 'Terbayar', 'Berjalan', NULL, NULL, NULL, '2022-11-14 10:40:29', '2022-11-14 10:40:29'),
(25, 7, 7, 9, 0, 0, 0, 'Terbayar', 'Berjalan', NULL, NULL, NULL, '2022-11-14 10:41:10', '2022-11-14 10:41:10'),
(26, 8, 7, 10, 5000, 481, 5481, 'Terbayar', 'Selesai', '94179b08-6e78-4d94-a9cd-8884e286a294', NULL, 100, '2022-11-14 12:24:07', '2022-11-14 12:54:35'),
(27, 9, 7, 10, 5000, 727, 5727, 'Terbayar', 'Selesai', '2c74069f-c921-4f19-99a0-9c32480961c9', '1668432316.PNG', 100, '2022-11-14 12:48:12', '2022-11-15 09:47:51'),
(28, 12, 7, 10, 5000, 791, 5791, 'Belum Bayar', 'Tidak Aktif', 'bc9ad60b-4998-459a-8793-3cc89aa6570a', NULL, NULL, '2022-11-15 08:57:33', '2022-11-15 08:57:33'),
(29, 11, 7, 10, 5000, 766, 5766, 'Terbayar', 'Selesai', 'f48938cc-e3fa-43bc-a4b3-acfc152f4db2', '1668580813.jpeg', 100, '2022-11-15 09:49:11', '2022-11-17 08:20:56'),
(30, 6, 7, 10, 5000, 839, 5839, 'Terbayar', 'Selesai', '5764abb8-a007-4388-85dc-ff43b9fac64e', '1668509347.jpeg', 100, '2022-11-15 10:41:04', '2022-11-15 10:50:21'),
(31, 11, 10, 11, 0, 0, 0, 'Terbayar', 'Berjalan', NULL, NULL, NULL, '2022-11-19 13:24:44', '2022-11-19 13:24:44'),
(32, 84, 15, 14, 0, 0, 0, 'Terbayar', 'Berjalan', NULL, NULL, NULL, '2022-12-19 15:23:39', '2022-12-19 15:23:39'),
(33, 82, 15, 14, 0, 0, 0, 'Terbayar', 'Selesai', NULL, NULL, 100, '2022-12-26 12:58:38', '2022-12-26 12:58:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `view` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `blog`
--

INSERT INTO `blog` (`id`, `judul`, `isi`, `gambar`, `slug`, `view`, `created_at`, `updated_at`) VALUES
(4, 'Raih Juara 2 JR-Rovation Kategori Sosial, Onschool Indonesia Siap Berikan Dampak kepada Daerah', '<p>Jakarta, <strong>Onschool Indonesia</strong> - Tim Onschool Indonesia berhasil menang Juara 2 Kategori Sosial di Kompetisi JR-Rovation 2022. Program kompetisi yang diinisiasi oleh BUMN ini diselenggarakan oleh PT&nbsp;Jasa Raharja untuk mengajak generasi muda lebih peduli terhadap isu keselamatan di jalan raya.</p>\r\n\r\n<p>&quot;Kami ingin mengapresiasi inovator muda dari kalangan mahasiswa di seluruh Indonesia atas inovasi dan partisipasi aktif dalam mendukung keselamatan berkendara guna menurunkan angka kecelakaan lalu-lintas,&quot; kata Direktur Utama Jasa Raharja Rivan A. Purwantono. Sabtu, 3 Desember 2022. Jasa Marga memberikan hadiah uang tunai bagi para menang kompetisi inovasi jalan raya tersebut sebesar :</p>\r\n\r\n<p>Rp 70.000.000 untuk Juara 1<br />\r\nRp 50.000.000 untuk Juara 2<br />\r\nRp 30.000.000 untuk Juara 3.</p>\r\n\r\n<p>Berdasarkan hasil beberapa fase seleksi hingga terpilihlah 10 finalis. Mereka mempresentasikan secara langsung ide inovatif di hadapan Dewan Juri Kompetisi JR-Rovation 2022 di The Ice Palace, Jakarta&nbsp;pada Kamis, 1 Desember 2022</p>\r\n\r\n<p>Para juri terdiri Rio Octaviano dari Road Safety Association, Fitra Eri selaku jurnalis/pemerhati otomotif, serta perwakilan sponsor di antaranya Astra Honda Motor (AHM), Wuling Motor, Amazon Web Service (AWS), dan World Health Organization.</p>\r\n\r\n<p>Setelah melalui perundingan yang seksama, dewan juri pun sepakat untuk mengumumkan 3 besar pemenang untuk masing-masing kategori yaitu: Kategori sains, Kategori sosial.&nbsp;Tim Onschool Indonesia yang berasal dari Universitas Bengkulu menunjukkan kualitasnya pada ajang tersebut dengan berhasil meraih gelar juara 2 pada kategori sosial dengan menghadirkan inovasi untuk permainan anak yang akan menjadi upaya preventif dalam pencegahan kecelakaan sejak dini.&nbsp;</p>\r\n\r\n<p>Adapun tim onschool indonesia tersebut terdiri dari ketua tim Dani Fazli (Program Studi Teknik Elektro Universitas Bengkulu) serta anggota tim Muhammad Daffa Alfajri dan Aisyah Amalia (Program Studi Informatika Universitas Bengkulu).</p>\r\n\r\n<p>&quot;Perjuangan menuju torehan ini tidak mudah, tentu membutuhkan persiapan matang dari berbagai lini agar tercapai tujuan utama.&quot; ujar Dani Fazli, Ketua Tim Onschool Indonesia.&nbsp;</p>\r\n\r\n<p>Dani Fazli juga menceritakan bagaimana mereka kesulitan proses awal yang sulit disaat ruang kreativitas hingga pengurusan administrasi di kampus dipersempit, dan mereka tetap berjuang hingga memenangkan Juara 2 &nbsp;di JR-Rovation ini.&nbsp;</p>\r\n\r\n<p>&quot;Sebelum di Jakarta, Kami berpartisipasi pada KMI Expo XIII di Jawa Timur. Kami menyadari bahwa saat itu benar-benar kurang memuaskan karena minimnya persiapan dari tim serta pihak kampus,&quot; tambah Dani.</p>\r\n\r\n<p>Dani juga berharap kedepannya pihak kampus dan tim-tim kontingen Universitas Bengkulu dapat mengevaluasi persiapan guna memperoleh hasil yang memuaskan.</p>', '1670757316.jpeg', 'raih-juara-2-jr-rovation-kategori-sosial-onschool-indonesia-siap-berikan-dampak-kepada-daerah', 41, '2022-12-11 11:11:50', '2022-12-24 08:28:44'),
(5, 'Misi Besar Mahasiswa sebagai Agen Perubahan Dunia Literasi', '<p>Provinsi Bengkulu atau terkenal dengan provinsi yang memiliki bunga endemik nan eksotis ini sekarang perlaham berbenah, baik dari segi pembangunan infrastruktur hingga pembangunan sumber daya.</p>\r\n\r\n<p>Terbukti, hingga hari ini, torehan prestasi demi prestasi diperoleh baik dari sektor pemerintahan maupun sumber daya masyakat yang perlahan menunjukkan kompetensinya dikancah nasional dan internasional.</p>\r\n\r\n<p><strong>Perkembangan itu Dimulai dari Kepedulian Terhadap Literasi</strong></p>\r\n\r\n<p>Kepedulian terhadap literasi telah menjadi sesuatu keharusan bagi setiap elemen bermasayarakat dan bernegara, perpustakaan tentu menjadi salah satu garda terdepan dalam peningkatan masyarakat yang melek literasi sebagaimana yang tertuang dalam Undang Undang RI Nomor 43 Tahun 2007 tentang perpustakaan.</p>\r\n\r\n<p>Perpustakaan di Provinsi Bengkulu bukanlah perpustakaan yang tertinggal. Bahkan Perpustakaan Lentera Buana Desa Tanjung Anom, Bengkulu pernah menunjukkan taringnya sebagai Juara 2 perpustakaan terbaik nasional klaster B. Tidak sampai disitu, Perpustakan Universitas Bengkulu yang sudah terakreditas A juga sudah menggandeng perpustakaan MPR sebagai wujud keseriusan dalam menangani pengembangan lingkungan literasi.</p>\r\n\r\n<p>Dalam beberapa kesempatan, Duta Baca Perpustakaan Universitas Bengkulu melakukan kunjungan ke beberapa perpustakaan desa yang ada di Provinsi Bengkulu dan sudah ada beberapa perpustakaan desa yang sudah memanfaatkan akses perkembangan teknologi informasi.</p>\r\n\r\n<p>Pada saat sesi diskusi, Duta Baca Perpustakaan Desa Karang Jaya Kabupaten Rejang Lebong juga mengingatkan &ldquo;Sudah seharusnya antar perpustakaan di Provinsi Bengkulu saling membantu agar misi untuk memajukan masyarakat yang aktif berliterasi segera terwujud, dan Perpustakaan desa karang jaya juga membuka seluas &ndash; luasnya peluang untuk bekerja sama&rdquo;.</p>\r\n\r\n<p>Tentu hal ini menjadi angin segar bagi perkembangan literasi di Provinsi Bengkulu, dan tentu tidak akan berkembang apabila antar elemen dan sektor baik dimasyarakat, pemerintahan ataupun instansi terkait tidak saling mendukung dalam misi mewujudkan literasi masyarakat yang berkemajuan.</p>\r\n\r\n<p>Harapannya, akan banyak muncul agen perubahan yang memberikan inovasi&ndash;inovasi terbaiknya untuk perkembangan Provinsi Bengkulu.</p>\r\n\r\n<p><strong>Literasi Digital Tugas Siapa?</strong></p>\r\n\r\n<p>Jika berbicara pengembangan dan ketertinggalan tentu membuat stigma baru bahwa ada dualisme oknum yang berseberangan saling menyalahkan, yakni pemerintah dan generasi muda atau lebih tepatnya mahasiswa.</p>\r\n\r\n<p>Tentu hal tersebut akan terkesan terlalu kuno apabila tidak diselesaikan dengan kolaborasi, tentu dalam mewujudkan literasi digital perlu kolaborasi bersama, lagi-lagi kolaborasi mejadi kunci dalam perumusan penyelesaian permasalahan. Di Provinsi Bengkulu sendiri juga sedang marak <em>trend</em>&nbsp;digitalisasi terutama pada sektor ekonomi dan pendidikan. Online school atau onschool contohnya, merupakan terobosan dari mahasiswa Universitas Bengkulu yang tentunya harus terus didukung karena karya anak bangsa ini harus diapresiasi setinggi mungkin.</p>', '1670787614.jpeg', 'misi-besar-mahasiswa-sebagai-agen-perubahan-dunia-literasi', 64, '2022-12-11 19:38:45', '2022-12-25 14:28:53'),
(6, 'Trend Citayam Fashion Week Meredup, Mungkinkah Hal tersebut adalah Alat Politik?', '<p><strong>Prolog Masalah</strong></p>\r\n\r\n<p>Partisipasi politik dalam sebuah Negara demokrasi merupakan sesuatu yang substansial. Salah satu alasan yang mendasar terkait hal tersebut adalah karena salah satu indikator kualitas demokrasi ditentukan oleh tinggi dan rendah serta bagaimana partisipasi politik tersebut dilakukan. Partisipasi politik adalah kegiatan seseorang atau kelompok orang untuk ikut serta secara aktif dalam kehidupan politik, antara lain dengan jalan memilih pimpinan negara dan secara langsung atau tidak langsung memengaruhi kebijakan pemerintah. Kegiatan ini mencakup tindakan seperti memberikan suara dalam pemilihan umum, menghadiri rapat umum, mengadakan hubungan dengan pejabat pemerintah atau anggota perlemen. Akan tetapi seiring berkembangnya demokrasi muncul kelompok-kelompok yang juga ingin mempengaruhi proses pengambilan kebijakan. Salah satu kelompok partisipan dalam pemilu adalah kelompok pemilih muda. Batasan pemuda dimulai dari usia 16 tahun mengikuti penetapan umur anak muda yang dilakukan oleh Perserikatan BangsaBangsa, sedangkan batas umur anak muda sampai 30 tahun didasari oleh UU Kepemudaan No. 40 tahun 2009 pasal 1 tentang : Pemuda adalah warga negara Indonesia yang memasuki periode penting pertumbuhan dan perkembangan yang berusia 16 (enam belas) sampai 30 (tiga puluh) tahun. Pemilih muda ini dapat menjadi kekuatan tersendiri dalam pemilu, antusias kelompok ini cukup tinggi dan mayoritas kelompok ini ingin memberikan suaranya pada setiap pemilu yang ada.</p>\r\n\r\n<p><strong>Pemuda berperan dipartai politik atau ada kepentingan?</strong></p>\r\n\r\n<p>Pemuda yang dibahas penulis dalam tulisan ini yakni mahasiswa, dimana ada sekitar 8,2 juta pemuda berlabel kata MAHASISWA itu yang tersebar dari sudut Kota Sabang hingga ke sekitaran Pulau Merauke. Berdasarkan studi kasus dari penulis yakni mahasiswa Universitas Bengkulu, bahwa saat ini kepentingan dan ketulusan mahasiswa sudah dicampuri kepentingan pribadi yang seharusnya tidak hadir dalam idealisme seorang pemuda.</p>\r\n\r\n<p>Jika berbicara kepentingan kelompok dan sifatnya masih memberi dampak untuk bersama tentu sudah menjadi hal yang lumrah terjadi di negara ini, namun jikalau kepentingan pribadi berada diatas kepentingan bersama, tentu hanya akan menghadirkan luka baru bagi bumi pertiwi kedepannya. Dalam beberapa diskusi dan pertemuan dengan elit politik kampus, tentu landasan, tuntutan dan aspirasi yang katanya milik rakyat mayoritas tidak berlandasan, dan ironinya adalah disaat mahasiswa dan pemuda yang mudah menjual nama RAKYAT tanpa ada validasi dari rakyat mana yang diperjuangkan.</p>\r\n\r\n<p>Hal ini semakin diperparah dengan fakta bahwa jajaran demisioneris fungsional pejabat kampus kebanyakan menjadikan jabatan struktural sebagai batu loncatan untuk kepentingan pribadinya. Lantas sama siapa lagi masyarakat berhadap jika orang yang disebut <em>agent of change </em>telah berubah menjadi <em>agent </em>untuk dirinya sendiri, yang seharusnya menjadi sosial kontrol masyarakat namun mengontrol masyarakat untuk kepentingannya.</p>\r\n\r\n<p><strong>Pergerakan dan Kemunafikan</strong></p>\r\n\r\n<p>Tentu hal ini sudah menjadi pekerjaan rumah bersama dan sebenarnya harus dibenahi, dalam suatu konsolidasi yang diikuti penulis, ada seorang aktivis yang berucap &ldquo;Mari bersama saling menggenggam dan berjuang hanya untuk rakyar&rdquo;, disambut dengan aktivis lainnya &ldquo;Pergerakan kita adalah pergerakan yang murni hadir dari rahim rakyar&rdquo;. Tentu penulis sepakat dengan dua kalimat penyemangat tersebut, namun disatu sisi penulis kecewa karena 2 orang yang mengucapkan kalimat perjuangan itu datang telat 3 jam dari waktu yang telah disepakati, tentu ini secara tidak langsung telah mencederai nilai &ndash; nilai dan norma kedisiplinan dalam pergerakan.</p>\r\n\r\n<p>Penulis merasakan pilu yang teramat dalam disaat menulis opini ini, seakan sekat &ndash; sekat kepentingan sudah menjadi lumrah dalam pergerakan mahasiswa dan pemuda, sudah tidak ada lagi kata kemurnian dan ketulusan dalam bergerak yang membuat arah negeri semakin tidak jelas. Sebelum menanamkan nilai &ndash; nilai demokrasi tentu kita harus sama &ndash; sama berkomitmen dan menanamkan nilai &ndash; nilai dan norma sosial.</p>\r\n\r\n<p><strong>Berteriaklah Atas Nama Kebenaran</strong></p>\r\n\r\n<p>Tulisan ini dihadirkan dengan harapan akan menularnya semangat perjuangan dan semangat membela kebenaran demi kebaikan bangsa kedepannya. Penafsiran mahasiswa terhadap makna dan esensi dari kata politik masih sangat prematur, hal tersebut dikarenakan rendahnya tingkat pemahaman dan melek politik dikalangan pemuda saat ini. Pemuda dan mahasiswa seakan kehilangan arahnya, tidak ada lagi ketulusan dalam perjuangan, tidak ada lagi perlawanan dalam setiap tulisan &ndash; tulisan yang dihadirkan, jangan sampai nantinya pemuda hanya menjadi salah satu alat politik dan diberdayakan oleh oknum &ndash; oknum yang tidak bertanggung jawab.</p>\r\n\r\n<p>Dalam sedikit pengalaman penulis, tentu menemukan banyak hal yang sangat mengecewakan dan menyedihkan, bukankah semua sepakat bahwa kampus adalah miniatur negara? Tapi mengapa masih ada elit politik kampus yang hanya bergerak untuk kepentingan pribadi? Permasalahan &ndash; permasalahan kampus tentunya sudah sangat banyak, tetapi mengapa aktivis hari ini seakan dibuat buta dan tuli dalam menyikapi iklimpolitik yang sedang tidak baik &ndash; baik saja.</p>', '1670924674.jpg', 'trend-citayam-fashion-week-meredup-mungkinkah-hal-tersebut-adalah-alat-politik', 35, '2022-12-13 09:44:34', '2022-12-26 08:56:14'),
(7, 'Tips Menulis Judul Karya Tulis Antimainstream bagi Kau Ambis', '<p>Karya tulis ilmiah merupakan sesuatu yang lumrah terdengar dikalangan&nbsp;<a href=\"https://www.anakteknik.co.id/blog/search?title=mahasiswa\" target=\"_blank\">mahasiswa</a>. Bahkan, sudah bisa dipastikan mayoritas mahasiswa pernah membaca atau mendengar karya tulis ilmiah.&nbsp;</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>Apa itu karya&nbsp;tulis ilmiah?</strong></h3>\r\n\r\n<p>Menurut Peraturan Kepala Lembaga Ilmu Pengetahuan Indonesia nomor 04/E/2012, karya tulis ilmiah merupakan tulisan hasil ulasan, analisa, kajian ataupun pemikiran secara sistematis yang memenuhi kaidah ilmiah.</p>\r\n\r\n<p>Mengapa mahasiswa harus mengenal karya tulis ilmiah? Seperti yang diketahui bahwa setiap mahasiswa memiliki tugas akhir berupa<a href=\"https://www.anakteknik.co.id/blog/search?title=skripsi\" target=\"_blank\">&nbsp;skripsi</a>&nbsp;ataupun karya tulis ilmiah. Disisi lain, karya tulis ilmiah ini juga tertuang dalam kompetisi yang bervariasi. Setiap tahun, &nbsp;Kemendikbud-ristek mengadakan kompetisi karya tulis ilmiah mahasiswa seperti Program Kreativitas Mahasiswa dengan kegiatan puncak PIMNAS atau pekan ilmiah nasional.</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>Bagaimana menyusun judul karya ilmiah anti mainstream?&nbsp;</strong></h3>\r\n\r\n<p>Judul merupakan hal yang paling mendasar dalam karya tulis. Hal tersebut dikarenakan pembaca memilih membaca karya tulis ilmiah ketertarikan judul.</p>\r\n\r\n<h3 style=\"color:#212529; font-style:normal\">1. Perbanyak kosakata</h3>\r\n\r\n<p>Tidak dapat dipungkiri, judul karya tulis ilmiah rata - rata memiliki nilai kompleksitas yang berbeda. Sebelum ke sana, ada baiknya perbanyak kosakata yang ada sehingga melancarkan penulisan judul.</p>\r\n\r\n<h3 style=\"color:#212529; font-style:normal\">2. Perluas wawasan</h3>\r\n\r\n<p>Banyak orang beranggapan kata - kata kompleks akan menjadi jurus ampuh dalam menulis judul. Namun di era globalisasi tidak bisa menulis judul menggunakan kalimat - kalimat kuno. Maka dari itu perluas wawasan, salah satunya dengan membaca.</p>\r\n\r\n<h3 style=\"color:#212529; font-style:normal\">3. Hindari kalimat bertele - tele</h3>\r\n\r\n<p>Judul karya tulis ilmiah biasanya mencakup banyak kata hubung, contohnya&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>&quot;Rancang bangun pada mesin pencacah yang otomatis dan mampu mencacah dalam kapasitas besar dalam upaya otomatisasi dunia industri dan mendukung era industri 4.0&quot;.</p>\r\n</blockquote>\r\n\r\n<p>Berdasarkan contoh judul karya tulis ilmiah tersebut, itu termasuk kalimat tidak efektif. Sebab dapat menghadirkan kesan buruk diawal bagi pembaca.</p>\r\n\r\n<h3 style=\"color:#212529; font-style:normal\">4. Hindari akronim yang sukar dibaca atau dipahami</h3>\r\n\r\n<p>Mahasiswa biasanya suka dengan yang unik dan menarik. Walau begitu, sangat tidak direkomendasikan apabila menghadirkan akronim yang sulit dipahami.</p>\r\n\r\n<p>Contohnya&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>&quot;SISPIAAI : Sistem pintar integrasi agribisnis berbasis artificial intelligence dalam upaya digitalisasi pertanian berkelanjutan&quot;</p>\r\n</blockquote>\r\n\r\n<p>Pembacaan akronim tersebut menyulitkan juri menilai karya tulis ilmiah. Cukup berikan akronim singkat dan mudah dibaca seperti&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>Onschool : Online School sebagai langkah konkrit dalam penerapan edutech di kalangan mahasiswa</p>\r\n</blockquote>\r\n\r\n<p>Jadi menurut kamu, apakah menulis judul karya tulis ilmiah itu sulit? Jikalau masih sulit, bisa dipastikan kamu belum melakukan praktik langsung.</p>', '1670925923.jpeg', 'tips-menulis-judul-karya-tulis-antimainstream-bagi-kau-ambis', 3, '2022-12-13 10:05:23', '2022-12-19 08:31:32'),
(8, 'Anak Teknik Belajar Mata Kuliah Kewirausahaan?', '<p>Mahasiswa fakultas teknik cenderung menjadi konsumen produk aktif. Kesibukan yang sangat menyita waktu, sehingga terasa sedikit tidak mungkin&nbsp;<a href=\"https://www.anakteknik.co.id/blog/search?title=mahasiswa%20teknik\" target=\"_blank\">mahasiswa teknik</a>&nbsp;terjun berbisnis.</p>\r\n\r\n<p>Mayoritas&nbsp;<a href=\"https://www.anakteknik.co.id/blog/search?title=mahasiswa%20baru\" target=\"_blank\">mahasiswa baru</a>&nbsp;tidak ada niat untuk berwirausaha. Tidak ada ekspektasi lebih terhadap hal yang berkaitan dengan kewirausahaan.</p>\r\n\r\n<p>Mahasiswa fakultas teknik terkesan sebagai calon engineer yang terlihat tabu membicarakan bisnis. Nyatanya, hal tersebut sudah tidak berlaku lagi untuk saat ini. Sebelumnya hanya mahasiswa fakultas ekonomi, bisnis maupun sosial yang cenderung aktif membahas kewirausahaan.</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>Program kuliah diluar jurusan dan prodi</strong></h3>\r\n\r\n<p><a href=\"https://www.anakteknik.co.id/blog/search?title=industri%204.0\" target=\"_blank\">Era industri 4.0</a>&nbsp;dan&nbsp;<a href=\"https://www.anakteknik.co.id/haditf19/articles/pendidikan-indonesia-untuk-masuk-ke-era-society-50\" target=\"_blank\">society 5.0</a>&nbsp;membuktikan saat ini mahasiswa diberikan kesempatan yang sangat luas untuk belajar apapun. Dalam menjalankan misinya, Kementerian Pendidikan Kebudayaan Riset dan Teknologi memiliki program bagi mahasiswa yang ingin belajar diluar program studinya.</p>\r\n\r\n<p>Contohnya, program pembinaan mahasiswa wirausaha atau P2MW, Inovasi wirausaha digital mahasiswa atau IWDM hingga program wirausaha merdeka. itu adalah contoh kecil yang bisa diikuti oleh mahasiswa untuk mengembangkan kemampuan berwirausaha.</p>\r\n\r\n<p>Sebagian besar mahasiswa teknik di Indonesia bahkan juga memiliki mata kuliah kewirausahaan. Mata kuliah tersebut tertuang pada mata kuliah umum atau mata kuliah wajib.</p>\r\n\r\n<p>Lantas bagaimana mata kuliah kewirausahaan di teknik? Apakah anak teknik diminta untuk berjualan komputer atau motor?</p>\r\n\r\n<p>Jawabannya adalah tidak.</p>\r\n\r\n<p>Mata kuliah kewirausahaan di fakultas teknik itu disama ratakan terhadap fakultas lain. Hal tersebut tentunya membuat anak teknik harus mengetahui kewirausahaan lebih jauh.</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>Kewirausahaan masa kini itu punya Anak Teknik</strong></h3>\r\n\r\n<p>Mengapa demikian?</p>\r\n\r\n<p>Dalam Revolusi Industri 4.0, setidaknya ada lima teknologi yang menjadi pilar utama dalam mengembangkan industri digital, yaitu: Internet of Things, Big Data, Artificial Intelligence, Cloud Computing dan Additive Manufacturing.</p>\r\n\r\n<p>Kelima pilar tersebut merupakan pilar mendasar bagi seorang entrepreneur untuk dapat mengembangkan bisnisnya. Bahkan dalam beberapa kondisi juga seorang pengusaha saat ini tidak harus memiliki toko.</p>\r\n\r\n<p>Teknologi metaverse yang &nbsp;akan menjadi trend dalam kurun waktu 10 hingga 15 tahun kedepan. Disamping itu, trend start up juga menjadi topik hangat mengingat kebutuhan dari berbagai lini.</p>\r\n\r\n<p>Jadi, buat kamu anak teknik yang merasa mata kuliah kewirausahaan itu tidak penting bagaimana? Apakah kamu tidak ingin mencoba untuk mengetahui banyak hal diluar sana? Banyak hal yang bisa dieksplor, bahkan pada indikator kinerja utama perguruan tinggi yang tercantum pada kebijakan kampus merdeka bertujuan agar mahasiswa mampu menciptakan lapangan pekerjaan.</p>', '1670926038.jpeg', 'anak-teknik-belajar-mata-kuliah-kewirausahaan', 2, '2022-12-13 10:07:18', '2022-12-18 20:17:13'),
(9, 'Anak Teknik Berorganisasi? Siapa Takut!', '<p><a href=\"https://www.anakteknik.co.id/blog/search?title=mahasiswa%20teknik\" target=\"_blank\">Mahasiswa teknik</a>&nbsp;mana suaranya? Baiklah dalam kesempatan ini kita akan mengulas tentang organisasi dan&nbsp;<a href=\"https://www.anakteknik.co.id/blog/search?title=anak%20teknik\" target=\"_blank\">anak teknik</a></p>\r\n\r\n<blockquote>\r\n<p>Anak teknik itu berorganisasi atau tidak?</p>\r\n\r\n<p>anonim, 2022</p>\r\n</blockquote>\r\n\r\n<p>Mungkin pertanyaan tersebut banyak dilontarkan oleh mahasiswa baru di fakultas teknik. Lika - liku anak teknik bisa dipastikan adalah tugas yang menumpuk sepanjang hari.</p>\r\n\r\n<p>Jangan mengeluh dulu, dan mari nikmati cerita ini. Berikut tiga suka duka berorganisasi bagi&nbsp;<a href=\"https://www.anakteknik.co.id/blog/search?title=mahasiswa%20teknik\" target=\"_blank\">mahasiswa teknik</a>.</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>1. Susah manajemen waktu</strong></h3>\r\n\r\n<p>Tugas mahasiswa teknik yang menggunung ditambah praktikum merupakan kegiatan dasar mahasiswa teknik hampir di seluruh kampus Indonesia. Diluar hal itu, banyak mahasiswa teknik juga mengorbankan waktunya untuk penelitian bersama dosen.</p>\r\n\r\n<p>Jika disampaikan seperti itu, tentu sangat sedikit kemungkinan anak teknik ikut organisasi karena masalah manajemen waktu. Namun percayalah, &nbsp;manajemen waktu itu hanya tentang sudut pandang kita dalam menilai sesuatu. Realitanya anak teknik itu masih ada waktu untuk berorganisasi dan lainnya.</p>\r\n\r\n<p>Sulitnya manajemen waktu biasanya dijadikan sebagai tameng agar momen rebahan tidak terganggu. Berbicara tentang momentum bonus demografi dan kaitannya dengan masa pandemi tentu tidak akan selesai.</p>\r\n\r\n<p>Banyaknya perspektif yang mengakibatkan tergerusnya kualitas generasi, termasuk mahasiswa Fakultas Teknik. Tentu untuk merubah keadaan tersebut harus dimulai dari diri sendiri. Nantinya mempengaruhi kualitas generasi bangsa kedepannya secara akumulatif.</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>2. Solidaritas harga mati</strong></h3>\r\n\r\n<p>Siapa yang tidak tahu tentang solidaritas yang ada di teknik? Singkatnya, anak teknik yang berorganisasi biasanya akan memberikan efek baik bagi lingkungannya.</p>\r\n\r\n<p>Memberikan aura positif terhadap teman - teman lainnya. Makna solidaritas dalam berorganisasi tentu sangat fundamental. Anak teknik memiliki sifat yang sedikit lebih dewasa dalam proses kaderisasi. Dari kehidupan sosial yang melahirkan organisator arif dan bijaksana.</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>3. Anak teknik biasanya jadi kepercayaan orang</strong></h3>\r\n\r\n<p>Penulis menyampaikan hal tersebut karena berdasarkan pengalaman pribadi. Biasanya dalam lingkup organisasi tingkat universitas, mahasiswa teknik mengisi kursi kepemimpinan. Hal tersebut karena lingkungan di teknik sangat membentuk pribadi menjadi selangkah lebih baik.</p>\r\n\r\n<p>Itulah tiga suka duka anak teknik dalam berorganisasi. Baik atau buruknya keputusan yang diambil. Percayalah bahwa keputusan yang diambil hari ini akan berbuah hasil di masa yang akan datang.</p>\r\n\r\n<p>Buat kamu anak teknik yang selalu mengeluh dengan tugas, praktikum dan lainnya. Coba buka mata kamu, rasakan dan lihat lingkungan sekitar betapa membutuhkan kamu. Sumbangkan ide pemikiran cemerlang demi kemajuan bersama kedepannya.</p>', '1670926181.jpg', 'anak-teknik-berorganisasi-siapa-takut', 1, '2022-12-13 10:09:41', '2022-12-19 19:23:16'),
(10, 'Produktif ala Milenial, Pelatihan Sertifikasi Public Relation AR Learning Center Dijadikan Pilihan Solutif', '<p>Generasi muda Indonesia hari ini merupakan generasi muda yang dihadapkan dengan berbagai permasalahan secara struktural dan fungsional dalam sendi - sendi kehidupan. Tantangan globalisasi bahkan sudah masuk menjadi budaya yang sudah dianggap biasa saja oleh generasi muda sehingga dalam iklim kompetitif cenderung menurun.</p>\r\n\r\n<p>Tantangan demi tantangan terus ditemui, layaknya efek domino tentu permasalahan yang terjadi hari ini harus segera diselesaikan sebelum merambat ke berbagai sektor dan lini.</p>\r\n\r\n<p>Generasi muda hari ini lebih memilih untuk nongkrong atau sekedar bersantai dibanding mengikuti atau mengerjakan pekerjaan produktif seperti mengikuti kompetisi ataupun mengikuti kegiatan - kegiatan positif lainnya.</p>\r\n\r\n<p>Pelatihan Public Relation yang diselenggarakan oleh AR Learning Center menjadi salah satu bentuk hadirnya ruang - ruang produktivitas bagi generasi milenial terutama bagi yang ingin mengembangkan softskill&nbsp;disaat persaingan tengah mengarah ke iklim kompetitif.</p>\r\n\r\n<p>Pelatihan public relation yang dilaksanakan oleh AR Learning Center&nbsp;melalui dalam jaringan (daring), pelatihan tersebut diikuti oleh peserta yang terdiri berbagai Provinsi di Indonesia.</p>', '1670926484.JPG', 'produktif-ala-milenial-pelatihan-sertifikasi-public-relation-ar-learning-center-dijadikan-pilihan-solutif', 2, '2022-12-13 10:14:44', '2022-12-18 20:19:32'),
(11, 'Asah Kemampuan Melalui Kegiatan Kepemudaan', '<p>Bengkulu, <strong>Onschool Indonesia </strong>mengikuti beberapa rentetan panjang kegiatan kepemudaan di Provinsi Bengkulu yang dilaksanakan oleh Kementerian Pemuda dan Olahraga Republik Indonesia. Kegiatan tersebut bertujuan untuk menemukan bakat - bakat baru ataupun potensi yang berada di Daerah. Melalui Festival Kreativitas Pemuda Tingkat Provinsi Onschool Indonesia ikut andil dalam perhelatan akbar tersebut.</p>\r\n\r\n<p>Onschool Indonesia dalam kesempatan tersebut menjelaskan berbagai aspek dan dampak dalam pengembangan inovasi daerah, terlebih lagi mengenai potensi pengembangan IPTEK (Ilmu Pengetahuan dan Teknologi) yang tentunya akan mempengaruhi pola pendidikan dan pertumbuhan generasi.</p>\r\n\r\n<p>Rahmat Wahyudi sebagai penanggung jawab marketing Onschool Indonesia juga menjelaskan &quot;Tentunya setiap momentum ini akan dijadikan pembelajaran dan ajang untuk membuktikan bahwa generasi muda di Bengkulu tidak hanya berpangku tangan dan berpikir konsumtif, namun juga mampu menjadi tonggak pembaharuan inovasi.&quot;</p>\r\n\r\n<p>&quot;Onschool Indonesia hingga saat ini terus melakukan rotasi dari berbagai lini, guna memperkokoh sistem serta dilakukannya iterasi yang diharapkan mampu menjadikan Onschool Indonesia sebagai saranan pengembangan kreativitas anak muda masa kini&quot;, tambah Daffa Alfajri selaku penanggung jawab bidang teknologi informasi Onschool Indonesia.</p>\r\n\r\n<p>Onschool Indonesia juga diharapkan mampu menjadi wadah yang paling sentral untuk berbagai kebutuhan masyarakat dan generasi muda bengkulu, &quot;Langkah kolaborasi akan sangat diharapkan, tentu apabbila pemerintah dan stakeholder lainnya menutup mata maka perjuangan ini akan berakhir sia - sia.&quot; Ucap Dani Fazli (CEO Onschool Indonesia).</p>', '1670954685.jpeg', 'asah-kemampuan-melalui-kegiatan-kepemudaan', 40, '2022-12-13 18:04:45', '2022-12-25 16:38:25'),
(12, 'Pendidikan Digital yang akan menjadi Arah Perkembangan Bangsa', '<p>Indonesia merupakan negara yang berpenghuni lebih dari 200 juta jiwa yang tersebar dari ujung pulau sabang hingga sudut Kota Merauke, itu membuktikan bahwa negara khatulistiwa yang memiliki kekayaan alam yang sangat besar ini harusnya sudah mendekati atau mencapai standar kesejahteraan dalam bermasyarakat dan bernegara.</p>\r\n\r\n<p>Fenomena bonus demografi merupakan fenomena yang potensial yang sedang memperoleh banyak perhatian, hal tersebut dikarenakan saat ini era tersebut sudah dimulai dimana dapat kita rasakan bahwa generasi produktif sudah jauh lebih banyak dibanding generasi non produktif.</p>\r\n\r\n<p>Hal tersebut juga disusul dengan digantinya MDGs menjadi SDGs yang sudah tercantum dan terbagi menjadi 17 poin utama.</p>\r\n\r\n<p>Pendidikan merupakan isu paling hangat untuk dibahas, pasalnya saat ini pemerataan pendidikan hanya sebatas kata, tanpa aksi nyata. Ketimpangan kualitas pendidikan sudah dirasa dan dianggap biasa saja sehingga hal tersebut sudah bisa dikatakan pendidikan non inklusif. Penyebabnya, minimnya perhatian dari pemerintah serta sikap acuh dari berbagai lini stakeholder semakin membuat keadaan pendidikan negeri ini terlihat miris.</p>\r\n\r\n<p>Era industri 4.0 seakan menjadi pisau bermata dua bagi masa depan bangsa Indonesia. Hal tersebut dikarenakan minimnya kesiapan bangsa dalam menyongsong fenomena tersebut walaupun disisi lain sudah jelas terlihat berbagai kecanggilan dan keterbukaan informasi yang memudahkan aksesibilitas pengembangan IPTEK.</p>\r\n\r\n<p>Pendidikan digital perlahan sudah dimulai oleh sebagian kecil generasi bangsa, namun masih sangat memerluka perhatian khususnya pada sektor pengembangan yang diharapkan mampu berakselerasi di era globalisasi.</p>\r\n\r\n<p>&quot;Generasi muda sudah seharusnya menghadirkan inovasi dan karya, tidak hanya menuntut dan berpangku tangan kepada yang tidak pasti&quot;, ucap Roby Wijaya selaku pembina Onschool Indonesia.</p>\r\n\r\n<p>Melalui pendidikan digital nantinya diharapkan mampu membawa arah yang lebih baik untuk bangsa Indonesia, Walaupun kesiapan dari berbagai sektor terlihat kewalahan, karena seperti yang diketahui bahwa kemajuan itu tidak akan diperoleh jika tidak ada paksaan dan generasi bangsa tetap memilih berada dizona nyaman.</p>', '1671093514.jpeg', 'pendidikan-digital-yang-akan-menjadi-arah-perkembangan-bangsa', 2, '2022-12-15 08:38:34', '2022-12-18 20:16:04'),
(13, 'Program Sosial Pertamina Foundation di Kabupaten Rejang Lebong oleh Rumpun Hijau Indonesia', '<p>Desa Karang Jaya merupakan desa yang terletak di Kabupaten Rejang Lebong, Desa tersebut terdiri dari 4 dusun besar yang notabenenya penghasil sayuran.</p>\r\n\r\n<p>Limbah sayuran di Desa Karang Jaya hingga saat ini tidak termanfaatkan secara maksimal, bahkan sejak Bulan September tahun 2022 tempat pembuangan sampah sementara Desa Karang Jaya ditutup oleh pemerintah dengan beberapa alasan termasuk alasan teknis yang mengharuskan masyarakat Desa Karang Jaya memaksimalkan halaman rumah untuk membuang sampah dan menunggu mobil dari Dinas Lingkungan Hidup yang lewat satu kali dalam satu minggu.</p>\r\n\r\n<p>Melonjaknya harga bahan bakar gas menjadi salah satu permasalahan yang sangat mendasar di Desa Karang Jaya, pasalnya penggunaan bahan bakar gas menjadi kebutuhan primer bagi rumah tangga. Minimnya akses penerangan juga menjadi salah satu permasalahan yang sering dikeluhkan karena Desa Karang Jaya merupakan desa yang memiliki beberapa objek wisata, sehingga sudah seharusnya memiliki solusi yang konkrit agar aksetabilitas pariwisata desa dapat dioptimalkan terutama pada malam hari.</p>\r\n\r\n<p>Disamping itu, harga pupuk yang kian mencekik juga menjadi problematika masyarakat Desa Karang Jaya yang mayoritas bekerja sebagai petani, tentu dengan adanya normalisasi harga pupuk akan membuat masyarakat terbantu secara signifikan.</p>\r\n\r\n<p>Penerapan Gasifikasi menjadi Biogas dan Listrik merupakan penawaran solutif akan permasalahan kompleks di Desa Karang Jaya Kabupaten Rejang Lebong, dimana proses gasifikasi berasal dari limbah organik yang menjadi salah satu permasalahan di Desa tersebut.</p>\r\n\r\n<p>Dalam prosesnya, limbah organik tersebut diolah dalam proses gasifikasi pada tangki biodigester yang selanjutnya akan menghasilkan gas rumah tangga dan juga listrik berupa lampu untuk penerangan jalan.</p>\r\n\r\n<p>Selain itu, sampah atau buangan limbah dari biodigester dapat digunakan menjadi pupuk kompos dan limbah cairnya akan digunakan untuk air probiotik yang berguna bagi kolam lele. Dalam pelaksanaan proyek sosial pertamina foundation ini tim Rumpun Hijau Indonesia membuat kontruksi sebagai <em>sampling </em>yang harapannya kedepan dapat diperbanyak menuju energi baru terbarukan.</p>', '1671094153.jpeg', 'program-sosial-pertamina-foundation-di-kabupaten-rejang-lebong-oleh-rumpun-hijau-indonesia', 50, '2022-12-15 08:49:13', '2022-12-21 13:51:30'),
(14, 'Semangat Wirausaha Anak Muda Bengkulu melalui Produk Lokal yang Menarik', '<p>Ikan asin merupakan produk olahan ikan laut yang dikeringkan dengan cita rasa khas. Ikan asin khas Bengkulu juga demikian, hingga saat ini hanya digemari oleh beberapa kalangan.</p>\r\n\r\n<p>Stigma negatif masyarakat terhadap ikan asin adalah penyebabnya. Aroma yang kurang sedap menutupi rasa dan khasiat yang luar biasa.</p>\r\n\r\n<p>Pada saat ini, generasi muda dari Provinsi Bengkulu terus berupaya menjadikan ikan asin sebagai makanan nasional bahkan internasional. Inovasi yang dihadirkan mulai dari metode produksi hingga pemasaran.</p>\r\n\r\n<p>Bencoolen fish crackers contohnya, produk yang digagas oleh Tilza dan kawan - kawan mengubah ikan asin setengah jadi menjadi snack. Produk ini hadir karena menyesuaikan dengan animo yang terjadi pada era milenial. Sehingga produk tersebut memiliki nilai khusus pada masyarakat juga berkhasiat</p>\r\n\r\n<h3 style=\"font-style: normal;\"><strong>Khasiat ikan asin bagi tubuh</strong></h3>\r\n\r\n<p>Masyarakat saat ini menggemari makanan cepat saji yang tentunya kurang baik untuk kesehatan. Padahal ada beberapa khasiat ikan asin bagi tubuh manusia.</p>\r\n\r\n<p>Berikut 3 khasiat utama ikan asin yang harus kalian ketahui.</p>\r\n\r\n<h3 style=\"color:#212529; font-style:normal\"><strong>1. Baik bagi kesehatan gigi dan tulang</strong></h3>\r\n\r\n<p>Proses penjemuran ikan asin dilakukan secara konvesional. Ikan yang berasal dari laut ini memiliki kandungan fosfor dan kalsium. Nutrisi yang berasal dari fosfor dan kalsium ini sangat bermanfaat bagi tulang dan gigi.</p>\r\n\r\n<p>Bagi anak atau remaja, ikan asin bagus untuk mendukung masa pertumbuhan gigi dan tulang. Selain itu, khasiat lainnya adalah mencegah kelainan tulang dan memperkuat struktur tulang.</p>\r\n\r\n<h3 style=\"color:#212529; font-style:normal\"><strong>2. Menjaga sistem imun tubuh dan sumber energi bagi tubuh</strong></h3>\r\n\r\n<p>Pada era pasca pandemi saat ini, masyarakat sangat memerlukan makanan untuk menjaga sistem imun tubuh. Agar tidak mudah terserang penyakit termasuk covid-19 yang hingga saat ini masih bermunculan. Hal tersebut dikarenakan dengan adanya kandungan protein yang terdapat pada ikan asin.</p>\r\n\r\n<blockquote>\r\n<p>Pembuatan ikan asin menjadi makanan olahan akan semakin memaksimalkan khasiat dari ikan asin. Setiap 100 gram ikan asin mengandung 193 kkal yang tentunya sangat berguna bagi tubuh (dr. fadhil rizal makarim, 2021)</p>\r\n</blockquote>\r\n\r\n<h3 style=\"color:#212529; font-style:normal\"><strong>3. Mencegah penyakit jantung</strong></h3>\r\n\r\n<p>Seperti yang kita ketahui, ikan asin mengandung omega 3 yang cukup tinggi dan kolestrol baik. Dengan adanya dua kandungan tersebut dapat menurunkan kolestrol jahat serta mencegah penyakit jantung.</p>\r\n\r\n<p>Ikan asin masih memiliki sangat banyak khasiat yang sangat berguna bagi tubuh. Maka dari itu, cerdaslah dalam memilih makanan agar tubuh kita dapat terhindar dari penyakit.</p>', '1671095854.jpeg', 'semangat-wirausaha-anak-muda-bengkulu-melalui-produk-lokal-yang-menarik', 2, '2022-12-15 09:17:34', '2022-12-21 12:10:32'),
(15, 'Ideologi Politik Pemuda Masa Kini, Pragmatis atau Idealis?', '<p><strong>Prolog Masalah</strong></p>\r\n\r\n<p>Partisipasi politik dalam sebuah Negara demokrasi merupakan sesuatu yang substansial. Salah satu alasan yang mendasar terkait hal tersebut adalah karena salah satu indikator kualitas demokrasi ditentukan oleh tinggi dan rendah serta bagaimana partisipasi politik tersebut dilakukan. Partisipasi politik adalah kegiatan seseorang atau kelompok orang untuk ikut serta secara aktif dalam kehidupan politik, antara lain dengan jalan memilih pimpinan negara dan secara langsung atau tidak langsung memengaruhi kebijakan pemerintah. Kegiatan ini mencakup tindakan seperti memberikan suara dalam pemilihan umum, menghadiri rapat umum, mengadakan hubungan dengan pejabat pemerintah atau anggota perlemen. Akan tetapi seiring berkembangnya demokrasi muncul kelompok-kelompok yang juga ingin mempengaruhi proses pengambilan kebijakan. Salah satu kelompok partisipan dalam pemilu adalah kelompok pemilih muda. Batasan pemuda dimulai dari usia 16 tahun mengikuti penetapan umur anak muda yang dilakukan oleh Perserikatan BangsaBangsa, sedangkan batas umur anak muda sampai 30 tahun didasari oleh UU Kepemudaan No. 40 tahun 2009 pasal 1 tentang : Pemuda adalah warga negara Indonesia yang memasuki periode penting pertumbuhan dan perkembangan yang berusia 16 (enam belas) sampai 30 (tiga puluh) tahun. Pemilih muda ini dapat menjadi kekuatan tersendiri dalam pemilu, antusias kelompok ini cukup tinggi dan mayoritas kelompok ini ingin memberikan suaranya pada setiap pemilu yang ada.</p>\r\n\r\n<p><strong>Pemuda berperan dipartai politik atau ada kepentingan?</strong></p>\r\n\r\n<p>Pemuda yang dibahas penulis dalam tulisan ini yakni mahasiswa, dimana ada sekitar 8,2 juta pemuda berlabel kata MAHASISWA itu yang tersebar dari sudut Kota Sabang hingga ke sekitaran Pulau Merauke. Berdasarkan studi kasus dari penulis yakni mahasiswa Universitas Bengkulu, bahwa saat ini kepentingan dan ketulusan mahasiswa sudah dicampuri kepentingan pribadi yang seharusnya tidak hadir dalam idealisme seorang pemuda.</p>\r\n\r\n<p>Jika berbicara kepentingan kelompok dan sifatnya masih memberi dampak untuk bersama tentu sudah menjadi hal yang lumrah terjadi di negara ini, namun jikalau kepentingan pribadi berada diatas kepentingan bersama, tentu hanya akan menghadirkan luka baru bagi bumi pertiwi kedepannya. Dalam beberapa diskusi dan pertemuan dengan elit politik kampus, tentu landasan, tuntutan dan aspirasi yang katanya milik rakyat mayoritas tidak berlandasan, dan ironinya adalah disaat mahasiswa dan pemuda yang mudah menjual nama RAKYAT tanpa ada validasi dari rakyat mana yang diperjuangkan.</p>\r\n\r\n<p>Hal ini semakin diperparah dengan fakta bahwa jajaran demisioneris fungsional pejabat kampus kebanyakan menjadikan jabatan struktural sebagai batu loncatan untuk kepentingan pribadinya. Lantas sama siapa lagi masyarakat berhadap jika orang yang disebut <em>agent of change </em>telah berubah menjadi <em>agent </em>untuk dirinya sendiri, yang seharusnya menjadi sosial kontrol masyarakat namun mengontrol masyarakat untuk kepentingannya.</p>\r\n\r\n<p><strong>Pergerakan dan Kemunafikan</strong></p>\r\n\r\n<p>Tentu hal ini sudah menjadi pekerjaan rumah bersama dan sebenarnya harus dibenahi, dalam suatu konsolidasi yang diikuti penulis, ada seorang aktivis yang berucap &ldquo;Mari bersama saling menggenggam dan berjuang hanya untuk rakyat&rdquo;, disambut dengan aktivis lainnya &ldquo;Pergerakan kita adalah pergerakan yang murni hadir dari rahim rakyar&rdquo;. Tentu penulis sepakat dengan dua kalimat penyemangat tersebut, namun disatu sisi penulis kecewa karena 2 orang yang mengucapkan kalimat perjuangan itu datang telat 3 jam dari waktu yang telah disepakati, tentu ini secara tidak langsung telah mencederai nilai &ndash; nilai dan norma kedisiplinan dalam pergerakan.</p>\r\n\r\n<p>Penulis merasakan pilu yang teramat dalam disaat menulis opini ini, seakan sekat &ndash; sekat kepentingan sudah menjadi lumrah dalam pergerakan mahasiswa dan pemuda, sudah tidak ada lagi kata kemurnian dan ketulusan dalam bergerak yang membuat arah negeri semakin tidak jelas. Sebelum menanamkan nilai &ndash; nilai demokrasi tentu kita harus sama &ndash; sama berkomitmen dan menanamkan nilai &ndash; nilai dan norma sosial.</p>\r\n\r\n<p><strong>Berteriaklah Atas Nama Kebenaran</strong></p>\r\n\r\n<p>Tulisan ini dihadirkan dengan harapan akan menularnya semangat perjuangan dan semangat membela kebenaran demi kebaikan bangsa kedepannya. Penafsiran mahasiswa terhadap makna dan esensi dari kata politik masih sangat prematur, hal tersebut dikarenakan rendahnya tingkat pemahaman dan melek politik dikalangan pemuda saat ini. Pemuda dan mahasiswa seakan kehilangan arahnya, tidak ada lagi ketulusan dalam perjuangan, tidak ada lagi perlawanan dalam setiap tulisan &ndash; tulisan yang dihadirkan, jangan sampai nantinya pemuda hanya menjadi salah satu alat politik dan diberdayakan oleh oknum &ndash; oknum yang tidak bertanggung jawab.</p>\r\n\r\n<p>Dalam sedikit pengalaman penulis, tentu menemukan banyak hal yang sangat mengecewakan dan menyedihkan, bukankah semua sepakat bahwa kampus adalah miniatur negara? Tapi mengapa masih ada elit politik kampus yang hanya bergerak untuk kepentingan pribadi? Permasalahan &ndash; permasalahan kampus tentunya sudah sangat banyak, tetapi mengapa aktivis hari ini seakan dibuat buta dan tuli dalam menyikapi iklimpolitik yang sedang tidak baik &ndash; baik saja.</p>', '1671096003.JPG', 'ideologi-politik-pemuda-masa-kini-pragmatis-atau-idealis', 2, '2022-12-15 09:20:05', '2022-12-21 13:50:07'),
(16, 'Pola Penerapan Metode Pendidikan yang Menyenangkan di Bengkulu melalui Smart Practicum', '<p><strong>Pengenalan Metode Terbaru di Provinsi Bengkulu</strong></p>\r\n\r\n<p>Implementasi kampus merdeka tentu sudah berjalan jauh, ditambah lagi dengan bergabungnya antara Kementerian Pendidikan dan Kebudayaan dan Kementerian Riset dan Teknologi yang membuat hadirnya akselerasi baru di sector pendidikan Indonesia. <em>Augmented reality </em>merupakan salah satu bagian dari industri 4.0 yang saat ini sedang digandrungi kaum muda di Indonesia.</p>\r\n\r\n<p>Usulan ide yang ditawarkan putra daerah dalam hal ini tidak hanya sebagai ekspetasi seorang pemimpi untuk terbang tinggi, melainkan satu wujud realisasi untuk terus berinovasi bagi negeri bumi pertiwi. Harapannya ada banyak elemen yang mendukung keberlanjutan program, tidak hanya pemerintah, melainkan setiap elemen yang berada dimasyarakat yang sudah seharusnya saling membantu dalam pemajuan inovasi di negeri ini.</p>\r\n\r\n<p><em>Smart Practicum </em>atau praktikum pintar merupakan salah satu aplikasi yang akan memudahkan peranan pengajar dalam menyampaikan materi atau metode dalam praktikum. <em>Augmented reality </em>yang menjadi fitur utama pada aplikasi akan memanfaatkan skema penerapan teknologi terbaru, disisi lain untuk menunjang praktikum yang menggunakan AR, maka penulis membuat alat bantu berupa <em>card board game </em>yang tentu saja selain memperkenalkan kecanggihannya juga membuat belajar fisika menjadi menyenangkan.</p>\r\n\r\n<p>Aplikasi <em>smart practicum</em> tidak hanya menampilkan konsep komponen, namun juga diberikan contoh rangkaian yang sudah selesai tentu dengan tampilan tiga dimensi. Selain tampilan kartu, penulis juga memaparkan tampilan <em>interface</em> . Pada tampilan<em> interface</em> penulis menampilkan beberapa fitur lain dalam aplikasi, tidak hanya konsep augemented reality, penulis juga melengkapi fitur aplikasi dengan virtual meeting, kuis atau ujian online, presensi online serta bank data yang memuat modul praktikum tersebut.</p>\r\n\r\n<p><strong>Urgensi Penerapan Metode <em>Augemented Reality</em> pada Sistem Pendidikan Bengkulu</strong></p>\r\n\r\n<p><em>Augmented Reality</em> atau AR&nbsp; adalah teknologi yang memperoleh penggabungan secara real-time terhadap digital konten yang dibuat oleh komputer dengan dunia nyata. Augmented Reality memperbolehkan pengguna melihat objek maya 2D atau 3D yang diproyeksikan terhadap dunia nyata (Dicoding, 2020).</p>\r\n\r\n<p>Disisi lain, penerapan teknologi <em>Augmented Reality</em> masih tergolong minim di Provinsi Bengkulu. Bahkan untuk penerapa disektor pendidikan masih nol besar. Masyarakat dan pelajar pada umumnya mungkin mengenal permainan yang sempat viral pada masanya, &rdquo;Pokemon Go&rdquo; tentu banyak yang mengenal permainan tersebut, namun banyak yang belum sadar bahwa permainan tersebut .</p>\r\n\r\n<p>merupakan wujud nyata dari penerapan <em>Augmented Reality </em>dalam kehidupan bermasyarakat dan sangat disayangkan apabila konep tersebut tidak diterapkan dalam sektor pendidikan di Indonesia terutama di Provinsi Bengkulu.</p>\r\n\r\n<p><strong>Pola Implementasi paling Efektif</strong></p>\r\n\r\n<p>Tranformasi digital yang tengah digandrungi oleh masyarakat dan generasi muda di Indonesia mengakibatkan akselerasi yang mengiringi langkah inovasi di Indonesia, hal tersebut juga tidak terlepas dari peranan berbagai sektor yang saling mendukung pada sebuah kemajuan teknologi. Pada metode penerapan gagasan secara konkrit di lingkungan sekolah akan dilakukan beberapa kuisioner sebelum dimulainnya sosialisasi secara massif, hal ini dilaksanakan guna mengidentifikasi kebutuhan siswa dengan skema yang jelas, penyebaran kuisioner akan dilakukan melalui media sosial serta himbauan terhadap wali murid dari SMA N yang ada di Kota Bengkulu dijadikan sebagai sampel dalam kegiatan ini.</p>', '1671097206.jpeg', 'pola-penerapan-metode-pendidikan-yang-menyenangkan-di-bengkulu-melalui-smart-practicum', 1, '2022-12-15 09:40:06', '2022-12-17 17:19:50'),
(17, 'Rumpun Hijau Indonesia, Kolaborasi akan menjadi Kunci', '<p>Rejang Lebong, Rumpun Hijau Indonesia selaku pelaksana proyek sosial dari Pertamina Foundation melakukan diskusi secara bertahap dan berkelanjutan mengenai proyek yang nantinya akan dijadikan salah satu program acuan daerah.</p>\r\n\r\n<p>Dalam momentum ini, Rumpun Hijau Indonesia melaksanakan program sosial yang memanfaatkan limbah organik dan sayur - sayuran menjadi gas, listrik dan pupuk. Tentu dengan adanya terobosan ini diharapkan mampu menjadikan Desa Mandiri Energi yang terimplementasi di setiap penjuru negeri.</p>\r\n\r\n<p>&quot;Kegiatan program sosial ini diharapkan mampu membawa dampak yang sangat besar, tentu juga diharapkan mampu terimplementasi secara bertahap dan berkala untuk energi bersih dan masa depan Indonesia.&quot; Ungkap Fadhil Rahmawan sebagai pimpinan proyek bidang kontruksi.</p>\r\n\r\n<p>&quot;Kolaborasi tentu akan menjadi kunci dari berkembangnya ide inovasi yang ditawarkan ini, kami sudah melakukan komunikasi terhadap beberapa stakeholder, dan hasilnya cukup memuaskan.&quot; Tutup Dani Fazli.</p>\r\n\r\n<p>&nbsp;</p>', '1671301341.jpeg', 'rumpun-hijau-indonesia-kolaborasi-akan-menjadi-kunci', 1, '2022-12-17 18:21:03', '2022-12-21 13:52:37'),
(18, 'Menuju 2023, Onschool Indonesia Siap Tingkatkan Kolaborasi', '<p>Bengkulu, <strong>Onschool Indonesia </strong>merupakan start up anak muda yang bergerak dibidang pendidikan atau lebih dikenal sebagai <em>edutech start up </em>yang mana konsentrasi utama dalam pemajuan tim dan pengembangan inovasi yakni dalam lingkup digitalisasi.</p>\r\n\r\n<p><a href=\"https://onschool.id/\">Onschool Indonesia</a> juga sudah sering terlibat dalam banyak kegiatan mulai dari kegiatan bertajuk pendidikan, sosial, lingkungan hingga ekonomi.</p>\r\n\r\n<p>Dalam pengembangan inovasi karya, onschool indonesia sudah menghadirkan beberapa karya yang tentunya dapat berdampak untuk kemajuan generasi seperti permainan anak berbasis board games klaster, website yang terintegrasi serta aplikasi yang user friendly.</p>\r\n\r\n<p>Dalam pengembangan website dan aplikasi, Onschool Indonesia sudah meraih berbagai penghargaan dari regional hingga internasional, tentu hal tersebut sudah menjadi validasi bahwa pengembangan inovasi yang dilakukan mengacu pada aspek - aspek kognitif yang ada pada siswa.</p>\r\n\r\n<p>Board games klaster juga sudah mendapatkan validasi ataupun pengakuan melalui penghargaan yang diperoleh pada tahun 2022 ini dari PT Jasa Raharja, tentu dengan tekad ini akan menjadikan inovasi anak bangsa dapat terus dikembangkan.</p>\r\n\r\n<p>&quot;Perlu digaris bawahi juga bahwasanya pembaharuan inovasi yang dilakukan secara berkala ini juga memerlukan bantuan dan kolaborasi dari berbagai pihak yang tentunya sangat diharapkan.&quot; Ungkap Dani.</p>', '1671442915.jpeg', 'menuju-2023-onschool-indonesia-siap-tingkatkan-kolaborasi', 1, '2022-12-19 09:41:55', '2022-12-21 14:24:37'),
(19, 'Onschool Indonesia Raih Medali Platinum dalam IC-RIITEL 2022  yang diselenggarakan oleh Universitas Malaya, Malaysia', '<p>Internasional Competition of Research, Idea, and Innovation on Teaching and Learning (IC-RIITEL 2022) merupakan kegiatan bergengsi yang diselenggarakan oleh Universitas Malaya, Malaysia pada tanggal 16-17 Desember 2022 melalui aplikasi virtual meeting Streamyard.</p>\r\n\r\n<p>Kegiatan ini mengusung tema Digitalisasikan Pendidikan (Digitalising Education) dengan 3 kategori Research, Innovation, dan Idea (Concept Paper).</p>\r\n\r\n<p>Onschool Indonesia diikutkan dalam kategori Innovation dengan judul &ldquo;Validity Level of Onschool Application as Media in Mathematics Learning&rdquo; oleh salah satu anggota yakni Tilza Levia dari Universitas Bengkulu.</p>\r\n\r\n<p>Perlombaan Internasional ini diikuti oleh berbagai Universitas di Malaysia dan Universitas di Indonesia yang diantaranya Universitas Malaya, Universitas Bengkulu, dan masih banyak yang lainnya.</p>\r\n\r\n<p>Setiap kategori terdiri dari beberapa bagian medali, seperti bronze, silver, gold hingga tingkatan tertinggi yaitu platinum. Setiap peserta dengan medali platinum akan diterbitkan jurnal Internasional.</p>\r\n\r\n<p>Setelah proses seleksi yang panjang dan presentasi yang cukup melelahkan, akhirnya Onschool Indonesia mendapat medali platinum dalam perlombaan tersebut.</p>', '1671700994.JPG', 'onschool-indonesia-raih-medali-platinum-dalam-ic-riitel-2022-yang-diselenggarakan-oleh-universitas-malaya-malaysia', 39, '2022-12-22 09:23:14', '2022-12-24 18:13:26');
INSERT INTO `blog` (`id`, `judul`, `isi`, `gambar`, `slug`, `view`, `created_at`, `updated_at`) VALUES
(20, 'Sampaikan Aspirasi Pendidikan Bengkulu melalui Gelar WIcara Isu Kepemudaan bersama ID Next Leader', '<p><strong>Bengkulu - </strong>Jumat 23/12/2022 Onschool Indonesia mengikuti kegiatan Y20 Post Summit Gebyar Muda Berkarya dengan mengusung tema &quot;Membangun Jejaring Pemuda Lokal dan Berperan dalam membangun kepemimpinan Indonesia&quot; yang diselenggarakan oleh Indonesian Youth Diplomacy, ID Next Leader serta Onschool Indonesia.</p>\r\n\r\n<p>Dalam kegiatan tersebut, Onschool Indonesia juga berperan sebagai moderator dalam kegiatan gelar wicara isu kepemudaan bersama Zukruf Novandaya M.P.,W.K selaku Regional and community manager ID next leader serta Ketua ADKI Jateng Terpilih, selain itu juga hadir Apt. Destita Khairilisani, S.Farm.,MSM selaku ketua srikandi tenaga pembangunan sriwijaya Provinsi Bengkulu serta pimpinan beberapa perusahaan nasional dan multinasional, dan terakhir ada Nicole Accalia Anggriawan selaku perwakilan dari Indonesian Youth Diplomacy serta Head Delegation of Universitas Indonesia for Harvard World MUN 2022.</p>\r\n\r\n<p>Dalam kegiatan ini, CEO Onschool Indonesia, Dani Fazli menyimpulkan bahwasanya kolaborasi adalah kunci keberhasilan gerakan pemuda terutama yang berangkat dari gerakan sederhana, tentu pemuda bukan saatnya untuk saling menguasai, namun juga sangat menurunkan egosektoral sehingga tujuan dan kepentingan bersama dapat terwujud.</p>\r\n\r\n<p>Kegiatan ini diselenggarakan di Gedung Serba Guna Provinsi Bengkulu dengan dibagi menjadi beberapa sesi.</p>\r\n\r\n<p>Onschool Indonesia juga berkesempatan menjadi perwakilan Organisasi Kepemudaan Bengkulu dalam community gathering antar organisasi dan instansi kepemudaan yang ad di Bengkulu. Onschool Indonesia menjadi pemantik sesi tersebut bersama perwakilan ID Next Leader Regional Bengkulu serta perwakilan dari Komite Nasional Pemuda Indonesia atau lebih sering dikenal sebagai KNPI Bengkulu.</p>', '1671827925.jpeg', 'sampaikan-aspirasi-pendidikan-bengkulu-melalui-gelar-wicara-isu-kepemudaan-bersama-id-next-leader', 41, '2022-12-23 20:38:45', '2022-12-24 15:19:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tipe_user` enum('admin','mentor','member') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `forum`
--

INSERT INTO `forum` (`id`, `judul`, `slug`, `isi`, `id_user`, `tipe_user`, `created_at`, `updated_at`) VALUES
(6, 'LKPD Persamaan Kuadrat dan Fungsi Kuadrat', 'lkpd-persamaan-kuadrat-dan-fungsi-kuadrat', '<p><a href=\"https://drive.google.com/file/d/1BKjHodbWTe9eRc9yZKkX6TqwRExBNyn-/view?usp=sharing\">https://drive.google.com/file/d/1BKjHodbWTe9eRc9yZKkX6TqwRExBNyn-/view?usp=sharing</a></p>', 81, 'member', '2022-12-04 14:32:57', '2022-12-04 14:32:57'),
(7, 'Materi Persamaan dan Fungsi Kuadrat', 'materi-persamaan-dan-fungsi-kuadrat', '<p><a href=\"https://drive.google.com/file/d/1zOU-wp3p6f4pQYEPNA_dYPFQBvR-2GJt/view?usp=sharing\">https://drive.google.com/file/d/1zOU-wp3p6f4pQYEPNA_dYPFQBvR-2GJt/view?usp=sharing</a></p>', 81, 'member', '2022-12-04 14:40:17', '2022-12-04 14:40:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_komentar`
--

CREATE TABLE `forum_komentar` (
  `id` int(11) NOT NULL,
  `id_forum` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipe_user` enum('admin','mentor','member') DEFAULT NULL,
  `komentar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Kelas Koding', 'kelas-koding', '2022-03-04 07:22:59', '2022-03-09 07:45:04'),
(2, 'Kelas Desain', 'kelas-desain', '2022-03-04 07:23:10', '2022-03-09 07:45:08'),
(3, 'Kelas Softskill', 'kelas-softskill', '2022-03-04 07:23:45', '2022-03-09 07:45:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `id_mentor` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kelas` varchar(150) NOT NULL,
  `deskripsi_singkat` text DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `foto` text DEFAULT NULL,
  `video_url` text DEFAULT NULL,
  `tipe` enum('Gratis','Berbayar') NOT NULL,
  `biaya` int(11) NOT NULL,
  `sertifikat` enum('Ada','Tidak Ada') DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif','Suspend','Pending','Ditolak') NOT NULL DEFAULT 'Pending',
  `pesan` text DEFAULT NULL,
  `terjual` int(5) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `id_mentor`, `id_kategori`, `kelas`, `deskripsi_singkat`, `deskripsi`, `foto`, `video_url`, `tipe`, `biaya`, `sertifikat`, `status`, `pesan`, `terjual`, `created_at`, `updated_at`) VALUES
(10, 7, 1, 'test-1', 'Aw', '<p>asdasdas</p>', '1668428591.jpeg', 'https://www.youtube.com/watch?v=LKjn0OYJ_s0', 'Berbayar', 5000, 'Ada', 'Suspend', '-', 4, '2022-11-14 12:23:11', '2022-12-23 11:13:10'),
(14, 15, 3, 'Driving Safety Games', 'Gerakan Edukasi Lalu Lintas Pat Petulai:Pengenalan Game Based Learning Berbantuan Media Board Game Klaster Sebagai Wujud Gerakan Edukasi Lalu Lintas Pada Generasi Muda (5-19 Tahun) Kabupaten Rejang Lebong', '<p><strong>Permainan</strong> <strong>ini</strong> <strong>merupakan</strong><strong> program </strong><strong>sosial</strong><strong> yang </strong><strong>akan</strong> <strong>mengedukasi</strong> <strong>siswa</strong> <strong>pentingnya</strong> <strong>mematuhi</strong> <strong>aturan</strong> <strong>pada</strong> <strong>saat</strong> <strong>berkendara</strong> <strong>dan</strong> <strong>mengasah</strong> <strong>kemampuan</strong> <strong>berpikir</strong> <strong>dalam</strong> <strong>menyelesaikan</strong> <strong>suatu</strong> <strong>permasalahan</strong><strong>.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Dengan</strong> <strong>menggunakan</strong><strong> media </strong><strong>pembelajaran</strong><strong> board games </strong><strong>akan</strong> <strong>membuat</strong> <strong>siswa</strong> <strong>atau</strong> <strong>peserta</strong> <strong>didik</strong> <strong>lebih</strong> <strong>aktif</strong> <strong>bermain</strong> <strong>serta</strong> <strong>tidak</strong> <strong>mengenyampingkan</strong> <strong>kompetensi</strong> <strong>sikap</strong> <strong>sosial</strong> <strong>dan</strong> <strong>kompetensi</strong> <strong>karakter</strong> <strong>peserta</strong> <strong>didik</strong></p>', '1669815993.png', 'https://youtu.be/D0daTWyR3wM', 'Gratis', 0, 'Tidak Ada', 'Aktif', NULL, 2, '2022-11-30 13:46:34', '2022-12-26 12:58:38'),
(15, 16, 1, 'Kelas coding website dasar', 'Mempelajari mengenai dasar-dasar programming website yaitu html dan css', '<p>Mempelajari dasar-dasar website yaitu penggunaan html dan css untuk membangun website yang cantik</p>', NULL, '-', 'Berbayar', 35000, 'Ada', 'Suspend', NULL, 0, '2022-12-20 03:35:43', '2022-12-23 11:14:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_faq`
--

CREATE TABLE `kelas_faq` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `pertanyaan` varchar(255) DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_faq`
--

INSERT INTO `kelas_faq` (`id`, `id_kelas`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`) VALUES
(17, 10, '-', '-', '2022-11-14 12:23:11', '2022-11-14 12:23:11'),
(18, 14, 'Apa itu driving safety games', 'Gerakan Edukasi Lalu Lintas Pat Petulai:Pengenalan Game Based Learning Berbantuan Media Board Game Klaster Sebagai Wujud Gerakan Edukasi Lalu Lintas Pada Generasi Muda (5-19 Tahun) Kabupaten Rejang Lebong', '2022-11-30 13:46:34', '2022-11-30 13:46:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_materi`
--

CREATE TABLE `kelas_materi` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `judul_materi` varchar(150) NOT NULL,
  `video` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_materi`
--

INSERT INTO `kelas_materi` (`id`, `id_kelas`, `judul_materi`, `video`, `created_at`, `updated_at`) VALUES
(32, 10, 'Materi 1', 'https://www.youtube.com/embed/LKjn0OYJ_s0', '2022-11-14 12:23:11', '2022-11-14 12:23:11'),
(36, 14, 'Driving Safety Games', 'https://www.youtube.com/embed/D0daTWyR3wM', '2022-11-30 13:46:34', '2022-11-30 13:46:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_soal`
--

CREATE TABLE `kelas_soal` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `soal` text DEFAULT NULL,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `e` varchar(255) DEFAULT NULL,
  `jawaban` char(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_soal`
--

INSERT INTO `kelas_soal` (`id`, `id_kelas`, `soal`, `a`, `b`, `c`, `d`, `e`, `jawaban`, `created_at`, `updated_at`) VALUES
(14, 10, 'Asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'A', '2022-11-14 12:23:11', '2022-11-14 12:23:11'),
(15, 14, '-', '-', '-', '-', '-', '-', 'A', '2022-11-30 13:46:34', '2022-11-30 13:46:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_tools`
--

CREATE TABLE `kelas_tools` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_tools` varchar(150) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `download` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_tools`
--

INSERT INTO `kelas_tools` (`id`, `id_kelas`, `nama_tools`, `keterangan`, `download`, `created_at`, `updated_at`) VALUES
(18, 10, '-', '-', '-', '2022-11-14 12:23:11', '2022-11-14 12:23:11'),
(19, 14, 'DSG', 'Boardgames', '-', '2022-11-30 13:46:34', '2022-11-30 13:46:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `pekerjaan` text DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `nama`, `email`, `pekerjaan`, `no_hp`, `alamat`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Santi', 'santi@gmail.com', 'Guru TK', '089999999', 'Jalan Raya', '$2y$10$KwbzmH7a8z27NKJck/nigOl0TOID1HK0wAqe/bLKhRYXLbWOyTjaG', '1650955384.jpg', '2022-10-19 17:24:33', '2022-10-26 13:41:23'),
(2, 'Nuts', 'nuts.corporate@gmail.com', NULL, '0895702763865', NULL, '$2y$10$9LfMZfgxinfjrhCrsPCu5e2C.MDhYBisQTMuS3yIvMoDZSakoo7ei', NULL, '2022-10-19 22:01:06', '2022-10-26 13:41:31'),
(3, 'setya', 'dhaang@gmail.com', NULL, '082323232323', NULL, '$2y$10$hmy1x5hK1XJRxaOA847iOOLpG8vFVVSD83fYDV9igabnoLDgPeIsW', NULL, '2022-10-20 14:44:32', '2022-10-26 13:41:44'),
(5, 'Setiawan', 'setiawan@gmail.com', 'Mahasiswa', '089111222333', NULL, '$2y$10$MfTnfJmaCn0p8/A2IEq06u7Ty2P67ajUdAP707jAif6OBxx/3f63O', '1668415785.jpeg', '2022-11-03 14:02:23', '2022-11-14 08:49:45'),
(6, 'Laura', 'laura@gmail.com', NULL, '081111222333', NULL, '$2y$10$lbQcUyCsMGxCQUmOa/WzTO7RzKe2LGkldSgypWEcOWIyfDzOlkg4q', NULL, '2022-11-14 09:43:53', '2022-11-14 09:43:53'),
(7, 'dandi', 'dandi@gmail.com', NULL, '082194881249', NULL, '$2y$10$4n9u7RKcwzuIjS/C0/Y6hOe.ENuMCpxfw7i2MeoSmQSzzIPoDjFVa', NULL, '2022-11-14 09:49:40', '2022-11-14 09:49:40'),
(8, 'Dani', 'dani@gmail.com', NULL, '089123213', NULL, '$2y$10$cL3nmzAQ73qNt/fs1k6GjefejIc5IMRyvK3hFTUgXVfi1RzgrR1q.', NULL, '2022-11-14 12:21:39', '2022-11-14 12:21:39'),
(9, 'yahya', 'yahya@gmail.com', NULL, '08252212515131', NULL, '$2y$10$RRUgthXzbBkYSnrTo7dEAuMkQvqbfn1oxzIzrfeBWf3MxnsqRN7Ma', NULL, '2022-11-14 12:47:40', '2022-11-14 12:47:40'),
(10, 'alif', 'alif@gmail.com', NULL, '0182391283', NULL, '$2y$10$CJpVwv.L6WZQHbxNeK3sSOxRCrWchDDeTyUIam2ejwJ9sPyZq/EpC', NULL, '2022-11-14 13:22:00', '2022-11-14 13:22:00'),
(11, 'caca', 'caca@gmail.com', NULL, '01923012039', NULL, '$2y$10$2VxS47c22FRXDQQ.ySF6pu.21iMocYudzXLhK4epNp2zJyClQ0bWO', NULL, '2022-11-14 13:28:09', '2022-11-14 13:28:09'),
(12, 'David Greeley', 'david_greeley@yahoo.com', NULL, '081310573679', NULL, '$2y$10$x6BsHz5s50p/QBQCWvN.jeHnvp7/sYuZUMJVhmVVlTILdkbhR5iRC', NULL, '2022-11-15 08:56:59', '2022-11-15 08:56:59'),
(13, 'DEVI ULFIYATI WAWAZZAINI', 'ulfiyatidevi@gmail.com', 'Mahasiswa', '085841442372', 'Jln PGRI 4,Kel.Bentiring Permai,Kec.Muara Bangka Hulu,Bengkulu', '$2y$10$4UgBPIWG..zBrLvIcqaFG.ZZVPeZxJwGrve9HXYE4qzImlUO1Znja', '1668865498.jpg', '2022-11-19 13:40:21', '2022-11-19 13:44:58'),
(14, 'Rahayu Junianti', 'ayu18oppo@gmail.com', NULL, '085268438667', NULL, '$2y$10$4mHyXqm/uVyLYBIem/7B2ey2v2eSDOe949DGh2HLrGm5uF3DQ8p.2', NULL, '2022-11-19 13:42:22', '2022-11-19 13:42:22'),
(15, 'ERIN DWINTA AGUSTINA', 'erindwinta@gmail.com', NULL, '088286674772', NULL, '$2y$10$iQyEq49znqwDj44DaU8mWO6YkMk2dK/FtB00xo3NNUy4SP7EKXmFq', NULL, '2022-11-19 13:46:12', '2022-11-19 13:46:12'),
(16, 'Bintang Fachris Tio', 'bintangfachristio4975@gmail.com', NULL, '085609392627', NULL, '$2y$10$QCeafxtY3nLJ6nP3UNz7BOigXixx9N.kcCc69ifs4jNLjwDxWro2C', NULL, '2022-11-19 13:48:41', '2022-11-19 13:48:41'),
(17, 'Ratna Sari', 'ratna07sari2004@gmail.com', NULL, '085267232796', NULL, '$2y$10$6Senqb7uxUmBI7Nk/EvKcu2VDdpDwVuhX9RrOKd4gG6RgEv1xDj7O', NULL, '2022-11-19 13:48:53', '2022-11-19 13:48:53'),
(18, 'Meisya Bestiananta', 'tatameisya25@gmail.com', NULL, '082289202204', NULL, '$2y$10$cQ7GrBQCCH5.rFH5NG/.huitnMyPOhDceKVX/9LGgUFllzcR.SyIe', NULL, '2022-11-19 13:48:56', '2022-11-19 13:48:56'),
(19, 'RAIHAN NAUFAL', 'rn8678950@gmail.com', NULL, '082287535970', NULL, '$2y$10$qRuAM99czFNf2jSfdxM4yeSXVgKbzFOk277h1ZpJD3W/U.R0hUENC', NULL, '2022-11-19 13:51:37', '2022-11-19 13:51:37'),
(20, 'Imbral Bala Putra', 'jagogoar@gmail.com', NULL, '082282013393', NULL, '$2y$10$33aNZ9onD6pMyfsBD1pKi.Qza33g0CQDM/mj4GVFOWNlGB4btdQga', NULL, '2022-11-19 13:56:14', '2022-11-19 13:56:14'),
(21, 'RIRI RAFHAELA', 'ririrafhaela26@gmail.com', NULL, '082278404217', NULL, '$2y$10$fBpxuBjLXkhenPR6JTukO.reBpIGA1h5Z3I.E0j8gzAn45u49X8ga', NULL, '2022-11-19 13:58:08', '2022-11-19 13:58:08'),
(22, 'Destiana Tri Astuti', 'destiyanavivo@gmail.com', NULL, '085709184103', NULL, '$2y$10$wqEgICSKyRScvyHMTf0Y4uV/kTOvoUTFYvaTV/3pxqKNThTX/VJj.', NULL, '2022-11-19 14:18:29', '2022-11-19 14:18:29'),
(23, 'Ranni Setiyanti', 'ranieka8899@gmail.com', 'Mahasiswa', '081367736767', NULL, '$2y$10$h/UGJDk5MdU2.1QcD9JHM.4.2M7m9PzRerCWk8rnViCqClRdp7Xiy', '1668867642.jpg', '2022-11-19 14:19:45', '2022-11-19 14:20:42'),
(24, 'Rahma Maharani', 'rahmamaharannii@gmail.com', 'Mahasiswi', '08979160066', 'Jl. WR. Supratman RT. 04 RW. 04', '$2y$10$Mx6WOz0Klm4nk5vROo1zvurfGZ0FSowfItCWGeN964jWQu21vlQb2', NULL, '2022-11-19 14:22:28', '2022-11-19 14:23:16'),
(25, 'Dea Rahmadani Hidayah', 'dearahmadani104@gmail.com', NULL, '081375036090', NULL, '$2y$10$M8BIbJssS0mUcAwd3N/LquSIztuq0tlX4Iryvlgj/BqkUTlFHUABO', NULL, '2022-11-19 14:23:31', '2022-11-19 14:23:31'),
(26, 'Fransisca Suci Maharani', 'fransiscascell20@gmail.con', NULL, '082179792124', NULL, '$2y$10$MXU90hmuCHEssx9GfjvANOBklo68aLnPgl3tTysY3N55.U3R0pi5y', NULL, '2022-11-19 14:23:35', '2022-11-19 14:23:35'),
(27, 'Fasya Nabila Meywa', 'fasyanabila78@gmail.com', NULL, '083801656767', NULL, '$2y$10$CGXWBeDLya.cy7AkgdYHFuA0VJem0fl16pvjBEyS5QW0LpPiDIwxO', NULL, '2022-11-19 14:27:43', '2022-11-19 14:27:43'),
(28, 'Rizki Iftitah Rahmat', 'riskiiftita@gmail.com', NULL, '082386731457', NULL, '$2y$10$hYIn7UZ9O034DoZSk4mNa.loLY2J.ZcxMxiVv8qpAHm7k/oww7sbW', NULL, '2022-11-19 14:27:49', '2022-11-19 14:27:49'),
(29, 'Margareta Rosalinda', 'margaretarosalinda124@gmail.com', NULL, '081369974295', NULL, '$2y$10$KjkxXbwSXdGuFtkWXA/DhuJgNso3wk6pUNc0hGj0dz8Xmygyl1uxm', NULL, '2022-11-19 14:29:30', '2022-11-19 14:29:30'),
(30, 'Randi Alfian Toni', 'randialfiantoni11@gmail.com', NULL, '082246349801', NULL, '$2y$10$mtrZRljx6ZgblQcjSK0HTO77uqmSMg7OX5ZSRwLil.XyRN.UKtH3u', NULL, '2022-11-19 14:34:04', '2022-11-19 14:34:04'),
(31, 'ARGANA RESWARI', 'arganareswari17@gmail.com', NULL, '085348223107', NULL, '$2y$10$Cu2BmZD5jOaDoFHGkVKyS.pEKrvs1.JWkX7QUmIfKOxWfc.H4bOuK', NULL, '2022-11-19 14:34:05', '2022-11-19 14:34:05'),
(32, 'Ririn Ardianti', 'hariantiririn50@gmail.com', NULL, '085783539174', NULL, '$2y$10$fS1Gomdtv1WZTMxB/S9P5ulc0P8mofnCtd0hr2G7nEiMWIKowggvC', NULL, '2022-11-19 14:39:07', '2022-11-19 14:39:07'),
(33, 'Latifaturohmah', 'latifaturohmah6@gmail.com', NULL, '082290113542', NULL, '$2y$10$XgDS.JSnVE0x3w0DEkDmQOP5J3o3tpDd4kQiN51CgkhV5LMrkk0sa', NULL, '2022-11-19 14:47:22', '2022-11-19 14:47:22'),
(34, 'hilkia natalia wargono', 'hilkiawargono12@gmail.com', NULL, '082280892312', NULL, '$2y$10$ixip0R/7A1XfOZghGZSwnu3iyGggVtPxWk9MYm997daoykAwCueQe', NULL, '2022-11-19 14:49:17', '2022-11-19 14:49:17'),
(35, 'Winarto', 'winarto2803@gmail.com', 'Mahasiswa', '089632155808', 'Jln Jeruk 7 no 53 lingkar timur', '$2y$10$1TWl85VJtlrEd1GDK4oF7.EyHBVOWk2a8Rngcr88rKn0sot04SKNG', '1668869808.jpg', '2022-11-19 14:53:02', '2022-11-19 14:56:48'),
(36, 'LAILA OKTA YUVENTINA', 'lailaokta004@gmail.com', NULL, '083173298071', NULL, '$2y$10$iYrJRzBJFXtZEWUmP64TSeG5YvSInkypPdKnCpw10Bo.31NHV71Jq', NULL, '2022-11-19 14:56:25', '2022-11-19 14:56:25'),
(37, 'LUSI JUNITA', 'lusijunita044@gmail.com', NULL, '082269082241', NULL, '$2y$10$m91qZHF0EwD7wAgYQCNa1.2nuiuShcMlrcSebHLk3F9taTqZLdLuW', NULL, '2022-11-19 14:58:14', '2022-11-19 14:58:14'),
(38, 'Ranissa Yulianti', 'ranissayulianti8260@gmail.com', NULL, '085384018337', NULL, '$2y$10$0F7LZ98AvJuhniOsJP.LlOnjH4fdkQGqX2T/ZcndVDEl/nbYFqUD2', NULL, '2022-11-19 15:09:44', '2022-11-19 15:09:44'),
(39, 'ILSHA YOLANDA', 'ilshayolanda2019@gmail.com', 'Mahasiswa', '085368081780', 'Jalan merawan rt 30, RW 8, Sawah lebar,kota Bengkulu', '$2y$10$JhjU/w0QH2NYflpq1n4Iqu/bkOW5l3/crDHYrjM5YroEejQlNI9Bu', NULL, '2022-11-19 15:22:42', '2022-11-19 15:54:22'),
(40, 'Leni Nursanah', 'leni01011991@gmail.com', 'Mahasiswa', '089628419703', 'Jl Merapi No 13 BKL', '$2y$10$.McxTrizgpItVJ8vJMuEXO/5RUf4lUvw/8562YVIHodQqbFsFsJgu', '1668874734.jpg', '2022-11-19 16:17:37', '2022-11-19 16:18:54'),
(41, 'Dita Ayu Safitri', 'ditacurup422@gmail.com', 'Mahasiswi', '081369202462', 'Gg. Melati, UNIB Belakang.', '$2y$10$ztUOoOx1aCsFoVptjsY4/ujKeRfBl3Amzi2EfhxcnQAPjSUn.y6nK', '1668899344.jpg', '2022-11-19 23:07:11', '2022-11-19 23:09:05'),
(42, 'Mira Rosdiana', 'mirarosdiana875@gmail.com', NULL, '085380289198', NULL, '$2y$10$E3TjaRchNuUwjm8kgxrYhOf/O2IgexmAaRNpql5CKEr12Mtnxrose', NULL, '2022-11-20 00:55:33', '2022-11-20 00:55:33'),
(43, 'Lola Vitaloka', 'lolavitaloka663@gmail.com', NULL, '081269366142', NULL, '$2y$10$ClDPyIOAhNAIJjFDBj.ASuQyYAk9CrMmT9ePnfWBnJ8GCctqLsZRe', NULL, '2022-11-20 01:28:14', '2022-11-20 01:28:14'),
(44, 'Indah khairani', 'bindah551@gmail.com', 'Mahasiswi', '082377454604', 'Jl.Prof.Dr.Hazairin,SH.No.249 Kel.Gunung Alam Arga Makmur', '$2y$10$8QhI7C8ReIZsuQFxSBvHJOnzFqp8IN3FGjNEU/IkvtNPXDhVcA43S', '1668915078.jpg', '2022-11-20 01:40:27', '2022-11-20 03:31:18'),
(45, 'Lara oktaviana', 'oktavianalara915@gmail.com', NULL, '082282395310', NULL, '$2y$10$bmPupIiUfa93Tf/nHAytOuQFLV00UT4PEkLj9qdTv3HWfvQU5Dw7i', NULL, '2022-11-20 01:47:33', '2022-11-20 01:47:33'),
(46, 'Wepi Agustianti', 'wepiagustianti@gmail.com', NULL, '082182027280', NULL, '$2y$10$08le7B41GaRFCxR0Duycp.U3LnddXQJWMfJ1g0f/ZwpatIMQypbg.', NULL, '2022-11-20 01:48:46', '2022-11-20 01:48:46'),
(47, 'Noer Palupi Syananda', 'noerpalupisyananda@gmail.com', NULL, '085273459927', NULL, '$2y$10$4Gk17W/3eDv7VK1aOipEUu1W9IldR9mbP6/wlQcl4jeyvxq8esXlC', NULL, '2022-11-20 02:18:49', '2022-11-20 02:18:49'),
(48, 'Yulia Anisa', 'yuliaanisaa374@gmail.com', NULL, '085609427025', NULL, '$2y$10$Ovj6ACXoF1KwUeb9c/19G..2dJ0/jNgkA8.SvO8B0JK2oCRLEj0sy', NULL, '2022-11-20 03:31:28', '2022-11-20 03:31:28'),
(49, 'ZIKRA FAHIRA', 'zikrafahira918@gmail.com', NULL, '089522319076', NULL, '$2y$10$sLTN9KXEsgo1brQOox4T.epZuVLo/1qtVT3vTvDxrsLOTjlQGLCAK', NULL, '2022-11-20 03:41:31', '2022-11-20 03:41:31'),
(50, 'Ningsi Efriyani', 'ningsiefriyani3@gmail.com', NULL, '085380315236', NULL, '$2y$10$8iM7ieEXRr8FM1ZeeNcorOr.p8SHz9jJOF/R0Wpq4v/SjEv63u1jy', NULL, '2022-11-20 03:46:16', '2022-11-20 03:46:16'),
(51, 'Nur Afifah', 'yyuli2367@gmail.com', NULL, '082290110186', NULL, '$2y$10$xkewNFVeXe4MK3yl7lwfsOrEeU1xApRrMnk8pZcvJ4A.Dd3DTaC0q', NULL, '2022-11-20 03:50:32', '2022-11-20 03:50:32'),
(52, 'YOLLANDHA WULANDARIE', 'yollandha07yo@gmail.com', NULL, '082279300775', NULL, '$2y$10$wrh73U8v6KBHCscB17EM0udH9dSpNhQSJE2YE.zfLRaeiyWX.qf3W', NULL, '2022-11-20 03:55:11', '2022-11-20 03:55:11'),
(53, 'Indah Mutiara', 'indahmt321@gmail.com', NULL, '083172761616', NULL, '$2y$10$2D/6ajlTjczK.POyIjys2ONaU0dd1juU9mhnwRBrJ.3lxeQjGzhCi', NULL, '2022-11-20 04:10:59', '2022-11-20 04:10:59'),
(54, 'Nana Anggreini Lestari Siregar', 'nanaanggreini8@gmail.com', 'Mahasiswi', '083174297242', NULL, '$2y$10$GB3S6OOwqXj1iOGXZHcxPugr3G0Z6YEk/IBSC.Lix5b9fJ02EHlju', '1668917626.jpg', '2022-11-20 04:11:00', '2022-11-20 04:13:46'),
(55, 'Dini Sahhidah', 'sahhidahdini@gmail.com', NULL, '082178915568', NULL, '$2y$10$3JxujxmyWpBtwDtpQWwZCe8o2GY0TNnaovG4WM/jNrRPqsR.qxN6i', NULL, '2022-11-20 04:17:03', '2022-11-20 04:17:03'),
(56, 'Annisa Zahra Nofita', 'anisazahranofita9206@gmail.com', NULL, '089670504416', NULL, '$2y$10$7dtCgaA9lXLt8Yy80oiYg.iWogoGjjDk21aaur//Mheu4gydIxqde', NULL, '2022-11-20 04:28:18', '2022-11-20 04:28:18'),
(57, 'Osi Hidayati', 'osihidayati41@gmail.com', NULL, '083103150543', NULL, '$2y$10$mAQ5hu/LlxAwKkFCCMV.EOe9n7LB6S.vtXK.H7gF4PwzQ5XzO32Mi', NULL, '2022-11-20 04:29:04', '2022-11-20 04:29:04'),
(58, 'Yulsa Trimiranti', 'yulsatrimiranti@gmail.com', NULL, '082287529632', NULL, '$2y$10$czD8HsZrB8xujkE9H8U0he8Nub5wPH3UnhXdMm.aqC7RdSBMcdyeO', NULL, '2022-11-20 04:57:36', '2022-11-20 04:57:36'),
(59, 'Abim Pangestu', 'abimpangestu46@gmail.com', 'Mahasiswa', '0895617115581', 'JL.kinibalu 4 No.29 Rt7/Rw1 Kebun Tebeng', '$2y$10$D7O15BKhtrYn332EyvxJjek.Zs114D5AJy7ci3npky3EiIQTpfoi.', '1668920914.jpg', '2022-11-20 05:06:52', '2022-11-20 05:08:34'),
(60, 'Nessa Alvionita', 'nessaalvionita758@gmail.com', NULL, '083121651514', NULL, '$2y$10$jKl/HTv6ai.xW6IDdAQt9OC2NGRrD8QTK6xv6sNYmCMg1FdqmK37a', NULL, '2022-11-20 05:52:33', '2022-11-20 05:52:33'),
(61, 'Rani Nanda Dewi', 'raninandadewi2017@gmail.com', NULL, '083177656993', NULL, '$2y$10$5WwnwVZfj261TZrQ1PfmLOReFuaKnkWAy5.4Ie5kXtmDOAncuv1py', NULL, '2022-11-20 06:39:42', '2022-11-20 06:39:42'),
(62, 'Fingky Reta Amanda', 'fingkyreta@gmail.com', NULL, '082281530397', NULL, '$2y$10$hZMGi24G31yIqPQgvn9oz.tezOvv2apCngfhc4RTACIiFR/XO6Nk6', NULL, '2022-11-20 07:06:15', '2022-11-20 07:06:15'),
(63, 'Yoza Syahfala', 'yozasyahfala980@gmail.com', NULL, '0895610014959', NULL, '$2y$10$KGT/Tx3a30rrqnZV/5tHQO3vBLNf3.GuTlrFuAkK4UYe1DhcWTR3O', NULL, '2022-11-20 07:13:12', '2022-11-20 07:13:12'),
(64, 'ZELVIA SEPTI WAHYUNI', 'zelviaseptiwahyuni09@gmail.com', NULL, '085896913590', NULL, '$2y$10$/D6XfK66xOlASmylUh3.guDfpW0g.B3CcNPjbsg1DpxxgKd2OROZO', NULL, '2022-11-20 07:16:33', '2022-11-20 07:16:33'),
(65, 'Syntia Oktaviani', 'sintiacurup2020@gmail.com', NULL, '085273236214', NULL, '$2y$10$Oa3Xk7kfNPYRbFz5W4keZuLzP7SjTGrrcCm2ylCBo3jQTqVN5.wUi', NULL, '2022-11-20 07:24:55', '2022-11-20 07:24:55'),
(66, 'Selvi Anisti', 'selvianisti52@gmail.com', NULL, '082281142675', NULL, '$2y$10$s7keQucWCqsWhtgEqSazZ./AcTwCppoZ2lM.Od/X/LQzr2Fqbkuhq', NULL, '2022-11-20 07:44:17', '2022-11-20 07:44:17'),
(67, 'Dia Maya sari', 'diamayasari944@gmail.com', NULL, '082199655521', NULL, '$2y$10$1XQ0FFgkUSLVKyf.FXOUheiB0wmkJZr2znVsPdYOvClFsC/mGrt0u', NULL, '2022-11-20 08:02:43', '2022-11-20 08:02:43'),
(68, 'Fitria Herawati', 'fitriaherawati843@gmail.com', NULL, '082210265014', NULL, '$2y$10$va29G1FwT9q5.X6UXT.LcOXmhh4OxeWpeBoeibXjopnliocQVqmfu', NULL, '2022-11-20 10:44:42', '2022-11-20 10:44:42'),
(69, 'Rhima intan kurniasih', 'intanrhima@gmail.com', NULL, '082289308894', NULL, '$2y$10$dYerdPXI4YDA8/0i5IHLMOUFy5Nap41utKc3f3p1l2ATTwohl4a2S', NULL, '2022-11-20 11:14:43', '2022-11-20 11:14:43'),
(70, 'Miranti Wahyuni', 'mirantiwahyuni09@gmail.com', NULL, '08998290313', NULL, '$2y$10$QObgD1qX36lfi.VMhz/.eu7dbvm0Xm8cKN9wdAKnEZfVVWQebazwG', NULL, '2022-11-20 11:21:55', '2022-11-20 11:21:55'),
(71, 'Monika Marbun', 'monikamarbun937@gmail.com', NULL, '082279858778', NULL, '$2y$10$8m1avngWJrQtyKRlIFnFSui0FsQknyt80URY2e.Y2kbEPE.KOeftm', NULL, '2022-11-20 11:29:59', '2022-11-20 11:29:59'),
(72, 'Yana Atiya Kusumaningsih', 'yanaatiya0@gmail.com', NULL, '081273427729', NULL, '$2y$10$7.DinLLZ8S2Pas3SgnFLauIOMQiuGGNUCd396zlZq8n2gi9Z2tbF2', NULL, '2022-11-20 11:35:00', '2022-11-20 11:35:00'),
(73, 'Putri Suci Ramadani', 'putrisucir123@gmail.com', NULL, '085789440235', NULL, '$2y$10$7Sr3rjF9NkygFZ2v3mH3heOab1sSQpv3yZ3l3SKKUp1zR/npazlO2', NULL, '2022-11-20 12:04:17', '2022-11-20 12:04:17'),
(74, 'Lara Laurenica Angelina', 'laraajah2@gmail.com', NULL, '089523369781', NULL, '$2y$10$EOJwzDvCzSY2rxGyGC413ud/U8ySbvVN/EWm5OtN.Ixbc02MdxwTe', NULL, '2022-11-20 13:17:41', '2022-11-20 13:17:41'),
(75, 'Sesti Oktarina', 'sestioktarina11@gmail.com', NULL, '083176990150', NULL, '$2y$10$wr8.O9wwuiuC.fkvOB1NnOVH1ciok9rgW1LXoLv2odGLkBzf7vgdu', NULL, '2022-11-21 03:33:34', '2022-11-21 03:33:34'),
(76, 'suci nur hanifah', 'sucinurhanifah25@gmail.com', 'mahasiswa', '0895612563838', 'perumahan sakinah, muara bangka hulu', '$2y$10$lhPkSlANvHs9LTAt6RSYguPZibtKu9gloHTLQrDbrFQnMOq77EGZ2', '1669556350.jpg', '2022-11-27 13:36:35', '2022-11-27 13:39:10'),
(77, 'Ervia Audy salsabilla', 'revia8596@gmail.com', NULL, '085768684106', NULL, '$2y$10$l1FdZXl9rwG86st9FBMuOuPisEKN8iR.WbLIzx0mlwSdHxwBO6/AW', NULL, '2022-11-27 13:37:32', '2022-11-27 13:37:32'),
(78, 'Muhamad Fajar Rhomadon', 'fajarrhadon@gmail.com', NULL, '082184169678', NULL, '$2y$10$DNmW9vJ02TvUZ6Y9mLjK3eXxVy22ldz3CcGjB5hdv.uex72tvG2xu', NULL, '2022-11-29 17:11:37', '2022-11-29 17:11:37'),
(79, 'Jdjdj', 'jdjdjjd@gmail.com', NULL, '085792937392993737382', NULL, '$2y$10$EFzsyTeYpcS7qqUHFZW5KeDRex7FE0gLJwW3xkO8Vok9h211s0SUu', NULL, '2022-12-01 13:45:59', '2022-12-01 13:45:59'),
(80, 'Anta Akbar', 'antaakbar.05@gmail.com', NULL, '0895604759799', NULL, '$2y$10$u8dVDUetidNT3s3BDJ1ayeaARkOSRPiIlvgnn3kQYSImYNuDBAZUW', NULL, '2022-12-03 14:40:17', '2022-12-03 14:40:17'),
(81, 'Tilza Levia', 'tilzalevia@gmail.com', NULL, '081539299344', NULL, '$2y$10$tC5qsgW1l8EKXsqCLFDWKOOQdLJ4O9ecyBLgUwhmUArHAqLG.gweS', NULL, '2022-12-04 14:18:23', '2022-12-04 14:18:23'),
(82, 'Hayweb Official', 'hayweb.id@gmail.com', NULL, '089675013500', NULL, '$2y$10$KYK9jyqPLztIAT/n3EgfPO5.9sWuW8lf7CZfW.8ZjLIFBBysAORnG', NULL, '2022-12-14 15:47:37', '2022-12-14 15:47:37'),
(83, 'Nova Kurnia', 'novakurnia355@gmail.com', NULL, '085368885636', NULL, '$2y$10$ylwefPzy/fXzFRT0OSM2m.YHwCxCc0DC6C4E0WANxDLJFwozOoXgy', NULL, '2022-12-18 02:28:02', '2022-12-18 02:28:02'),
(84, 'Dani', 'sociolinguisticteam4@gmail.com', NULL, '085234405096', NULL, '$2y$10$HajhaSaIRGBsDDj2r0OOi.v0TfQpcCP.RDJyEFcxqubh/rqANaEqC', NULL, '2022-12-19 15:22:43', '2022-12-19 15:22:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_kelas_materi`
--

CREATE TABLE `member_kelas_materi` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_kelas_materi` int(11) NOT NULL,
  `status` enum('Belum','Selesai') NOT NULL DEFAULT 'Belum',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `member_kelas_materi`
--

INSERT INTO `member_kelas_materi` (`id`, `id_member`, `id_kelas`, `id_kelas_materi`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 9, 'Selesai', '2022-04-26 02:56:45', '2022-04-26 04:06:04'),
(2, 1, 2, 10, 'Selesai', '2022-04-26 02:56:45', '2022-04-26 04:08:22'),
(3, 1, 2, 11, 'Selesai', '2022-04-26 02:56:45', '2022-04-26 04:08:28'),
(4, 5, 5, 22, 'Selesai', '2022-11-14 03:05:37', '2022-11-14 08:29:43'),
(5, 5, 5, 23, 'Selesai', '2022-11-14 03:05:37', '2022-11-14 08:29:43'),
(6, 7, 6, 24, 'Belum', '2022-11-14 09:55:56', '2022-11-14 09:55:56'),
(7, 7, 5, 22, 'Selesai', '2022-11-14 09:56:01', '2022-11-14 12:10:44'),
(8, 7, 5, 23, 'Selesai', '2022-11-14 09:56:01', '2022-11-14 12:10:44'),
(9, 6, 9, 30, 'Belum', '2022-11-14 10:40:29', '2022-11-14 10:40:29'),
(10, 6, 9, 31, 'Belum', '2022-11-14 10:40:29', '2022-11-14 10:40:29'),
(11, 7, 9, 30, 'Belum', '2022-11-14 10:41:10', '2022-11-14 10:41:10'),
(12, 7, 9, 31, 'Belum', '2022-11-14 10:41:10', '2022-11-14 10:41:10'),
(13, 8, 10, 32, 'Selesai', '2022-11-14 12:30:55', '2022-11-14 12:54:35'),
(14, 9, 10, 32, 'Selesai', '2022-11-14 13:25:22', '2022-11-15 09:47:51'),
(15, 6, 10, 32, 'Selesai', '2022-11-15 10:49:31', '2022-11-15 10:50:21'),
(16, 11, 10, 32, 'Selesai', '2022-11-16 06:41:07', '2022-11-17 08:20:56'),
(17, 11, 11, 33, 'Belum', '2022-11-19 13:24:44', '2022-11-19 13:24:44'),
(18, 84, 14, 36, 'Belum', '2022-12-19 15:23:39', '2022-12-19 15:23:39'),
(19, 82, 14, 36, 'Selesai', '2022-12-26 12:58:38', '2022-12-26 12:58:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_kelas_ujian`
--

CREATE TABLE `member_kelas_ujian` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `member_kelas_ujian`
--

INSERT INTO `member_kelas_ujian` (`id`, `id_kelas`, `id_member`, `nilai`, `created_at`) VALUES
(2, 5, 5, 50, '2022-11-14 08:17:15'),
(3, 5, 5, 50, '2022-11-14 08:26:58'),
(4, 5, 5, 100, '2022-11-14 08:29:43'),
(5, 6, 7, 0, '2022-11-14 10:05:37'),
(6, 8, 7, 100, '2022-11-14 10:14:41'),
(7, 8, 7, 0, '2022-11-14 10:25:00'),
(8, 9, 7, 100, '2022-11-14 10:33:44'),
(9, 5, 7, 100, '2022-11-14 12:10:44'),
(10, 10, 8, 100, '2022-11-14 12:54:35'),
(11, 10, 9, 100, '2022-11-15 09:47:51'),
(12, 10, 6, 100, '2022-11-15 10:50:21'),
(13, 10, 11, 100, '2022-11-17 08:20:56'),
(14, 14, 82, 100, '2022-12-26 12:58:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor`
--

CREATE TABLE `mentor` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `pendidikan` text DEFAULT NULL,
  `jenis_kelamin` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `foto` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mentor`
--

INSERT INTO `mentor` (`id`, `nama`, `email`, `no_hp`, `password`, `pendidikan`, `jenis_kelamin`, `alamat`, `deskripsi`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(2, 'Jiraiya', 'jiraiya@gmail.com', '087717789123', '$2y$10$fsfpTv5x/sBM3KODso7pjOKlik0ZHpi8DI9XOxW.GM/6uFN6aIkT6', 'Sannin', 'Laki - Laki', 'Konoha', 'Jiraiya was an exceptionally powerful shinobi, hailed as one of the greatest ninja of his generation and that Konoha ever produced.', 1, '1668415725.jpg', '2022-10-09 06:14:36', '2022-11-14 08:48:45'),
(3, 'Topik', 'topik@gmail.com', '081111111111', '$2y$10$s0HwrxnNVZHwaQj9TwxRhe4KA2D0SAV352l.VZaHw2dMB0YqpBbe.', 's1 s2 s3', 'Laki - Laki', 'Jalan raya', 'saya seorang pemberani', 1, NULL, '2022-10-11 18:49:43', '2022-11-03 12:56:49'),
(5, 'Junaedi Kurniawan', 'juanedi@gmail.com', '081222444555', '$2y$10$s0HwrxnNVZHwaQj9TwxRhe4KA2D0SAV352l.VZaHw2dMB0YqpBbe.', 'S1 Pendidikan Rohani', 'Laki - Laki', 'Jalan pisang raya nomor 11 jakarta pusat', 'Saya pribadi yang hebat', 1, '1666791077.jpeg', '2022-10-26 13:31:17', '2022-11-03 12:56:51'),
(6, 'Rohman', 'rohmano542@gmail.com', '081333222111', NULL, 'S1 Teknik Informatika Universitas Indonesia', 'Laki - Laki', 'Jalan Raya Pangauban', 'Menurut laman Guider, mentor adalah seseorang yang bertindak sebagai penasihat atau pelatih untuk pekerja yang kurang berpengalaman. Mereka umumnya bertanggung jawab untuk memberikan pengetahuan seputar skill profesional dari perspektif yang lebih berpengalaman.', 0, NULL, '2022-11-03 12:22:30', '2022-11-03 12:50:09'),
(7, 'riki', 'riki@gmail.com', '08129481248', '$2y$10$JkhZbJ.XpChB1IHy0rw.2uFXYracGAf8O0KNtN.1hRAxCTL6hRRTy', 'asdjkasjd', 'Laki - Laki', 'askdjaskd', 'askdjhasd', 1, NULL, '2022-11-14 09:46:02', '2022-11-14 09:46:02'),
(8, 'X', 'c@gmail.com', '0987654321234', NULL, 'X', 'Perempuan', 'X', 'X', 0, NULL, '2022-11-15 07:38:07', '2022-11-15 07:38:07'),
(9, 'Kontol', 'kontol@kontol.com', '081234567890', NULL, 'Kontol', 'Laki - Laki', 'Kontol', 'Kontol', 0, NULL, '2022-11-15 17:32:15', '2022-11-15 17:32:15'),
(10, 'Muhammad Daffa Alfajri', 'dfajri856@gmail.com', '082281773157', '$2y$10$sthy8ezuVbsbTrmeB5q2guWPb.MuOnlHg3zbNmU2S0Ij8koo.jMWO', '-', 'Laki - Laki', 'Bengkulu, JL. WR. Supratman, Kelurahan Kandang Limun', 'Tech Enthusiast', 1, '1668863399.jpg', '2022-11-19 13:10:03', '2022-11-19 13:10:03'),
(11, 'Betra Adi Afrianto', 'adiafriantobetra@gmail.com', '085658313942', NULL, 'Mahasiswa', 'Laki - Laki', 'Gunung Megang', 'Tidak ada keberhasilan tanpa kerja keras', 0, NULL, '2022-11-20 11:23:11', '2022-11-20 11:23:11'),
(12, 'Rakensya S Gurukinayan', 'rakensyagurky7@gmail.com', '087896490277', NULL, 'Fkip', 'Perempuan', 'Gang Juwita pondokan Artika', 'Semoga nanti tamat tepat waktu', 0, NULL, '2022-11-21 08:37:44', '2022-11-21 08:37:44'),
(13, 'Niken Febrianita', 'nikenpebrianti70@gmail.com', '083187685696', NULL, 'Mahasiswa', 'Perempuan', 'Desa Aur Gading, Kec.Kerkap Kab.Bengkulu Utara', 'Lulusan dari Sma 04 Negeri Bengkulu Utara. Memiliki hobby travelling dan sekarang tengah menempuh Pendidikan di Universitas Bengkulu mengambil jurusan Bahasa dan Seni Program Study Bahasa Indonesia Fakultas Keguruan dan Ilmu Pendidikan.', 0, NULL, '2022-11-22 06:43:06', '2022-11-22 06:43:06'),
(14, 'Muhamad Fajar Rhomadon', 'fajarrhadon@gmail.com', '082184169678', NULL, 'SDN 26 Tebing Tinggi\r\nMTSN 1 Empat Lawang\r\nSMAN 2 Tebing Tinggi\r\nUniversitas Bengkulu prodi teknik elektro', 'Laki - Laki', 'Kandang limun gang karya muara bangka hulu, kota bengkulu', 'Seorang mahasiswa prodi teknik elektro di universitas Bengkulu yang ingin terus belajar dan mencari arti kehidupan', 0, NULL, '2022-11-29 17:10:44', '2022-11-29 17:10:44'),
(15, 'Dani Fazli', 'danifazli1124@gmail.com', '08985792211', '$2y$10$Mui66z5G8Ybxtbz7JL6CceztfBT.4k8.WfDFXpiDV06ial1BvqoxK', 'S1 Teknik-Elektro', 'Laki - Laki', 'Jalan Pratu Aidit 6 RT05/RW 02, Bajak, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38115', 'Enterpreuner', 1, NULL, '2022-11-30 10:47:27', '2022-11-30 10:47:27'),
(16, 'Anta Akbar', 'antaakbar.5@gmail.com', '0895604759799', '$2y$10$zRWbpQUoJbsL4.maF4Y1buZ1KPyCkTqaLAz0y2CX58pu6BV1WExYq', 'Universitas Bengkulu Jurusan Teknik Elektro', 'Laki - Laki', 'Jl. Durian 12, Kel. Bumi Ayu, Kec. Selebar, Kota Bengkulu', 'Seorang pribadi  yang ingin belajar lebih untuk lebih mengetahui kebenaran tentang dunia', 1, NULL, '2022-12-03 14:44:21', '2022-12-08 14:00:08'),
(17, 'Daffa Alf', 'ababild@gmail.com', '08768281027', '$2y$10$z1Sxcqzj6UovymS0/KeoBOR1Cqqg8S8mcm9GIAwFE83Fxb8ruPxZq', 'Waw', 'Laki - Laki', 'Waw', 'Waw', 1, NULL, '2022-12-03 14:59:49', '2022-12-08 14:00:27'),
(18, 'Tilza Levia', 'tilzalevia@gmail.com', '081539299344', '$2y$10$a..0fMPHBRI6DyLbFBs0yu7A/uwF379xkZXuNqpxSJ6OSbTbpHJYe', 'S-1 Pendidikan Matematika', 'Perempuan', 'Pematang Gubernur', '...', 1, NULL, '2022-12-04 03:01:15', '2022-12-13 17:25:32'),
(19, 'Huda', 'dcloth377@gmail.com', '089798872312', '$2y$10$iav2Lj9MwAK3rQN/jXRIpOg.FyKwwMFEkuTNuKk8vQmMzhjpfdz/m', 'asd', 'Laki - Laki', 'ASdas', 'asd', 1, NULL, '2022-12-13 17:28:06', '2022-12-13 17:28:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor_saldo`
--

CREATE TABLE `mentor_saldo` (
  `id` int(11) NOT NULL,
  `id_mentor` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mentor_saldo`
--

INSERT INTO `mentor_saldo` (`id`, `id_mentor`, `saldo`, `updated_at`) VALUES
(2, 3, 234, '2022-04-26 02:56:45'),
(3, 2, 9501069, '2022-11-14 03:05:37'),
(4, 7, 22813, '2022-11-14 09:55:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penarikan`
--

CREATE TABLE `penarikan` (
  `id` int(11) NOT NULL,
  `id_mentor` int(11) DEFAULT NULL,
  `nama_rekening` varchar(100) DEFAULT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `no_rekening` varchar(100) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `diterima` int(11) DEFAULT NULL,
  `status` enum('Proses','Berhasil','Gagal') DEFAULT 'Proses',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penarikan`
--

INSERT INTO `penarikan` (`id`, `id_mentor`, `nama_rekening`, `bank`, `no_rekening`, `nominal`, `admin`, `diterima`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Oboy Max', 'BNI', '43675856856', 200000, 10000, 190000, 'Gagal', '2022-04-27 06:40:41', '2022-04-27 08:10:47'),
(2, 3, 'Test', 'BCA', '346546754', 200000, 10000, 190000, 'Berhasil', '2022-04-27 08:12:06', '2022-04-27 08:16:46'),
(3, 2, 'Oboy Max', 'BNI', '3465476587568', 250000, 12500, 237500, 'Gagal', '2022-11-14 03:11:40', '2022-11-14 03:58:48'),
(4, 2, 'Oboy Max', 'Mandiri', '3476457654', 500000, 25000, 475000, 'Berhasil', '2022-11-14 03:59:36', '2022-11-14 03:59:56'),
(5, 2, '123123', 'BNI', '123123123', 200000, 10000, 190000, 'Proses', '2022-11-14 12:13:26', '2022-11-14 12:13:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `nama_web` varchar(255) DEFAULT NULL,
  `email_web` varchar(100) DEFAULT NULL,
  `deskripsi_web` text DEFAULT NULL,
  `logo_web` text DEFAULT NULL,
  `no_wa` varchar(100) DEFAULT NULL,
  `embed_map` text DEFAULT NULL,
  `alamat_web` text DEFAULT NULL,
  `nama_rekening1` varchar(150) DEFAULT NULL,
  `no_rekenging1` varchar(150) DEFAULT NULL,
  `bank1` enum('BCA','Mandiri','BNI','BRI','Danamon') DEFAULT NULL,
  `nama_rekening2` varchar(150) DEFAULT NULL,
  `no_rekenging2` varchar(150) DEFAULT NULL,
  `bank2` enum('BCA','Mandiri','BNI','BRI','Danamon') DEFAULT NULL,
  `biaya_penarikan` int(11) DEFAULT NULL,
  `minimal_penarikan` int(11) DEFAULT NULL,
  `mercant_id` text DEFAULT NULL,
  `client_key` text DEFAULT NULL,
  `server_key` text DEFAULT NULL,
  `title_kecil_home` text DEFAULT NULL,
  `title_besar_home` text DEFAULT NULL,
  `penjelasan_home` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_web`, `email_web`, `deskripsi_web`, `logo_web`, `no_wa`, `embed_map`, `alamat_web`, `nama_rekening1`, `no_rekenging1`, `bank1`, `nama_rekening2`, `no_rekenging2`, `bank2`, `biaya_penarikan`, `minimal_penarikan`, `mercant_id`, `client_key`, `server_key`, `title_kecil_home`, `title_besar_home`, `penjelasan_home`, `facebook`, `twitter`, `instagram`, `updated_at`) VALUES
(1, 'Onschool', 'onschool.id@gmail.com', 'Onschool adalah platform pembelajaran kelas online yang berisi mentor - metor yang berpengalaman dalam bidangnya.', '1668673414.png', '08985792211', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15924.467277690517!2d102.2625257!3d-3.7847493!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb26ac441211333ab!2sOnschool%20Indonesia!5e0!3m2!1sid!2sid!4v1668427128075!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'Jalan Pratu Aidit 6 RT05/RW 02, Bajak, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu 38115', 'DANI FAZLI', '0010201201080', 'Mandiri', 'Nama 2', '57456866', 'BNI', 10, 200000, 'G379303342', 'Mid-client-MJ6Ctl0OeJzSqbYi', 'Mid-server-UhpkLNgc0Xm--9TsZop4bBQN', 'Mulai kelas favorit Anda', 'Sekarang belajar dari mana saja, dan bangun karir cemerlang', 'Online Student Centered Learning', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/onschool.id', '2022-11-17 08:23:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim`
--

CREATE TABLE `tim` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tim`
--

INSERT INTO `tim` (`id`, `nama`, `jabatan`, `gambar`, `created_at`, `updated_at`) VALUES
(3, 'Dani Fazli', 'CEO', '1670951393.png', '2022-12-13 17:09:53', '2022-12-13 17:09:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_mentor` (`id_mentor`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `forum_komentar`
--
ALTER TABLE `forum_komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `tipe_user` (`tipe_user`),
  ADD KEY `id_forum` (`id_forum`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mentor` (`id_mentor`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kelas_faq`
--
ALTER TABLE `kelas_faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `kelas_materi`
--
ALTER TABLE `kelas_materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `kelas_soal`
--
ALTER TABLE `kelas_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `kelas_tools`
--
ALTER TABLE `kelas_tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member_kelas_materi`
--
ALTER TABLE `member_kelas_materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_kelas_materi` (`id_kelas_materi`);

--
-- Indeks untuk tabel `member_kelas_ujian`
--
ALTER TABLE `member_kelas_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_member` (`id_member`);

--
-- Indeks untuk tabel `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mentor_saldo`
--
ALTER TABLE `mentor_saldo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mentor` (`id_mentor`);

--
-- Indeks untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mentor` (`id_mentor`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `forum_komentar`
--
ALTER TABLE `forum_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kelas_faq`
--
ALTER TABLE `kelas_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kelas_materi`
--
ALTER TABLE `kelas_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `kelas_soal`
--
ALTER TABLE `kelas_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kelas_tools`
--
ALTER TABLE `kelas_tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `member_kelas_materi`
--
ALTER TABLE `member_kelas_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `member_kelas_ujian`
--
ALTER TABLE `member_kelas_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `mentor_saldo`
--
ALTER TABLE `mentor_saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penarikan`
--
ALTER TABLE `penarikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
