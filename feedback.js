function feedback(what, id) {
  if (!isEmpty(what) && !isEmpty(id)) {
    switch (what) {
      case 'msg':
        var msgs = [];
        switch (id) {
          /* Login feedback */
          case 'LOGPROC200':
            msgs = {title: "Sedang memproses", text: "Mohon tunggu, sedang masuk ke dalam sistem."};
          break;
          case 'LOGFAIL500':
            msgs = {title: "Gagal masuk ke dalam sistem", text: "Akun tidak ditemukan, silahkan hubungi panitia apabila ada kesalahan."};
          break;
          case 'LOGFAIL404':
            msgs = {title: "Gagal masuk ke dalam sistem", text: "Email dan kata sandi yang dimasukan salah."};
          break;
          case 'LOGFAIL403':
            msgs = {title: "Gagal masuk ke dalam sistem", text: "Akun belum diaktifkan, silahkan periksa email untuk mendapatkan kode pengaktifan akun."};
          break;
          case 'LOGFAIL402':
            msgs = {title: "Gagal masuk ke dalam sistem", text: "Akun telah dihapus atau diblokir, silahkan hubungi panitia apabila terjadi kesalahan."};
          break;
          case 'LOGFATL500':
            msgs = {title: "Terjadi kesalahan", text: "Gagal masuk ke dalam sistem."};
          break;
          case 'LOGINCR300':
            msgs = {title: "Akun tidak ditemukan", text: "Silahkan masukkan alamat email dan kata sandi dengan benar."};
          break;
          /* End of Login feedback */

          /* Activation feedback */
          case 'ATVDONE200':
            msgs = {title: "Akun berhasil diaktifkan", text: "Silahkan masuk untuk melanjutkan proses pendaftaran."};
          break;
          case 'ATVDONE201':
            msgs = {title: "Akun sudah diaktifkan", text: "Silahkan masuk untuk melanjutkan proses pendaftaran."};
          break;
          case 'ATVFAIL404':
            msgs = {title: "Akun belum terdaftar", text: "Email yang dimasukan belum terdaftar."};
          break;
          case 'ATVFAIL405':
            msgs = {title: "Kode pengaktifan salah", text: "Silahkan periksa email untuk mendapatkan kode pengaktifan, periksa juga pada kotak spam."};
          break;
          case 'ATVINCR404':
            msgs = {title: "Kode pengaktifan salah", text: "Silahkan masukkan kode pengaktifan dengan benar."};
          break;

          case 'RTVDONE200':
            msgs = {title: "Kode pengaktifan berhasil dikirim", text: "Silahkan periksa alamat email: "};
          break;
          case 'RCWAIT300':
            msgs = {title: "Fitur lupa kata sandi dinonaktifkan", text: "Silahkan hubungi panitia apabila terjadi kendala."};
          break;
          /* End of Activation feedback */

          /* Register feedback */
          case 'REGFAIL501':
            msgs = {title: "Gagal mendaftar", text: "Alamat email sudah digunakan, silahkan gunakan alamat email lain untuk mendaftar."};
          break;
          case 'REGFAIL502':
            msgs = {title: "Berhasil mendaftar", text: "Gagal mengirim kode pangaktifan akun, silahkan kirim ulang kode pengaktifan."};
          break;
          case 'REGFAIL503':
            msgs = {title: "Gagal mendaftar", text: "Silahkan verifikasi kode keamanan dengan benar."};
          break;
          case 'REGINC400':
            msgs = {title: "Gagal mendaftar", text: "Kata sandi yang dimasukkan tidak sesuai dengan konfirmasi kata sandi."};
          break;
          case 'REGDONE200':
            msgs = {title: "Berhasil mendaftar", text: "Silahkan periksa email untuk melakukan pengaktifan akun."};
          break;
          /* End of Register feedback */

          /* Change account feedback */
          case 'CHGCNFR300':
            msgs = {title: "Ubah pengaturan akun?", text: "Ubah pengaturan akun?"};
          break;
          case 'CHGDONE200':
            msgs = {title: "Berhasil mengubah akun", text: "Pengaturan akun berhasil diubah."};
          break;
          case 'CHGINCR404':
            msgs = {title: "Gagal mengubah akun", text: "Kata sandi lama yang dimasukkan salah."};
          break;
          case 'CHGFAIL402':
            msgs = {title: "Gagal mengubah akun", text: "Kata sandi lama yang dimasukkan salah."};
          break;
          /* End of Change account feedback */

          /* Participant Confirmation */
          case 'PARCNFR300':
            msgs = {title: "Konfirmasi pembayaran?", text: "Konfirmasi pembayaran peserta?"};
          break;
          case 'PARCNFRALL':
            msgs = {title: "Konfirmasi semua pembayaran?", text: "Konfirmasi semua pembayaran peserta?"};
          break;
          case 'PARDONE200':
            msgs = {title: "Berhasil mengajukan konfirmasi", text: "Berhasil mengajukan konfirmasi, silahkan hubungi panitia untuk memproses pembayaran lebih cepat."};
          break;
          /* End of Participant Confirmation*/

          /* Basic UI Handler */
          case 'FATL500':
            msgs = {title: "Terjadi kesalahan", text: "Silahkan hubungi panitia apabila terjadi kesalahan."};
          break;
          case 'INCR404':
            msgs = {title: "Terjadi kesalahan", text: "Silahkan masukkan data pada bidang isian dengan benar."};
          break;
          case 'OUT300':
            msgs = {title: "Keluar dari sistem?", text: "Keluar dari sistem?"};
          break;
          case 'PROC200':
            msgs = {title: "Sedang memproses", text: "Mohon tunggu beberapa saat."};
          break;
          case 'CNFR200':
            msgs = {title: "Tambah data?", text: "Pastikan data yang akan dimasukkan sudah sahih."};
          break;
          case 'DELT200':
            msgs = {title: "Hapus data?", text: "Harap periksa kembali data yang akan dihapus."};
          break;
          case 'CHNG200':
            msgs = {title: "Ubah data?", text: "Pastikan data yang akan diubah sahih."};
          break;
          case 'DONE200':
            msgs = {title: "Proses berhasil dilakukan", text: "Proses selesai dilakukan."};
          break;
          case 'FAIL500':
            msgs = {title: "Gagal mengeksekusi perintah", text: "Silahkan hubungi panitia apabila terjadi kendala."};
          break;
          case 'FIND300':
            msgs = {title: "Cari data?", text: "Pastikan kata kunci pencarian benar."};
          break;
          case 'HACK200':
            msgs = {title: "Oops.. Terjadi sesuatu", text: "Oops.. Terjadi sesuatu?"};
          break;
          case 'PAYT200':
            msgs = {title: "Rekening Bank", text: "<b>Bank:</b> <br />BCA KCP. Sumber Sari - Bandung <br /> <b>Atas Nama:</b> <br />Rizky Dwikurnia Wanditra, qq Lucky Cahya Wanditra <br /><b>Nomor Rekening:</b> <br />"};
          break;
          case 'CPBK200':
            msgs = {title: "Nomor rekening disalin", text: "Berhasil menyalin nomor rekening: "};
          break;
          case 'CAPT300':
            msgs = {title: "Verifikasi captcha", text: "Silahkan verifikasi captcha terlebih dahulu."};
          break;
          case 'CAPT500':
            msgs = {title: "Gagal verifikasi captcha", text: "Gagal melakukan verifikasi captcha, silahkan coba kembali."};
          break;
          case 'END200':
            msgs = {title: "Oops, kamu melewatkan sesuatu.", text: "Periode pendaftaran telah berakhir, sampai jumpa di DISPENKASI 30 [^_^]"};
          break;
          /* End of Basic UI Handler */

          default: break;
        }
        res = msgs;
      break;
      default:
    }
  }
  return res;
}
