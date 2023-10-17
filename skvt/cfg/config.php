<?php
$error = '';
date_default_timezone_set("Asia/Jakarta");
class config
{
    //Koneksi Database
    public function __construct()
    {
        $host = "localhost";
        $dbname = "sistem_keuangan";
        $user = "root";
        $password = "";
        $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $password);
    }
    //Mata Uang
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp" . number_format($angka, 0, ".", ".") . " IDR";
        return $hasil_rupiah;
    }
    function hitungPerhari()
    {
        $date = date('d');
        $query = $this->db->prepare("SELECT SUM(IF( DAY(created_at) = $date, biaya_pengeluaran, 0)) AS pengeluaran_hari
        FROM pengeluaran");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    //pemasukan
    function hitungPerhari2()
    {
        $date = date('d');
        $query = $this->db->prepare("SELECT SUM(IF( DAY(created_at) = $date, jumlah_pemasukan, 0)) AS pemasukan_hari
        FROM pemasukan");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    //pemasukan
    function hitungPerhari3()
    {
        $date = date('d');
        $query = $this->db->prepare("SELECT SUM(IF( DAY(create_at) = $date, total_harga, 0)) AS transaksi_hari
         FROM transaksi");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    //color change
    function colorChange($get_aksi)
    {
        if ($get_aksi == "Belum" || $get_aksi == "belum") {
            $color = "text-danger";
        } else {
            $color = "text-success";
        }
        return $color;
    }

    //Menampilkan All
    public function showKaryawan()
    {
        $query = $this->db->prepare("SELECT * FROM karyawan ORDER BY created_at DESC");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPemilikToko()
    {
        $query = $this->db->prepare("SELECT * FROM pemilik_toko ORDER BY create_at DESC");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showBarang()
    {
        $query = $this->db->prepare("SELECT * FROM barang ORDER BY create_at DESC");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPemasukan()
    {
        $query = $this->db->prepare("SELECT * FROM pemasukan ORDER BY create_at DESC");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showPengeluaran()
    {
        $query = $this->db->prepare("SELECT * FROM pengeluaran ORDER BY created_at DESC");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showTransaksi()
    {
        $query = $this->db->prepare("SELECT * FROM transaksi ORDER BY create_at DESC");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function pemasukan()
    {
        $query = $this->db->prepare("SELECT * FROM pemasukan ORDER BY created_at");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    public function showMaxKaryawan()
    {
        $query = $this->db->prepare("SELECT max(id_karyawan) as kodeTerbesar FROM karyawan");
        $query->execute();
        $data = $query->fetch();
        $kode_karyawan = $data['kodeTerbesar'];
        $urutan = (int) substr($kode_karyawan, 11, 5);
        $urutan++;
        $date = date("dmY");
        $huruf = "kar" . $date;
        $kd = $huruf . sprintf("%04s", $urutan);
        return $kd;
    }
    public function showMaxBarang()
    {
        $query = $this->db->prepare("SELECT max(id_barang) as kodeTerbesar FROM barang");
        $query->execute();
        $data = $query->fetch();
        $kode_barang = $data['kodeTerbesar'];
        $urutan = (int) substr($kode_barang, 11, 5);
        $urutan++;
        $date = date("dmY");
        $huruf = "brg" . $date;
        $kd = $huruf . sprintf("%04s", $urutan);
        return $kd;
    }
    public function showMaxTransaksi()
    {
        $query = $this->db->prepare("SELECT max(id_transaksi) as kodeTerbesar FROM transaksi");
        $query->execute();
        $data = $query->fetch();
        $kode_trn = $data['kodeTerbesar'];
        $urutan = (int) substr($kode_trn, 11, 5);
        $urutan++;
        $date = date("dmY");
        $huruf = "trn" . $date;
        $kd = $huruf . sprintf("%04s", $urutan);
        return $kd;
    }
    public function showMaxPengeluaran()
    {
        $query = $this->db->prepare("SELECT max(id_pengeluaran) as kodeTerbesar FROM pengeluaran");
        $query->execute();
        $data = $query->fetch();
        $kode_peng = $data['kodeTerbesar'];
        $urutan = (int) substr($kode_peng, 11, 5);
        $urutan++;
        $date = date("dmY");
        $huruf = "PEN" . $date;
        $kd = $huruf . sprintf("%04s", $urutan);
        return $kd;
    }
    // belum fix
    public function penghitungMinggu($tgl_awal, $tgl_akhir)
    {
        $query = $this->db->prepare("SELECT SUM(biaya_pengeluaran) FROM pengeluaran WHERE created_at=? >= created_at=?");
        $query->bindParam(1, $tgl_awal);
        $query->bindParam(2, $tgl_akhir);
        $query->execute();
        $query->fetchColumn();
    }
    public function showMaxPemilikToko()
    {
        $query = $this->db->prepare("SELECT max(id) as kodeTerbesar FROM pemilik_toko");
        $query->execute();
        $data = $query->fetch();
        $kode_karyawan = $data['kodeTerbesar'];
        $urutan = (int) substr($kode_karyawan, 11, 5);
        $urutan++;
        $date = date("dmY");
        $huruf = "pem" . $date;
        $kd = $huruf . sprintf("%04s", $urutan);
        return $kd;
    }
    public function showMaxAkses()
    {
        $query = $this->db->prepare("SELECT max(id_akses) as kodeTerbesar FROM akses_login");
        $query->execute();
        $data = $query->fetch();
        $kode_akses = $data['kodeTerbesar'];
        $urutan2 = (int) substr($kode_akses, 14, 5);
        $urutan2++;
        $date = date("dmY");
        $huruf2 = "akses" . $date;
        $kd2 = $huruf2 . sprintf("%04s", $urutan2);
        return $kd2;
    }
    public function hitungPengguna()
    {
        $query = $this->db->prepare("SELECT COUNT(id_akses)
        FROM akses_login");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungBelumBaca()
    {
        $query = $this->db->prepare("SELECT COUNT(id) FROM pesan where status_baca='belum'");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPelayananSku()
    {
        $query = $this->db->prepare("SELECT COUNT(id)
        FROM sku");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPelayananDOM()
    {
        $query = $this->db->prepare("SELECT COUNT(id)
        FROM dom");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPelayananDomH()
    {
        $query = $this->db->prepare("SELECT COUNT(id)
        FROM domh");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPelayananSkbpm()
    {
        $query = $this->db->prepare("SELECT COUNT(id)
        FROM skbpm");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }
    public function hitungPelayananSktm()
    {
        $query = $this->db->prepare("SELECT COUNT(id)
        FROM sktm");
        $query->execute();
        $data = $query->fetchColumn();
        return $data;
    }

    //SHOW AKUN
    public function showAkun()
    {
        $query = $this->db->prepare("SELECT * FROM akses_login ORDER BY create_at DESC LIMIT 25");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    //SHOW AKUN
    public function showPesan()
    {
        $query = $this->db->prepare("SELECT * FROM pesan ORDER BY create_at ASC LIMIT 50");
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }
    // Tambah Barang
    public function tambahBarang($idx, $jk, $sk, $wk, $hb, $hg, $hs, $stk, $tb, $ket)
    {
        $createAT = date("Y-m-d H:i:s");
        $data = $this->db->prepare('INSERT INTO barang (id_barang, jenis_kain, seri_kain, warna_kain, harga_beli, harga_grosir, harga_satuan, stok, total_berat, ket, create_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $data->bindParam(1, $idx);
        $data->bindParam(2, $jk);
        $data->bindParam(3, $sk);
        $data->bindParam(4, $wk);
        $data->bindParam(5, $hb);
        $data->bindParam(6, $hg);
        $data->bindParam(7, $hs);
        $data->bindParam(8, $stk);
        $data->bindParam(9, $tb);
        $data->bindParam(10, $ket);
        $data->bindParam(11, $createAT);
        $data->execute();
        return $data->rowCount();
    }
    //Ubah Barang
    public function ubahDataBarang($idx, $jk, $sk, $wk, $hb, $hg, $hs, $stk, $tb, $ket)
    {
        $updateAT = date("Y-m-d H:i:s");
        $data = $this->db->prepare('UPDATE barang set jenis_kain=?, seri_kain=?, warna_kain=?, harga_beli=?, harga_grosir=?, harga_satuan=?, stok=?, total_berat=?, ket=?, update_at=? where id_barang=?');
        $data->bindParam(1, $jk);
        $data->bindParam(2, $sk);
        $data->bindParam(3, $wk);
        $data->bindParam(4, $hb);
        $data->bindParam(5, $hg);
        $data->bindParam(6, $hs);
        $data->bindParam(7, $stk);
        $data->bindParam(8, $tb);
        $data->bindParam(9, $ket);
        $data->bindParam(10, $updateAT);
        $data->bindParam(11, $idx);

        $data->execute();
        return $data->rowCount();
    }
    // Tambah Pengeluaran
    public function tambahPengeluaran($idx, $idx_akses, $jenis_peng, $bya, $ket, $foto, $tmp, $status)
    {
        $createAT = date("Y-m-d H:i:s");
        $foto_bukti = date('dmHis') . $foto;
        $path = "../../assets/bukti/" . $foto_bukti;
        if (move_uploaded_file($tmp, $path)) {
            $data = $this->db->prepare('INSERT INTO pengeluaran (id_pengeluaran, id, jenis_pengeluaran, biaya_pengeluaran, ket, bukti_foto, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $data->bindParam(1, $idx);
            $data->bindParam(2, $idx_akses);
            $data->bindParam(3, $jenis_peng);
            $data->bindParam(4, $bya);
            $data->bindParam(5, $ket);
            $data->bindParam(6, $foto_bukti);
            $data->bindParam(7, $status);
            $data->bindParam(8, $createAT);
            $data->execute();
            if ($data) {
                echo "<script type='text/javascript'>alert('Berhasil Menambahkan Data!');window.location.href = '../pemilik_toko/informasi_pengeluaran';</script>"; //redirect halaman
            } else {
                echo "<script type='text/javascript'>alert('Gagal Menambahkan Data!');window.location.href = '../pemilik_toko/pengeluaran';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Gagal mengupload anda diharuskan mengisi yang diwajibkan!');window.location.href = '../pemilik_toko/pengeluaran';</script>";
        }
    }
    // Ubah Pengeluaran
    public function ubahDataPengeluaran(
        $idx,
        $idx_akses,
        $jenis_peng,
        $bya,
        $ket,
        $foto,
        $tmp,
        $status
    ) {
        $updateAT = date("Y-m-d H:i:s");
        if (empty($foto)) {
            $query = $this->db->prepare('UPDATE pengeluaran set id=?, jenis_pengeluaran=?, biaya_pengeluaran=?, ket=?, status=?, update_at=?  where id_pengeluaran=?');
            $query->bindParam(1, $idx_akses);
            $query->bindParam(2, $jenis_peng);
            $query->bindParam(3, $bya);
            $query->bindParam(4, $ket);
            $query->bindParam(5, $status);
            $query->bindParam(6, $updateAT);
            $query->bindParam(7, $idx);

            $query->execute();
            if ($query) {
                echo "<script type='text/javascript'>alert('Berhasil Mengubah Data!');window.location.href = '../pemilik_toko/informasi_pengeluaran';</script>"; //redirect halaman
            } else {
                echo "<script type='text/javascript'>alert('Gagal Mengubah Data!');window.location.href = '../pemilik_toko/ubah_data_pengeluaran';</script>";
            }
        } else {
            $foto_bukti = date('dmHis') . $foto;
            $path = "../../assets/bukti/" . $foto_bukti;
            if (move_uploaded_file($tmp, $path)) {
                $query = $this->db->prepare("SELECT * FROM pengeluaran where id_pengeluaran=?");
                $query->bindParam(1, $idx);
                $query->execute();
                $data = $query->fetch();
                if (is_file("../../assets/bukti/" . $data['bukti_foto'])) {
                    unlink("../../assets/bukti/" . $data['bukti_foto']);
                }
                $queryUpdate = $this->db->prepare('UPDATE pengeluaran set id=?, jenis_pengeluaran=?, biaya_pengeluaran=?, ket=?, bukti_foto=?, status=?, update_at=?  where id_pengeluaran=?');
                $queryUpdate->bindParam(1, $idx_akses);
                $queryUpdate->bindParam(2, $jenis_peng);
                $queryUpdate->bindParam(3, $bya);
                $queryUpdate->bindParam(4, $ket);
                $queryUpdate->bindParam(5, $foto_bukti);
                $queryUpdate->bindParam(6, $status);
                $queryUpdate->bindParam(7, $updateAT);
                $queryUpdate->bindParam(8, $idx);
                $queryUpdate->execute();
                if ($queryUpdate) {
                    echo "<script type='text/javascript'>alert('Berhasil Mengubah Data!');window.location.href = '../pemilik_toko/informasi_pengeluaran.php';</script>"; //redirect halaman
                } else {
                    echo "<script type='text/javascript'>alert('Gagal Mengubah Data!');window.location.href = '../pemilik_toko/ubah_data_pengeluaran';</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Gagal mengupload anda diharuskan mengisi yang diwajibkan!');window.location.href = '../pemilik_toko/ubah_data_pengeluaran';</script>";
            }
        }
    }
    //TambahKaryawan
    public function tambahKaryawan($idx, $idx_akses, $nama_karyawanx, $jbtn, $alamatx, $notlpx, $emailx, $passx, $gajix)
    {
        $status_gajix = "Belum";
        $createAT = date("Y-m-d H:i:s");
        $hak_aksesx = "karyawan";
        if (!isset($error)) {
            $tambahAkses = $this->db->prepare('INSERT INTO akses_login (id_akses, email, pass, hak_akses, create_at) VALUES (?, ?, ?, ?, ?)');
            $tambahAkses->bindParam(1, $idx_akses);
            $tambahAkses->bindParam(2, $emailx);
            $tambahAkses->bindParam(3, $passx);
            $tambahAkses->bindParam(4, $hak_aksesx);
            $tambahAkses->bindParam(5, $createAT);
            $tambahAkses->execute();

            if ($tambahAkses) {
                $data = $this->db->prepare('INSERT INTO karyawan (id_karyawan, id_akses_login, nama_karyawan, jabatan, alamat, no_tlp, email, pass, gaji, status_gaji, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
                $data->bindParam(1, $idx);
                $data->bindParam(2, $idx_akses);
                $data->bindParam(3, $nama_karyawanx);
                $data->bindParam(4, $jbtn);
                $data->bindParam(5, $alamatx);
                $data->bindParam(6, $notlpx);
                $data->bindParam(7, $emailx);
                $data->bindParam(8, $passx);
                $data->bindParam(9, $gajix);
                $data->bindParam(10, $status_gajix);
                $data->bindParam(11, $createAT);

                $data->execute();
                return $data->rowCount();
            } else {
                echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
                exit();
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
            exit();
        }
    }
    //Ubah Karyawan
    public function ubahKaryawan($idx_akses, $nama_karyawanx, $jbtn, $alamatx, $notlpx, $emailx, $gajix, $status_gaji)
    {
        $updateAT = date("Y-m-d H:i:s");
        if (!isset($error)) {
            $ubahData = $this->db->prepare('UPDATE akses_login set email=?, update_at=?  where id_akses=?');
            $ubahData->bindParam(1, $emailx);
            $ubahData->bindParam(2, $updateAT);
            $ubahData->bindParam(3, $idx_akses);
            $ubahData->execute();

            if ($ubahData) {
                $data = $this->db->prepare('UPDATE karyawan set nama_karyawan=?, jabatan=?, alamat=?, no_tlp=?, email=?, gaji=?, status_gaji=?, update_at=? where id_akses_login=?');
                $data->bindParam(1, $nama_karyawanx);
                $data->bindParam(2, $jbtn);
                $data->bindParam(3, $alamatx);
                $data->bindParam(4, $notlpx);
                $data->bindParam(5, $emailx);
                $data->bindParam(6, $gajix);
                $data->bindParam(7, $status_gaji);
                $data->bindParam(8, $updateAT);
                $data->bindParam(9, $idx_akses);

                $data->execute();
                return $data->rowCount();
            } else {
                echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
                exit();
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
            exit();
        }
    }
    //Ubah Password Karyawan
    public function ubahPasswordKaryawan($idx_akses, $passx)
    {
        $updateAT = date("Y-m-d H:i:s");
        if (!isset($error)) {
            $ubahData = $this->db->prepare('UPDATE akses_login set pass=?, update_at=?  where id_akses=?');
            $ubahData->bindParam(1, $passx);
            $ubahData->bindParam(2, $updateAT);
            $ubahData->bindParam(3, $idx_akses);
            $ubahData->execute();

            if ($ubahData) {
                $data = $this->db->prepare('UPDATE karyawan set pass=?, update_at=? where id_akses_login=?');
                $data->bindParam(1, $passx);
                $data->bindParam(2, $updateAT);
                $data->bindParam(3, $idx_akses);

                $data->execute();
                return $data->rowCount();
            } else {
                echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
                exit();
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
            exit();
        }
    }
    //Tambah Pemilik Toko
    public function tambahPemilik($idx, $idx_akses, $nama_pemilikx, $notlpx, $emailx, $passx)
    {
        $createAT = date("Y-m-d H:i:s");
        $hak_aksesx = "pemilik_toko";
        if (!isset($error)) {
            $tambahAkses = $this->db->prepare('INSERT INTO akses_login (id_akses, email, pass, hak_akses, create_at) VALUES (?, ?, ?, ?, ?)');
            $tambahAkses->bindParam(1, $idx_akses);
            $tambahAkses->bindParam(2, $emailx);
            $tambahAkses->bindParam(3, $passx);
            $tambahAkses->bindParam(4, $hak_aksesx);
            $tambahAkses->bindParam(5, $createAT);
            $tambahAkses->execute();

            if ($tambahAkses) {
                $data = $this->db->prepare('INSERT INTO pemilik_toko (id, id_akses_login, nama_pemilik, no_tlp, email, pass, create_at) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $data->bindParam(1, $idx);
                $data->bindParam(2, $idx_akses);
                $data->bindParam(3, $nama_pemilikx);
                $data->bindParam(4, $notlpx);
                $data->bindParam(5, $emailx);
                $data->bindParam(6, $passx);
                $data->bindParam(7, $createAT);

                $data->execute();
                return $data->rowCount();
            } else {
                echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
                exit();
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
            exit();
        }
    }
    //Ubah Pemilik Toko
    public function ubahPemilikToko($idx_akses, $nama_pemilikx, $notlpx, $emailx)
    {
        $updateAT = date("Y-m-d H:i:s");
        if (!isset($error)) {
            $ubahData = $this->db->prepare('UPDATE akses_login set email=?, update_at=?  where id_akses=?');
            $ubahData->bindParam(1, $emailx);
            $ubahData->bindParam(2, $updateAT);
            $ubahData->bindParam(3, $idx_akses);
            $ubahData->execute();

            if ($ubahData) {
                $data = $this->db->prepare('UPDATE pemilik_toko set nama_pemilik=?, no_tlp=?, email=?, update_at=? where id_akses_login=?');
                $data->bindParam(1, $nama_pemilikx);
                $data->bindParam(2, $notlpx);
                $data->bindParam(3, $emailx);
                $data->bindParam(4, $updateAT);
                $data->bindParam(5, $idx_akses);

                $data->execute();
                return $data->rowCount();
            } else {
                echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
                exit();
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
            exit();
        }
    }
    //Ubah Password Karyawan
    public function ubahPasswordPemilikToko($idx_akses, $passx)
    {
        $updateAT = date("Y-m-d H:i:s");
        if (!isset($error)) {
            $ubahData = $this->db->prepare('UPDATE akses_login set pass=?, update_at=?  where id_akses=?');
            $ubahData->bindParam(1, $passx);
            $ubahData->bindParam(2, $updateAT);
            $ubahData->bindParam(3, $idx_akses);
            $ubahData->execute();

            if ($ubahData) {
                $data = $this->db->prepare('UPDATE pemilik_toko set pass=?, update_at=? where id_akses_login=?');
                $data->bindParam(1, $passx);
                $data->bindParam(2, $updateAT);
                $data->bindParam(3, $idx_akses);

                $data->execute();
                return $data->rowCount();
            } else {
                echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
                exit();
            }
        } else {
            echo "<script>alert('Gagal Mengirim Pesan!')</script>" . $error;
            exit();
        }
    }
    public function deleteKaryawan($kd)
    {
        $query = $this->db->prepare("DELETE FROM karyawan where id_akses_login=?");

        $query->bindParam(1, $kd);

        $query->execute();
        if ($query) {
            $query2 = $this->db->prepare("DELETE FROM akses_login where id_akses=?");

            $query2->bindParam(1, $kd);

            $query2->execute();
            return $query2->rowCount();
        }
    }
    // delete pengeluaran
    public function deletePengeluaran($kd)
    {
        $sql = $this->db->prepare("SELECT bukti_foto FROM pengeluaran WHERE id_pengeluaran=?");
        $sql->bindParam(1, $kd);
        $sql->execute();
        $data = $sql->fetch();
        if (is_file("../../assets/bukti/" . $data['bukti_foto']))
            unlink("../../assets/bukti/" . $data['bukti_foto']);
        $query = $this->db->prepare("DELETE FROM pengeluaran where id_pengeluaran=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->rowCount();
    }
    public function deletePelayananDom($kd)
    {
        $query = $this->db->prepare("DELETE FROM dom where id=?");

        $query->bindParam(1, $kd);

        $query->execute();
        return $query->rowCount();
    }
    public function deleteBarang($kd)
    {
        $query = $this->db->prepare("DELETE FROM barang where id_barang=?");

        $query->bindParam(1, $kd);

        $query->execute();
        return $query->rowCount();
    }
    public function get_by_id_karyawan($kd)
    {
        $query = $this->db->prepare("SELECT * FROM karyawan where id_akses_login=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_barang($kd)
    {
        $query = $this->db->prepare("SELECT * FROM barang where id_barang=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_pengeluaran($kd)
    {
        $query = $this->db->prepare("SELECT * FROM pengeluaran where id_pengeluaran=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_pemilik_toko($kd)
    {
        $query = $this->db->prepare("SELECT * FROM pemilik_toko where id_akses_login=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_akses($set_akses)
    {
        $query = $this->db->prepare("SELECT * FROM akses_login where id_akses=?");
        $query->bindParam(1, $set_akses);
        $query->execute();
        return $query->fetch();
    }
    public function get_profile($set_akses)
    {
        $query = $this->db->prepare("SELECT * FROM pemilik_toko where id_akses_login=?");
        $query->bindParam(1, $set_akses);
        $query->execute();
        return $query->fetch();
    }
    public function get_profile2($set_akses)
    {
        $query = $this->db->prepare("SELECT * FROM karyawan where id_akses_login=?");
        $query->bindParam(1, $set_akses);
        $query->execute();
        return $query->fetch();
    }
    public function get_data_pem($kd)
    {
        $query = $this->db->prepare("SELECT * FROM pemilik_toko where id=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_email($user)
    {
        $query = $this->db->prepare("SELECT * FROM akses_login where email=?");
        $query->bindParam(1, $user);
        $query->execute();
        return $query->rowCount();
    }
    public function get_data_kar($kd)
    {
        $query = $this->db->prepare("SELECT * FROM  karyawan where id_karyawan=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_kontak($kd)
    {
        $query = $this->db->prepare("SELECT * FROM kontak where id=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_dom($kd)
    {
        $query = $this->db->prepare("SELECT * FROM dom where id=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_DomH($kd)
    {
        $query = $this->db->prepare("SELECT * FROM domh where id=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_skbpm($kd)
    {
        $query = $this->db->prepare("SELECT * FROM skbpm where id=?");
        $query->bindParam(1, $kd);
        $query->execute();
        return $query->fetch();
    }
    public function get_by_id_account($kd_pengguna)
    {
        $query = $this->db->prepare("SELECT * FROM akses_login where id_akses=?");
        $query->bindParam(1, $kd_pengguna);
        $query->execute();
        return $query->fetch();
    }
    public function updateDataPelayananSku($idx, $id, $nm, $ttl, $tgl_lahir_bf, $jenis_k, $wn, $agama, $pekerjaan, $alamat_domisili, $no_nik, $no_kk, $keperluan, $nu, $au, $nop, $cvtgl)
    {
        $updateAT = date("Y-m-d");
        $queryUpdate = $this->db->prepare('UPDATE sku set nomor_surat=?, nama_lengkap=?, tempat_lahir=?, tgl_lahir=?, jenis_kelamin=?, wargaNegara=?, agama=?, pekerjaan=?, alamat=?, no_nik_ktp=?, no_kk=?, keperluan=?, nama_usaha=?, alamat_usaha=?, no_surat_pengantar_RT=?, tgl=?, update_at=?  where id=?');
        $queryUpdate->bindParam(1, $id);
        $queryUpdate->bindParam(2, $nm);
        $queryUpdate->bindParam(3, $ttl);
        $queryUpdate->bindParam(4, $tgl_lahir_bf);
        $queryUpdate->bindParam(5, $jenis_k);
        $queryUpdate->bindParam(6, $wn);
        $queryUpdate->bindParam(7, $agama);
        $queryUpdate->bindParam(8, $pekerjaan);
        $queryUpdate->bindParam(9, $alamat_domisili);
        $queryUpdate->bindParam(10, $no_nik);
        $queryUpdate->bindParam(11, $no_kk);
        $queryUpdate->bindParam(12, $keperluan);
        $queryUpdate->bindParam(13, $nu);
        $queryUpdate->bindParam(14, $au);
        $queryUpdate->bindParam(15, $nop);
        $queryUpdate->bindParam(16, $cvtgl);
        $queryUpdate->bindParam(17, $updateAT);
        $queryUpdate->bindParam(18, $idx);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function perbaharuiKontak($idx, $almtx, $kontak1, $kontak2, $kontak3, $emailx)
    {
        $queryUpdate = $this->db->prepare('UPDATE kontak set alamat=?, whatsapp=?, telephone=?, faks=?, email=?  where id=?');
        $queryUpdate->bindParam(1, $almtx);
        $queryUpdate->bindParam(2, $kontak1);
        $queryUpdate->bindParam(3, $kontak2);
        $queryUpdate->bindParam(4, $kontak3);
        $queryUpdate->bindParam(5, $emailx);
        $queryUpdate->bindParam(6, $idx);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function updateDataPelayananDom($idx, $id, $nm, $ttl, $tgl_lahir_bf, $jenis_k, $wn, $agama, $pekerjaan, $alamat_domisili, $no_nik, $no_kk, $keperluan, $nop, $cvtgl)
    {
        $updateAT = date("Y-m-d");
        $queryUpdate = $this->db->prepare('UPDATE dom set nomor_surat=?, nama_lengkap=?, tempat_lahir=?, tgl_lahir=?, jenis_kelamin=?, wargaNegara=?, agama=?, pekerjaan=?, alamat=?, no_nik_ktp=?, no_kk=?, keperluan=?, no_surat_pengantar_RT=?, tgl=?, update_at=?  where id=?');
        $queryUpdate->bindParam(1, $id);
        $queryUpdate->bindParam(2, $nm);
        $queryUpdate->bindParam(3, $ttl);
        $queryUpdate->bindParam(4, $tgl_lahir_bf);
        $queryUpdate->bindParam(5, $jenis_k);
        $queryUpdate->bindParam(6, $wn);
        $queryUpdate->bindParam(7, $agama);
        $queryUpdate->bindParam(8, $pekerjaan);
        $queryUpdate->bindParam(9, $alamat_domisili);
        $queryUpdate->bindParam(10, $no_nik);
        $queryUpdate->bindParam(11, $no_kk);
        $queryUpdate->bindParam(12, $keperluan);
        $queryUpdate->bindParam(13, $nop);
        $queryUpdate->bindParam(14, $cvtgl);
        $queryUpdate->bindParam(15, $updateAT);
        $queryUpdate->bindParam(16, $idx);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function updateDataPelayananDomH($idx, $id, $nm, $ttl, $tgl_lahir_bf, $jenis_k, $wn, $agama, $pekerjaan, $alamat_domisili, $no_nik, $no_kk, $nop, $cvtgl)
    {
        $updateAT = date("Y-m-d");
        $queryUpdate = $this->db->prepare('UPDATE dom set nomor_surat=?, nama_lengkap=?, tempat_lahir=?, tgl_lahir=?, jenis_kelamin=?, wargaNegara=?, agama=?, pekerjaan=?, alamat=?, no_nik_ktp=?, no_kk=?, no_surat_pengantar_RT=?, tgl=?, update_at=?  where id=?');
        $queryUpdate->bindParam(1, $id);
        $queryUpdate->bindParam(2, $nm);
        $queryUpdate->bindParam(3, $ttl);
        $queryUpdate->bindParam(4, $tgl_lahir_bf);
        $queryUpdate->bindParam(5, $jenis_k);
        $queryUpdate->bindParam(6, $wn);
        $queryUpdate->bindParam(7, $agama);
        $queryUpdate->bindParam(8, $pekerjaan);
        $queryUpdate->bindParam(9, $alamat_domisili);
        $queryUpdate->bindParam(10, $no_nik);
        $queryUpdate->bindParam(11, $no_kk);
        $queryUpdate->bindParam(12, $nop);
        $queryUpdate->bindParam(13, $cvtgl);
        $queryUpdate->bindParam(14, $updateAT);
        $queryUpdate->bindParam(15, $idx);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function tandaiBaca($kd, $user)
    {
        $sts = 'sudah';
        $updateAT = date("Y-m-d H:i:s");
        $queryUpdate = $this->db->prepare('UPDATE pesan set dibaca_oleh=?, status_baca=?, tanggal_baca=? where id=?');
        $queryUpdate->bindParam(1, $user);
        $queryUpdate->bindParam(2, $sts);
        $queryUpdate->bindParam(3, $updateAT);
        $queryUpdate->bindParam(4, $kd);


        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function updateDataPelayananSKTM($idx, $id, $nm, $ttl, $tgl_lahir_bf, $jenis_k, $wn, $agama, $pekerjaan, $alamat_domisili, $no_nik, $no_kk, $keperluan, $kl, $nop, $nopr, $cvtgl)
    {
        $updateAT = date("Y-m-d");
        $queryUpdate = $this->db->prepare('UPDATE sktm set nomor_surat=?, nama_lengkap=?, tempat_lahir=?, tgl_lahir=?, jenis_kelamin=?, wargaNegara=?, agama=?, pekerjaan=?, alamat=?, no_nik_ktp=?, no_kk=?, keperluan=?, tambah_keluhan=?, no_surat_pengantar_RT=?, no_surat_rw=?,  tgl=?, update_at=?  where id=?');
        $queryUpdate->bindParam(1, $id);
        $queryUpdate->bindParam(2, $nm);
        $queryUpdate->bindParam(3, $ttl);
        $queryUpdate->bindParam(4, $tgl_lahir_bf);
        $queryUpdate->bindParam(5, $jenis_k);
        $queryUpdate->bindParam(6, $wn);
        $queryUpdate->bindParam(7, $agama);
        $queryUpdate->bindParam(8, $pekerjaan);
        $queryUpdate->bindParam(9, $alamat_domisili);
        $queryUpdate->bindParam(10, $no_nik);
        $queryUpdate->bindParam(11, $no_kk);
        $queryUpdate->bindParam(12, $keperluan);
        $queryUpdate->bindParam(13, $kl);
        $queryUpdate->bindParam(14, $nop);
        $queryUpdate->bindParam(15, $nopr);
        $queryUpdate->bindParam(16, $cvtgl);
        $queryUpdate->bindParam(17, $updateAT);
        $queryUpdate->bindParam(18, $idx);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function updateDataPelayananSKBPM($idx, $id, $nm, $ttl, $tgl_lahir_bf, $jenis_k, $wn, $agama, $pekerjaan, $alamat_domisili, $no_nik, $no_kk, $keperluan, $nop, $nopr, $cvtgl)
    {
        $updateAT = date("Y-m-d");
        $queryUpdate = $this->db->prepare('UPDATE skbpm set nomor_surat=?, nama_lengkap=?, tempat_lahir=?, tgl_lahir=?, jenis_kelamin=?, wargaNegara=?, agama=?, pekerjaan=?, alamat=?, no_nik_ktp=?, no_kk=?, keperluan=?, no_surat_pengantar_RT=?, surat_rw=?,  tgl=?, update_at=?  where id=?');
        $queryUpdate->bindParam(1, $id);
        $queryUpdate->bindParam(2, $nm);
        $queryUpdate->bindParam(3, $ttl);
        $queryUpdate->bindParam(4, $tgl_lahir_bf);
        $queryUpdate->bindParam(5, $jenis_k);
        $queryUpdate->bindParam(6, $wn);
        $queryUpdate->bindParam(7, $agama);
        $queryUpdate->bindParam(8, $pekerjaan);
        $queryUpdate->bindParam(9, $alamat_domisili);
        $queryUpdate->bindParam(10, $no_nik);
        $queryUpdate->bindParam(11, $no_kk);
        $queryUpdate->bindParam(12, $keperluan);
        $queryUpdate->bindParam(13, $nop);
        $queryUpdate->bindParam(14, $nopr);
        $queryUpdate->bindParam(15, $cvtgl);
        $queryUpdate->bindParam(16, $updateAT);
        $queryUpdate->bindParam(17, $idx);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function updatePengguna($id, $nama, $jk, $np, $aks)
    {
        $updateAT = date("Y-m-d");
        $queryUpdate = $this->db->prepare('UPDATE akses_login set nama=?, jenis_kelamin=?, nohp=?, akses=?, update_at=?  where id_akses=?');

        $queryUpdate->bindParam(1, $nama);
        $queryUpdate->bindParam(2, $jk);
        $queryUpdate->bindParam(3, $np);
        $queryUpdate->bindParam(4, $aks);
        $queryUpdate->bindParam(5, $updateAT);
        $queryUpdate->bindParam(6, $id);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
    public function updatePasswordPengguna($id, $pass)
    {
        $updateAT = date("Y-m-d");
        $queryUpdate = $this->db->prepare('UPDATE akses_login set pass=?, update_at=?  where id_akses=?');

        $queryUpdate->bindParam(1, $pass);
        $queryUpdate->bindParam(2, $updateAT);
        $queryUpdate->bindParam(3, $id);

        $queryUpdate->execute();
        return $queryUpdate->rowCount();
    }
}
