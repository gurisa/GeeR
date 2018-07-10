/* DISPENKASI */

function get_ready() {
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-red',
    radioClass: 'iradio_square-red'
    //increaseArea: '100%'
  });

  $('input[name="iCheck"]').on('ifClicked', function (event) {
    if (this.value == "P") {
      $("#label-kelas").show();
      $("#kelas-peserta").show();
      $("#label-talent").show();
      $("#talent-peserta").show();
    }
    else if (this.value == "I") {
      $("#label-kelas").hide();
      $("#kelas-peserta").hide();
      $("#label-talent").hide();
      $("#talent-peserta").hide();
    }
    else {
      //avoid injection
    }
  });

  $("#tanggal-lahir-peserta").datepicker({
    changeMonth: true,
    changeYear: true,
    constrainInput: true,
    dateFormat: "yy-mm-dd",
    maxDate: "-12y",
    minDate: "-70y",
    dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"]
  });

  email_pengurus = document.getElementById("pengurus-nama-organisasi");
  if (email_pengurus) {
    if (!isEmpty(email_pengurus.value)) {
      show_participant(email_pengurus.value);
    }
  }

  var form_transaksi_dispenkasi = document.getElementById("transaksi-dispenkasi");
  var detail_transaksi = document.getElementById("detail-transaksi");
  var detail_items = document.getElementById("detail-items");
  var total_transaksi = document.getElementById("total-transaksi");
  var biaya_lain = document.getElementById("biaya-lain");

  $("#biaya-lain").prop('disabled', true);

  $('#transaksi-lain').on('ifChecked', function(event){
    $("#biaya-lain").prop('disabled', false);
    biaya_lain.focus();
  });
  $('#transaksi-lain').on('ifUnchecked', function(event){
    $("#biaya-lain").prop('disabled', true);
  });

  if (biaya_lain) {
    document.querySelector('#biaya-lain').addEventListener('change', function(e) {
      e.preventDefault();
      if (isNaN(biaya_lain.value) || isEmpty(biaya_lain.value)) {
        biaya_lain.value = 0;
        $('#biaya-lain').iCheck('check');
      }
    });
  }
}

function get_all_regions() {
  var xhttp = define_xhttp();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        if (xhttp.responseText == "500") {

        }
        else {
          return xhttp.responseText;
        }
      }
    }
  };
  xhttp.open("POST", home_page + "handler.php?k=REGS", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var regions = "id=regions";
  xhttp.send(regions);
}

function get_all_coordinators() {
  var xhttp = define_xhttp();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        if (xhttp.responseText == "500") {

        }
        else {
          return xhttp.responseText;
        }
      }
    }
  };
  xhttp.open("POST", home_page + "handler.php?k=CRDS", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var coordinators = "id=coordinators";
  xhttp.send(coordinators);
}

function get_user_trx_headers() {
  var xhttp = define_xhttp();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        if (xhttp.responseText == "500") {

        }
        else {
          return xhttp.responseText;
        }
      }
    }
  };
  xhttp.open("POST", home_page + "handler.php?k=TRXH", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  var trx_id = "id=trx_id";
  xhttp.send(trx_id);
}

$(document).ready(function(){
  get_ready();
  $.fn.select2.defaults.set("theme", "bootstrap");
  $.fn.select2.defaults.set("amdBase", "select2/");
  $.fn.select2.defaults.set("amdLanguageBase", "select2/i18n/");

  $("#link-ulang-aktivasi").hide();
  $("#aktivasi-dispenkasi").hide();
  $("#kolom-kode-aktivasi").hide();

  $("#daftar-asal").select2();
  var regions = get_all_regions();
  var coordinators = get_all_coordinators();
  var trx_id = get_user_trx_headers();
  $("#daftar-asal").select2({
    language: "id",
    data: regions,
    placeholder: "Pilih Organisasi Asal",
    allowClear: false
  });

  var pengaturan_asal_pengguna = document.getElementById('pengaturan-asal');
  if (pengaturan_asal_pengguna) {
    $("#pengaturan-asal").select2({
      language: "id",
      data: regions,
      placeholder: "Pilih Organisasi Asal",
      allowClear: false
    });
  }

  var asal_peserta = document.getElementById('asal-peserta');
  if (asal_peserta) {
    $("#asal-peserta").select2({
      language: "id",
      data: regions,
      placeholder: "Pilih Organisasi Asal",
      allowClear: false
    });
  }

  var email_koordinator = document.getElementById('email-koordinator');
  if (email_koordinator) {
    $("#email-koordinator").select2({
      language: "id",
      data: coordinators,
      placeholder: "Pilih Kordinator",
      allowClear: false
    });
  }

  var cari_id_transaksi = document.getElementById('cari-id-transaksi');
  if (cari_id_transaksi) {
    $("#cari-id-transaksi").select2({
      language: "id",
      data: trx_id,
      placeholder: "Pilih ID Transaksi",
      allowClear: false
    });
  }

  var buka_panduan = document.getElementById('buka-panduan');
  var panduan_pendaftaran = document.getElementById('tutorial-panduan-pendaftaran');
  if (buka_panduan && panduan_pendaftaran) {
    document.querySelector('#buka-panduan').addEventListener('click', function(e) {
      e.preventDefault();
      var data = '<iframe src="https://docs.google.com/viewer?srcid=0B6XWD9ziGfx7RGwxdWV4M08wTEU&pid=explorer&efh=false&a=v&chrome=false&embedded=true" width="100%" height="480px"></iframe>';
      panduan_pendaftaran.innerHTML = data;
    });
  }

  new Clipboard("#rekening-bank");//declaration of cliboard.js use

  var konten_pengumuman = document.getElementById('konten-pengumuman');
  if (konten_pengumuman) {
    CKEDITOR.replace('konten-pengumuman', {
      language: 'id',
      height: 200,
      enterMode: CKEDITOR.ENTER_BR
    });
  }
});

function get_radio_value(form, name) {
  var val;
  var radios = form.elements[name];
  for (var i=0, len=radios.length; i<len; i++) {
    if (radios[i].checked) {
      val = radios[i].value;
      break;
    }
  }
  return val;
}

function show_galeri(title, video, subtitle) {
  var target_galeri = document.getElementById('target-galeri');
  var data = '<div class="row"><div class="col-md-12"><p style="text-align:center; padding:5px; font-weight:bold; font-size:12pt;">' + title + '</p>';
  data += '</div></div><div class="row">';
  data += '<video width="100%" height="100%" controls>';
  data += '<source src="' + video + '" type="video/mp4">';
  data += '<track src="' + subtitle + '" kind="subtitles" srclang="id" label="Bahasa Indonesia" />';
  data += 'Tidak dapat menampilkan video, <a href="' + video + '">download video</a>.</video>';
  data += '</div>';
  target_galeri.innerHTML = data;
}

var rekening_bank = document.getElementById('rekening-bank');
if (rekening_bank) {
  document.querySelector('#rekening-bank').addEventListener('click', function(e) {
    msg = feedback('msg','PAYT200');
    swal({
      title: msg.title,
      text:  msg.text,
      type: "input",
      imageUrl: home_page + "src/img/logo/bca.png",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "Kembali",
      confirmButtonText: "Salin",
      animation: "slide-from-top",
      inputPlaceholder: "Nomor rekening..",
      inputValue: "1570070491",
      html:true
    },
    function(inputValue){
      if (inputValue === false) return false;
      if (inputValue === "") {
        inputValue = "1570070491";
      }

      msg = feedback('msg','CPBK200');
      swal({
        title: msg.title,
        text: msg.text + inputValue,
        type: "success",
        confirmButtonColor: "#DD6B55"
      });
    });
  });
}
var konfirmasi_sekarang = document.getElementById('konfirmasi-sekarang');
if (konfirmasi_sekarang) {
  document.querySelector('#konfirmasi-sekarang').addEventListener('click', function(e) {
    e.preventDefault();
    $(document).ready(function(){
      go_to_tab("transaksi");
    });
  });
}

var reg_capt = document.getElementById('g-recaptcha-reg');
if (reg_capt) {
  var recaptcha_render = function() {
    reg_id = grecaptcha.render('g-recaptcha-reg', {
      'sitekey' : '6LeVJiATAAAAAHZhFYHFIwYBrdkSXtruZnEl06r2',
      'data-size' : 'compact',
    });
  };
}

function captcha_validation(who) {
  var result = false;
  if (!isEmpty(who)) {
    switch (who) {
      case 'reg':
        var response = grecaptcha.getResponse(reg_id);
        if (response.length === 0) {
          msg = feedback("msg","CAPT300");
          swal({
            title: msg.title,
            text: msg.text,
            type  : "info",
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK",
            html:true
          });
        }
        else {
          result = true;
        }
      break;
      default:break;
    }
  }
  return result;
}

var daftar_dispenkasi = document.getElementById('daftar-dispenkasi');
if (daftar_dispenkasi) {
document.querySelector('#daftar-dispenkasi').addEventListener('submit', function(e) {
    e.preventDefault();
    var form = this;

    msg = feedback("msg","END200");
    swal({
      title: msg.title,
      text: msg.text,
      type: "warning",
      showConfirmButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: false,
      html:true
    });
    /*
    var nama = document.getElementById("daftar-nama").value;
    var telepon = document.getElementById("daftar-telepon").value;
    var email = document.getElementById("daftar-email").value;
    var asal = document.getElementById("daftar-asal").value;
    var text_asal = $("#daftar-asal :selected").text();
    var password = document.getElementById("daftar-password").value;
    var confirm_password = document.getElementById("daftar-confirm-password").value;
    if (isEmpty(nama) || isEmpty(telepon) || isEmpty(email) || isEmpty(asal) || isEmpty(password) || isEmpty(confirm_password)) {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: false,
        html:true
      });
    }
    else if ((password != confirm_password) || password.length < 6) {
      msg = feedback("msg","REGINC400");
      if (password.length < 6) {
        msg.text = "Kata sandi yang digunakan terlalu singkat, silahkan gunakan kombinasi kata sandi yang lebih baik.";
      }
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: false,
        html:true
      });
    }
    else {
      if (captcha_validation('reg')) {
        var tmp_text = "<div style='padding:0px 10% 0px 10%;'>";
        tmp_text += "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='text-align:left;'>";
        tmp_text += "<tr><td width='30%'>Nama</td><td>" + nama + "</td></tr>";
        tmp_text += "<tr><td>E-mail</td><td>" + email + "</td></tr>";
        tmp_text += "<tr><td>Telepon</td><td>" + telepon + "</td></tr>";
        tmp_text += "<tr><td>Asal</td><td>" + text_asal + "</td></tr></table></div>";

        swal({
          title: "Konfirmasi pendaftaran",
          text: tmp_text,
          type: "info",
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Daftar",
          cancelButtonText: "Kembali",
          closeOnConfirm: false,
          html:true
        },

        function (isConfirm) {
          if (isConfirm) {
            var xhttp = define_xhttp();

            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                  if (xhttp.responseText == "200") {
                    msg = feedback("msg","REGDONE200");
                    swal({
                      title : msg.title,
                      text  : msg.text,
                      type  : "success",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        daftar_dispenkasi.reset();
                        add_class("tombol-daftar","disabled");
                        document.getElementById("tombol-daftar").disabled = true;
                        document.getElementById("masuk-email").focus();
                        go_to_tab("masuk");
                        $("#masuk-dispenkasi").hide();
                        $("#aktivasi-dispenkasi").show();
                      }
                    });
                  }
                  else if (xhttp.responseText == "503") {
                    msg = feedback("msg","REGFAIL503");
                    swal({
                      title : msg.title,
                      text  : msg.text,
                      type  : "warning",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    });
                  }
                  else if (xhttp.responseText == "502") {
                    msg = feedback("msg","REGFAIL502");
                    swal({
                      title : msg.title,
                      text  : msg.text,
                      type  : "error",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    });
                  }
                  else if (xhttp.responseText == "501") {
                    msg = feedback("msg","REGFAIL501");
                    swal({
                      title : msg.title,
                      text  : msg.text,
                      type  : "error",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    });
                  }
                  else if (xhttp.responseText == "500") {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type  : "error",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    });
                  }
                  else {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type  : "error",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    });
                  }
                }
                else {
                  msg = feedback("msg","PROC200");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "warning",
                    showConfirmButton: false,
                    showLoaderOnConfirm: true,
                    html:true
                  });
                }
              }
            };
            xhttp.open("POST", home_page + "handler.php?k=REG",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhttp.send("nama=" + nama + "&email=" + email + "&asal=" + asal + "&telepon=" + telepon + "&password=" + password);
          }
        });

      }
      else {
        msg = feedback("msg","CAPT300");
        swal({
          title: msg.title,
          text: msg.text,
          type  : "info",
          showCancelButton: false,
          showConfirmButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          html:true
        });
      }//end of captcha valid

    }
    */
});
}

var link_masuk = document.getElementById('link-masuk');
if (link_masuk) {
  document.querySelector('#link-masuk').addEventListener('click', function(e) {
    e.preventDefault();
    $("#aktivasi-dispenkasi").hide();
    $("#masuk-dispenkasi").show("bounce", { direction: "right" }, "1000");

    document.getElementById('aktivasi-email').value = "";
    konfirmasi_aktivasi.value = "Lanjutkan";
    $("#aktivasi-email").prop('disabled', false);
    $("#link-ulang-aktivasi").hide();
    $("#kolom-kode-aktivasi").hide();
  });
}

var link_aktivasi = document.getElementById('link-aktivasi');
if (link_aktivasi) {
  document.querySelector('#link-aktivasi').addEventListener('click', function(e) {
    e.preventDefault();
    $("#masuk-dispenkasi").hide();
    $("#aktivasi-dispenkasi").show("blind", { direction: "horizontal" }, "1000");
  });
}

var link_lupa_password = document.getElementById('link-lupa-password');
if (link_lupa_password) {
  document.querySelector('#link-lupa-password').addEventListener('click', function(e) {
    e.preventDefault();
    msg = feedback("msg","RCWAIT300");
    swal({
      title: msg.title,
      text: msg.text,
      type: "info",
      showConfirmButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: false,
      html:true
    });
  });
}

var link_ulang_aktivasi = document.getElementById('link-ulang-aktivasi');
if (link_ulang_aktivasi) {
  document.querySelector('#link-ulang-aktivasi').addEventListener('click', function(e) {
    e.preventDefault();
    var aktivasi_email = document.getElementById('aktivasi-email');
    if (aktivasi_email && !isEmpty(aktivasi_email.value)) {
      var xhttp = define_xhttp();
      xhttp.onreadystatechange = function() {
        var result = false;
        if (this.readyState == 4 && this.status == 200) {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText == "200") {
              msg = feedback("msg","RTVDONE200");
              swal({
                title: msg.title,
                text: msg.text + aktivasi_email.value,
                type: "success",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
            else if (xhttp.responseText == "201") {
              msg = feedback("msg","ATVDONE201");
              swal({
                title: msg.title,
                text: msg.text,
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
            else if (xhttp.responseText == "404") {
              msg = feedback("msg","ATVFAIL404");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
            else {
              msg = feedback("msg","FATL500");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
          }
        }
      };

      xhttp.open("POST", home_page + "handler.php?k=REA",true);
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhttp.send("email=" + aktivasi_email.value);
    }
    else {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }
  });
}

var konfirmasi_aktivasi = document.getElementById('konfirmasi-aktivasi');
if (konfirmasi_aktivasi) {
  document.querySelector('#konfirmasi-aktivasi').addEventListener('click', function(e) {
    e.preventDefault();
    var aktivasi_email = document.getElementById('aktivasi-email');
    var aktivasi_kode = document.getElementById('aktivasi-kode');
    if (aktivasi_email && !isEmpty(aktivasi_email.value)) {
      var xhttp = define_xhttp();
      if (konfirmasi_aktivasi.value == "Lanjutkan") {
        xhttp.onreadystatechange = function() {
          var result = false;
          if (this.readyState == 4 && this.status == 200) {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              if (xhttp.responseText == "200") {
                konfirmasi_aktivasi.value = "Aktivasi";
                $("#aktivasi-email").prop('disabled', true);
                $("#link-ulang-aktivasi").show();
                $("#kolom-kode-aktivasi").show();
              }
              else if (xhttp.responseText == "201") {
                msg = feedback("msg","ATVDONE201");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "warning",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: true,
                  html:true
                });
              }
              else if (xhttp.responseText == "404") {
                msg = feedback("msg","ATVFAIL404");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: true,
                  html:true
                });
              }
              else {
                msg = feedback("msg","FATL500");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: true,
                  html:true
                });
              }
            }
          }
        };

        xhttp.open("POST", home_page + "handler.php?k=EXS",true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("email=" + aktivasi_email.value);
      }
      else if (konfirmasi_aktivasi.value == "Aktivasi") {
        if (aktivasi_kode && !isEmpty(aktivasi_kode.value)) {
          xhttp.onreadystatechange = function() {
            var result = false;
            if (this.readyState == 4 && this.status == 200) {
              if (xhttp.readyState == 4 && xhttp.status == 200) {
                if (xhttp.responseText == "200") {
                  msg = feedback("msg","ATVDONE200");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  },
                  function (isConfirm) {
                    if (isConfirm) {
                      konfirmasi_aktivasi.value = "Lanjutkan";
                      $("#aktivasi-email").prop('disabled', false);
                      $("#link-ulang-aktivasi").hide();
                      $("#kolom-kode-aktivasi").hide();
                      $("#aktivasi-dispenkasi").hide();
                      $("#masuk-dispenkasi").show();
                      document.getElementById('aktivasi-email').value = "";
                      document.getElementById('masuk-email').value = "";
                      document.getElementById('masuk-password').value = "";
                    }
                  });
                }
                else if (xhttp.responseText == "201") {
                  msg = feedback("msg","ATVDONE201");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
                else if (xhttp.responseText == "404") {
                  msg = feedback("msg","ATVDONE405");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
                else {
                  msg = feedback("msg","FATL500");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
              }
            }
          };

          xhttp.open("POST", home_page + "handler.php?k=ACT",true);
          xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xhttp.send("email=" + aktivasi_email.value + "&code=" + aktivasi_kode.value);
        }
        else {
          msg = feedback("msg","ATVINCR404");
          swal({
            title: msg.title,
            text: msg.text,
            type: "warning",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK",
            closeOnConfirm: true,
            html:true
          });
        }
      }
      else {
        msg = feedback("msg","FATL500");
        swal({
          title: msg.title,
          text: msg.text,
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          closeOnConfirm: true,
          html:true
        });
      }
    }
    else {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }
  });
}

var masuk_dispenkasi = document.getElementById('masuk-dispenkasi');
if (masuk_dispenkasi) {
  document.querySelector('#masuk-dispenkasi').addEventListener('submit', function(e) {
    var email = document.getElementById("masuk-email").value;
    var password = document.getElementById("masuk-password").value;
    var form = this;
    e.preventDefault();

    if (isEmpty(email) || isEmpty(password)) {
      msg = feedback("msg","LOGINCR300");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: false,
        html:true
      });
    }
    else {
      var xhttp = define_xhttp();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            msg = feedback("msg","LOGPROC200");
            swal({
              title: msg.title,
              text: msg.text,
              type: "warning",
              showConfirmButton: false,
              showLoaderOnConfirm: true,
              timer: 1000,
              html:true
            },
            function () {
              setTimeout(function(){
                if (xhttp.responseText == "404") {
                  msg = feedback("msg","LOGFAIL404");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
                else if (xhttp.responseText == "402") {
                  msg = feedback("msg","LOGFAIL402");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
                else if (xhttp.responseText == "403") {
                  msg = feedback("msg","LOGFAIL403");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  },
                  function (isConfirm) {
                    if (isConfirm) {
                      konfirmasi_aktivasi.value = "Lanjutkan";
                      $("#aktivasi-email").prop('disabled', false);
                      $("#link-ulang-aktivasi").hide();
                      $("#kolom-kode-aktivasi").hide();
                      $("#aktivasi-dispenkasi").hide();
                      $("#masuk-dispenkasi").show();
                      document.getElementById('aktivasi-email').value = "";
                      document.getElementById('masuk-email').value = "";
                      document.getElementById('masuk-password').value = "";
                    }
                  });
                }
                else if (xhttp.responseText == "500") {
                  msg = feedback("msg","LOGFAIL500");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
                else if (xhttp.responseText == "200") {
                  redirect(home_page + "dispenkasi/#masuk");
                }
              }, 1000);
            });
          }
          else {
            msg = feedback("msg","LOGPROC200");
            swal({
              title: msg.title,
              text: msg.text,
              type: "warning",
              showConfirmButton: false,
              showLoaderOnConfirm: true,
              timer: 1000,
              html:true
            },
            function () {
              setTimeout(function(){
                msg = feedback("msg","LOGFATL500");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "info",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: true,
                  html:true
                });
              }, 1000);
            });
          }
        }
      };

      xhttp.open("POST", home_page + "handler.php?k=ENT",true);
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhttp.send("email=" + email + "&password=" + password);

    }
  });
}

var keluar_dispenkasi = document.getElementById('keluar-dispenkasi');
if (keluar_dispenkasi) {
  document.querySelector('#keluar-dispenkasi').addEventListener('click', function(e) {
      var form = this;
      e.preventDefault();
      msg = feedback("msg","OUT300");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Keluar",
        cancelButtonText: "Kembali",
        closeOnConfirm: false,
        html:true
      },
      function (isConfirm) {
        if (isConfirm) {
          var xhttp = define_xhttp();

          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (xhttp.readyState == 4 && xhttp.status == 200) {
                msg = feedback("msg","PROC200");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "warning",
                  showConfirmButton: false,
                  showLoaderOnConfirm: true,
                  timer: 1000,
                  html:true
                },

                function () {
                  setTimeout(function(){
                    if (xhttp.responseText == "200") {
                      redirect(home_page + "dispenkasi/");
                    }
                    else {
                      msg = feedback("msg","FATL500");
                      swal({
                        title: msg.title,
                        text: msg.text,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                        html:true
                      });
                    }
                  }, 1000);
                });
              }
              else {
                msg = feedback("msg","FATL500");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: true,
                  html:true
                });
              }
            }
          };
          xhttp.open("POST", home_page + "handler.php?k=OUT",true);
          xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xhttp.send();

        }
      });//endfunction
  });
}

function ubah_pengaturan(password) {
  var nama = document.getElementById("pengaturan-nama").value;
  var telepon = document.getElementById("pengaturan-telepon").value;
  var email = document.getElementById("pengaturan-email").value;
  var old_password = document.getElementById("pengaturan-old-password").value;
  var new_password = document.getElementById("pengaturan-new-password").value;
  var confirm_password = document.getElementById("pengaturan-confirm-new-password").value;

  if (!isEmpty(password)) {
    msg = feedback("msg","CHGCNFR300");
    swal({
      title: msg.title,
      text: msg.text,
      type: "info",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ubah",
      cancelButtonText: "Kembali",
      closeOnConfirm: false,
      html:true
    },

    function (isConfirm) {
      if (isConfirm) {
        var xhttp = define_xhttp();

        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              msg = feedback("msg","PROC200");
              swal({
                title: msg.title,
                text: msg.text,
                type: "warning",
                showConfirmButton: false,
                showLoaderOnConfirm: true,
                timer: 1000,
                html:true
              },

              function () {
                setTimeout(function(){
                  if (xhttp.responseText == "200") {
                    msg = feedback("msg","CHGDONE200");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type  : "success",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#pengaturan");
                      }
                    });
                  }
                  else if (xhttp.responseText == "404") {
                    document.getElementById("pengaturan-old-password").focus();
                    msg = feedback("msg","CHGINCR404");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    });
                  }
                  else if (xhttp.responseText == "500") {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    });
                  }
                  else {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    });
                  }
                }, 1000);
              });
            }
            else {
              msg = feedback("msg","FATL500");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
          }
        };

        var query_string = ("nama=" + nama + "&email=" + email + "&telepon=" + telepon + "&old_password=" + old_password);
        xhttp.open("POST", home_page + "handler.php?k=CFG",true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        if (password == 'Y') {
          query_string = ("nama=" + nama + "&email=" + email + "&telepon=" + telepon + "&old_password=" + old_password + "&new_password=" + new_password + "&confirm_password=" + confirm_password);
        }
        xhttp.send(query_string);
      }//endif
    });//endfunction
  }
}

var pengaturan_dispenkasi = document.getElementById('pengaturan-dispenkasi');
if (pengaturan_dispenkasi) {
  document.querySelector('#pengaturan-dispenkasi').addEventListener('submit', function(e) {
    var nama = document.getElementById("pengaturan-nama").value;
    var telepon = document.getElementById("pengaturan-telepon").value;
    var email = document.getElementById("pengaturan-email").value;
    var old_password = document.getElementById("pengaturan-old-password").value;
    var new_password = document.getElementById("pengaturan-new-password").value;
    var confirm_password = document.getElementById("pengaturan-confirm-new-password").value;

    var form = this;
    e.preventDefault();

    if (isEmpty(nama) || isEmpty(telepon) || isEmpty(email) || isEmpty(old_password)) {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: false,
        html:true
      });
    }
    else {
      if (!isEmpty(new_password) && !isEmpty(confirm_password)) {
        if ((new_password != confirm_password) || new_password.length < 6) {
          msg = feedback("msg","CHGFAIL402");
          if (new_password.length < 6) {
            msg.text = "Kata sandi baru yang digunakan terlalu singkat, harap gunakan kombinasi kata sandi yang lebih baik.";
          }
          swal({
            title: msg.title,
            text: msg.text,
            type: "info",
            showConfirmButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK",
            closeOnConfirm: false,
            html:true
          });
        }
        else {
          /* update password */
          ubah_pengaturan('Y');
        }
      }
      else {
        /* tanpa update password */
        ubah_pengaturan('T');
      }
    }//endif
  });
}

/* Peserta */

var show_hide_peserta = document.getElementById('show-hide-peserta');
if (show_hide_peserta) {
  var x = 0;
  $(document).ready(function(){
    document.querySelector('#show-hide-peserta').addEventListener('click', function(e) {
      var form = this;
      var informasi_peserta = document.getElementById('informasi-peserta');
      e.preventDefault();
      if (informasi_peserta) {
        if (x % 2 === 0) {
          $("#informasi-peserta").slideUp(1000);
        }
        else if (x % 2 == 1) {
          $("#informasi-peserta").slideDown(1000);
        }
        x++;
      }
    });
  });
}

var daftar_peserta = document.getElementById('daftar-peserta');
if (daftar_peserta) {
  document.querySelector('#daftar-peserta').addEventListener('submit', function(e) {
    var form = this;
    e.preventDefault();

    var nama_peserta = document.getElementById('nama-peserta');
    //var jenis_kelamin_peserta = document.getElementById('jenis-kelamin-peserta');
    var tanggal_lahir_peserta = document.getElementById('tanggal-lahir-peserta');
    var asal_peserta = document.getElementById('asal-peserta');

    var email_peserta = document.getElementById('email-peserta');
    var telepon_peserta = document.getElementById('telepon-peserta');
    var facebook_peserta = document.getElementById('facebook-peserta');
    var twitter_peserta = document.getElementById('twitter-peserta');
    var instagram_peserta = document.getElementById('instagram-peserta');
    var line_peserta = document.getElementById('line-peserta');

    var pilihan_talent = document.getElementById('talent-peserta');
    var pilihan_kelas = document.getElementById('kelas-peserta');
    var kelas_peserta = "IP";
    var talent_peserta = "INSPECTOR";

    var jenis_kelamin_peserta = "M";

    if (get_radio_value(document.getElementById('daftar-peserta'), 'jenis-kelamin-peserta') == "M") {
      //jenis_kelamin_peserta = "M";
    }
    else if (get_radio_value(document.getElementById('daftar-peserta'), 'jenis-kelamin-peserta') == "F") {
      jenis_kelamin_peserta = "F";
    }

    if (get_radio_value(document.getElementById('daftar-peserta'), 'iCheck') == "I") {
      //kelas_peserta = "IP";
      //talent_peserta = "INSPECTOR";
    }
    else if (get_radio_value(document.getElementById('daftar-peserta'), 'iCheck') == "P") {
      if (pilihan_kelas.value == "TE") {
        kelas_peserta = "TE";
      }
      else if (pilihan_kelas.value == "AD") {
        kelas_peserta = "AD";
      }
      else {
        //injection
        kelas_peserta = "IP";
      }

      if (pilihan_talent.value == "DANCE") {
        talent_peserta = "DANCE";
      }
      else if (pilihan_talent.value == "SELFDEFENSE") {
        talent_peserta = "SELFDEFENSE";
      }
      else if (pilihan_talent.value == "MUSIC") {
        talent_peserta = "MUSIC";
      }
      else {
        talent_peserta = "INSPECTOR";
      }
    }
    else { //injection

    }

    if (isEmpty(nama_peserta.value) || isEmpty(tanggal_lahir_peserta.value)) {
       if (isEmpty(nama_peserta.value)) {
        nama_peserta.focus();
       }
       else if (isEmpty(tanggal_lahir_peserta.value)) {
        tanggal_lahir_peserta.focus();
       }
       msg = feedback("msg","INCR404");
       swal({
         title: msg.title,
         text: msg.text,
         type: "info",
         showConfirmButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "OK",
         closeOnConfirm: true,
         html:true
       });
    }
    //else if (jenis_kelamin_peserta.value != "M" && jenis_kelamin_peserta.value != "F") {
    else if (jenis_kelamin_peserta != "M" && jenis_kelamin_peserta != "F") {
      msg = feedback("msg","HACK200");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
      redirect(home_page + "dispenkasi/#peserta");
    }
    else if (kelas_peserta != "IP" && kelas_peserta != "TE" && kelas_peserta != "AD") {
      msg = feedback("msg","HACK200");
      swal({
        title: msg.title,
        text: msg.text,
        type: "error",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
      redirect(home_page + "dispenkasi/#peserta");
    }
    /*
    else if () {
      swal({
        title: msg.title,
        text: "Usia > 13 tahun",
        type: "warning",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }
    */
    else {
      msg = feedback("msg","CNFR200");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Tambah",
        cancelButtonText: "Batalkan",
        closeOnConfirm: false,
        html:true
      },

      function (isConfirm) {
        if (isConfirm) {
          var xhttp = define_xhttp();

          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (xhttp.readyState == 4 && xhttp.status == 200) {
                msg = feedback("msg","PROC200");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "warning",
                  showConfirmButton: false,
                  showLoaderOnConfirm: true,
                  timer: 1000,
                  html:true
                },
                function () {
                  setTimeout(function(){
                    if (xhttp.responseText == "200") {
                      msg = feedback("msg","DONE200");
                      swal({
                        title: msg.title,
                        text: msg.text,
                        type  : "success",
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK",
                        html:true
                      },
                      function (isConfirm) {
                        if (isConfirm) {
                          redirect(home_page + "dispenkasi/#peserta");
                        }
                      });
                    }
                    else {
                      msg = feedback("msg","FATL500");
                      swal({
                        title: msg.title,
                        text: msg.text,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                        html:true
                      },
                      function (isConfirm) {
                        if (isConfirm) {
                          redirect(home_page + "dispenkasi/#peserta");
                        }
                      });
                    }
                  }, 1000);
                });
              }
              else {
                msg = feedback("msg","FATL500");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: true,
                  html:true
                });
              }
            }
          };
          var query_string = "email=" + email_peserta.value + "&nama=" + nama_peserta.value +
              "&kelamin=" + jenis_kelamin_peserta + "&tanggal=" +
              tanggal_lahir_peserta.value + "&asal=default&telepon=" +
              telepon_peserta.value + "&facebook=" + facebook_peserta.value + "&twitter=" +
              twitter_peserta.value + "&instagram=" + instagram_peserta.value + "&line=" +
              line_peserta.value + "&kelas=" + kelas_peserta + "&talent=" + talent_peserta;

          if (asal_peserta) {
            query_string = "email=" + email_peserta.value + "&nama=" + nama_peserta.value +
                "&kelamin=" + jenis_kelamin_peserta + "&tanggal=" +
                tanggal_lahir_peserta.value + "&asal=" + asal_peserta.value + "&telepon=" +
                telepon_peserta.value + "&facebook=" + facebook_peserta.value + "&twitter=" +
                twitter_peserta.value + "&instagram=" + instagram_peserta.value + "&line=" +
                line_peserta.value + "&kelas=" + kelas_peserta + "&talent=" + talent_peserta;
          }

          xhttp.open("POST", home_page + "handler.php?k=ADDPAR", true);
          xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xhttp.send(query_string);
        }
      });
    }
  });
}

function hapus_peserta(id) {
  if (!isEmpty(id)) {
    msg = feedback("msg","DELT200");
    swal({
      title: msg.title,
      text: msg.text,
      type: "info",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Hapus",
      cancelButtonText: "Kembali",
      closeOnConfirm: false,
      html:true
    },

    function (isConfirm) {
      if (isConfirm) {
        var xhttp = define_xhttp();

        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              msg = feedback("msg","PROC200");
              swal({
                title: msg.title,
                text: msg.text,
                type: "warning",
                showConfirmButton: false,
                showLoaderOnConfirm: true,
                timer: 1000,
                html:true
              },
              function () {
                setTimeout(function(){
                  if (xhttp.responseText == "200") {
                    msg = feedback("msg","DONE200");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type  : "success",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#pengurus");
                      }
                    });
                  }
                  else {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#pengurus");
                      }
                    });
                  }
                }, 1000);
              });
            }
            else {
              msg = feedback("msg","FATL500");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
          }
        };

        xhttp.open("POST", home_page + "handler.php?k=DELPAR", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("id=" + id);
      }
    });
  }
  else {
    msg = feedback("msg","FATL500");
    swal({
      title: msg.title,
      text: msg.text,
      type: "error",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
  }
}

function ubah_peserta(id) {
  if (!isEmpty(id)) {
    var panel_position = document.getElementById('panel-informasi-peserta');
    if (panel_position) {
      var xhttp = define_xhttp();

      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText == "500") {
              msg = feedback("msg","FATL500");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              },
              function (isConfirm) {
                if (isConfirm) {
                  redirect(home_page + "dispenkasi/");
                }
              });
            }
            else {
              panel_position.innerHTML = xhttp.responseText;
              get_ready();
            }
          }
          else {
            msg = feedback("msg","FATL500");
            swal({
              title: msg.title,
              text: msg.text,
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "OK",
              closeOnConfirm: true,
              html:true
            });
          }
        }
      };

      xhttp.open("POST", home_page + "handler.php?k=CHKPAR", true);
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhttp.send("id=" + id);
    }
  }
  else {
    msg = feedback("msg","FATL500");
    swal({
      title: msg.title,
      text: msg.text,
      type: "error",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
  }
}

function simpan_peserta(id) {
  if (!isEmpty(id)) {
    document.querySelector('#ubah-simpan-peserta').addEventListener('submit', function(e) {
      var form = this;
      e.preventDefault();
      var nama_peserta = document.getElementById('nama-peserta');
      //var jenis_kelamin_peserta = document.getElementById('jenis-kelamin-peserta');
      var tanggal_lahir_peserta = document.getElementById('tanggal-lahir-peserta');
      var email_peserta = document.getElementById('email-peserta');
      var telepon_peserta = document.getElementById('telepon-peserta');
      var facebook_peserta = document.getElementById('facebook-peserta');
      var twitter_peserta = document.getElementById('twitter-peserta');
      var instagram_peserta = document.getElementById('instagram-peserta');
      var line_peserta = document.getElementById('line-peserta');
      var pilihan_kelas = document.getElementById('kelas-peserta');
      var pilihan_talent = document.getElementById('talent-peserta');
      var talent_peserta = "INSPECTOR";
      var kelas_peserta = "IP";

      var jenis_kelamin_peserta = "M";

      if (get_radio_value(document.getElementById('ubah-simpan-peserta'), 'jenis-kelamin-peserta') == "M") {
        //jenis_kelamin_peserta = "M";
      }
      else if (get_radio_value(document.getElementById('ubah-simpan-peserta'), 'jenis-kelamin-peserta') == "F") {
        jenis_kelamin_peserta = "F";
      }

      if (get_radio_value(document.getElementById('ubah-simpan-peserta'), 'iCheck') == "I") {
        //kelas_peserta = "IP";
      }
      else if (get_radio_value(document.getElementById('ubah-simpan-peserta'), 'iCheck') == "P") {
        if (pilihan_kelas.value == "TE") {
          kelas_peserta = "TE";
        }
        else if (pilihan_kelas.value == "AD") {
          kelas_peserta = "AD";
        }
        else { //injection
          kelas_peserta = "IP";
        }

        if (pilihan_talent.value == "DANCE") {
          talent_peserta = "DANCE";
        }
        else if (pilihan_talent.value == "SELFDEFENSE") {
          talent_peserta = "SELFDEFENSE";
        }
        else if (pilihan_talent.value == "MUSIC") {
          talent_peserta = "MUSIC";
        }
        else {
          talent_peserta = "INSPECTOR";
        }
      }
      else { //injection
        //kelas_peserta = "IP";
      }

      if (isEmpty(nama_peserta.value) || isEmpty(tanggal_lahir_peserta.value)) {
         if (isEmpty(nama_peserta.value)) {
          nama_peserta.focus();
         }
         else if (isEmpty(tanggal_lahir_peserta.value)) {
          tanggal_lahir_peserta.focus();
         }
         msg = feedback("msg","INCR404");
         swal({
           title: msg.title,
           text: msg.text,
           type: "info",
           showConfirmButton: true,
           confirmButtonColor: "#DD6B55",
           confirmButtonText: "OK",
           closeOnConfirm: true,
           html:true
         });
      }
      //else if ((jenis_kelamin_peserta.value != "M" && jenis_kelamin_peserta.value != "F") ||
      //(kelas_peserta != "IP" && kelas_peserta != "TE" && kelas_peserta != "AD")) {
      else if ((jenis_kelamin_peserta != "M" && jenis_kelamin_peserta != "F") ||
      (kelas_peserta != "IP" && kelas_peserta != "TE" && kelas_peserta != "AD")) {
        msg = feedback("msg","HACK200");
        swal({
          title: msg.title,
          text: msg.text,
          type: "info",
          showConfirmButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          closeOnConfirm: true,
          html:true
        });
        redirect(home_page + "dispenkasi/");
      }
      else {
        msg = feedback("msg","CHNG200");
        swal({
          title: msg.title,
          text: msg.text,
          type: "info",
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Simpan",
          cancelButtonText: "Batalkan",
          closeOnConfirm: false,
          html:true
        },

        function (isConfirm) {
          if (isConfirm) {
            var xhttp = define_xhttp();

            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                  msg = feedback("msg","PROC200");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "warning",
                    showConfirmButton: false,
                    showLoaderOnConfirm: true,
                    timer: 1000,
                    html:true
                  },
                  function () {
                    setTimeout(function(){
                      if (xhttp.responseText == "200") {
                        msg = feedback("msg","DONE200");
                        swal({
                          title: msg.title,
                          text: msg.text,
                          type  : "success",
                          showCancelButton: false,
                          showConfirmButton: true,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "OK",
                          html:true
                        },
                        function (isConfirm) {
                          if (isConfirm) {
                            redirect(home_page + "dispenkasi/#peserta");
                          }
                        });
                      }
                      else {
                        msg = feedback("msg","FATL500");
                        swal({
                          title: msg.title,
                          text: msg.text,
                          type: "error",
                          showCancelButton: false,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "OK",
                          closeOnConfirm: true,
                          html:true
                        },
                        function (isConfirm) {
                          if (isConfirm) {
                            redirect(home_page + "dispenkasi/#peserta");
                          }
                        });
                      }
                    }, 1000);
                  });
                }
                else {
                  msg = feedback("msg","FATL500");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
              }
            };
            var query_string = "id=" + id + "&email=" + email_peserta.value +
                "&nama=" + nama_peserta.value + "&kelamin=" + jenis_kelamin_peserta +
                "&tanggal=" + tanggal_lahir_peserta.value + "&asal=default&telepon=" +
                telepon_peserta.value + "&facebook=" + facebook_peserta.value + "&twitter=" +
                twitter_peserta.value + "&instagram=" + instagram_peserta.value + "&line=" +
                line_peserta.value + "&kelas=" + kelas_peserta + "&talent=" + talent_peserta;

            xhttp.open("POST", home_page + "handler.php?k=CHGPAR", true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhttp.send(query_string);
          }
        });
      }
    });
  }
  else {
    msg = feedback("msg","FATL500");
    swal({
      title: msg.title,
      text: msg.text,
      type: "error",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
  }
}

function konfirmasi_peserta(id) {
  if (!isEmpty(id)) {
    msg = feedback("msg","PARCNFR300");
    swal({
      title: msg.title,
      text: msg.text,
      type: "info",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Konfirmasi",
      cancelButtonText: "Kembali",
      closeOnConfirm: false,
      html:true
    },

    function (isConfirm) {
      if (isConfirm) {
        var xhttp = define_xhttp();

        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              msg = feedback("msg","PROC200");
              swal({
                title: msg.title,
                text: msg.text,
                type: "warning",
                showConfirmButton: false,
                showLoaderOnConfirm: true,
                timer: 1000,
                html:true
              },
              function () {
                setTimeout(function(){
                  if (xhttp.responseText == "200") {
                    msg = feedback("msg","PARDONE200");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type  : "success",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#peserta");
                      }
                    });
                  }
                  else {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#peserta");
                      }
                    });
                  }
                }, 1000);
              });
            }
            else {
              msg = feedback("msg","FATL500");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
          }
        };

        xhttp.open("POST", home_page + "handler.php?k=MRKPAR", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("id=" + id);
      }
    });
  }
  else {
    msg = feedback("msg","FATL500");
    swal({
      title: msg.title,
      text: msg.text,
      type: "error",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
  }
}

var tombol_konfirmasi_semua = document.getElementById('konfirmasi-semua-peserta');
if (tombol_konfirmasi_semua) {
  document.querySelector('#konfirmasi-semua-peserta').addEventListener('click', function(e) {
    e.preventDefault();
    msg = feedback("msg","PARCNFRALL");
    swal({
      title: msg.title,
      text: msg.text,
      type  : "info",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      html:true
    },
    function (isConfirm) {
      if (isConfirm) {
        var xhttp = define_xhttp();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              msg = feedback("msg","PROC200");
              swal({
                title: msg.title,
                text: msg.text,
                type: "warning",
                showConfirmButton: false,
                showLoaderOnConfirm: true,
                timer: 1000,
                html:true
              },
              function () {
                setTimeout(function(){
                  if (xhttp.responseText == "200") {
                    msg = feedback("msg","PARDONE200");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type  : "success",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#peserta");
                      }
                    });
                  }
                  else {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text + xhttp.responseText,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#peserta");
                      }
                    });
                  }
                }, 1000);
              });
            }
            else {
              msg = feedback("msg","FATL500");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
          }
        };

        xhttp.open("POST", home_page + "handler.php?k=MRKALL", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("id=MRKALL");
      }
    });
  });
}


function show_organization_details(id) {
  if (!isEmpty(id)) {
    var pengurus_detail_organisasi = document.getElementById('pengurus-detail-organisasi');
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText == "500") {

          }
          else {
            pengurus_detail_organisasi.innerHTML = xhttp.responseText;
          }
        }
      }
    };
    xhttp.open("POST", home_page + "handler.php?k=SORG", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
  }
}

function show_participant_details(id) {
  if (!isEmpty(id)) {
    var pengurus_detail_peserta = document.getElementById('pengurus-detail-peserta');
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText == "500") {

          }
          else {
            pengurus_detail_peserta.innerHTML = xhttp.responseText;
          }
        }
      }
    };
    xhttp.open("POST", home_page + "handler.php?k=SPAR", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
  }
}

function set_action(id) {
  if (!isEmpty(id)) {
    var aksi_peserta = document.getElementById('pengurus-aksi-peserta');
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText == "500") {

          }
          else {
            aksi_peserta.value = xhttp.responseText;
          }
        }
      }
    };
    xhttp.open("POST", home_page + "handler.php?k=PAR-ACT", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("id=" + id);
  }
}

var nama_peserta = document.getElementById('pengurus-nama-peserta');
var aksi_peserta = document.getElementById('pengurus-aksi-peserta');
if (nama_peserta && aksi_peserta) {
  document.querySelector('#pengurus-nama-peserta').addEventListener('change', function(e) {
    e.preventDefault();
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText == "500") {

          }
          else {
            aksi_peserta.value = xhttp.responseText;
            show_participant_details(nama_peserta.value);
          }
        }
      }
    };

    xhttp.open("POST", home_page + "handler.php?k=PAR-ACT", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("id=" + nama_peserta.value);
  });
}

function show_participant(id) {
  if (!isEmpty(id)) {
    var nama_peserta = document.getElementById('pengurus-nama-peserta');
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText != "500") {
            nama_peserta.innerHTML = xhttp.responseText;
            set_action(nama_peserta.value);
          }
        }
      }
    };
    xhttp.open("POST", home_page + "handler.php?k=PAR-NM", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("email=" + id);
  }
}

var nama_organisasi = document.getElementById('pengurus-nama-organisasi');
var aksi_organisasi = document.getElementById('pengurus-aksi-organisasi');
if (nama_organisasi && aksi_organisasi) {
  document.querySelector('#pengurus-nama-organisasi').addEventListener('change', function(e) {
    e.preventDefault();
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText == "500") {

          }
          else {
            aksi_organisasi.value = xhttp.responseText;
            show_organization_details(nama_organisasi.value);
            show_participant(nama_organisasi.value);
          }
        }
      }
    };

    xhttp.open("POST", home_page + "handler.php?k=ORG", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("email=" + nama_organisasi.value);
  });
}

var tombol_status_organisasi = document.getElementById('pengurus-status-organisasi');
if (tombol_status_organisasi && nama_organisasi && aksi_organisasi) {
  document.querySelector('#pengurus-status-organisasi').addEventListener('click', function(e) {
    e.preventDefault();
    var nama_organisasi = document.getElementById('pengurus-nama-organisasi');
    var aksi_organisasi = document.getElementById('pengurus-aksi-organisasi');
    if (!isEmpty(nama_organisasi.value) && !isEmpty(aksi_organisasi.value)) {
      msg = feedback("msg","CHNG200");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ubah",
        cancelButtonText: "Kembali",
        closeOnConfirm: false,
        html:true
      },

      function (isConfirm) {
        if (isConfirm) {

          var xhttp = define_xhttp();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (xhttp.readyState == 4 && xhttp.status == 200) {
                if (xhttp.responseText == "200") {
                  show_organization_details(nama_organisasi.value);
                  msg = feedback("msg","DONE200");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
                else {
                  msg = feedback("msg","FAIL500");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
              }
            }
          };

          xhttp.open("POST", home_page + "handler.php?k=CORG", true);
          xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xhttp.send("id=" + nama_organisasi.value + "&aksi=" + aksi_organisasi.value);

        }
      });
    }
    else {
      redirect(home_page + "dispenkasi/#pengurus");
    }
  });
}

var tombol_status_peserta = document.getElementById('pengurus-status-peserta');
if (tombol_status_peserta && nama_organisasi && aksi_organisasi) {
  document.querySelector('#pengurus-status-peserta').addEventListener('click', function(e) {
    e.preventDefault();
    var nama_peserta = document.getElementById('pengurus-nama-peserta');
    var aksi_peserta = document.getElementById('pengurus-aksi-peserta');
    if (!isEmpty(nama_peserta.value) && !isEmpty(aksi_peserta.value)) {
      msg = feedback("msg","CHNG200");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ubah",
        cancelButtonText: "Kembali",
        closeOnConfirm: false,
        html:true
      },

      function (isConfirm) {
        if (isConfirm) {

          var xhttp = define_xhttp();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (xhttp.readyState == 4 && xhttp.status == 200) {
                if (xhttp.responseText == "200") {
                  show_participant_details(nama_peserta.value);
                  msg = feedback("msg","DONE200");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  },
                  function (isConfirm) {
                    if (isConfirm) {
                      redirect(home_page + "dispenkasi/#pengurus");
                    }
                  });
                }
                else {
                  msg = feedback("msg","FAIL500");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
              }
            }
          };

          xhttp.open("POST", home_page + "handler.php?k=CPAR", true);
          xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xhttp.send("id=" + nama_peserta.value + "&aksi=" + aksi_peserta.value);

        }
      });
    }
    else {
      redirect(home_page + "dispenkasi/#pengurus");
    }
  });
}

var refresh_organisasi = document.getElementById("refresh-organisasi");
if (refresh_organisasi) {
  document.querySelector('#refresh-organisasi').addEventListener('click', function(e) {
    e.preventDefault();
    if (!isEmpty(nama_organisasi) && nama_organisasi.value != "nill") {
      show_organization_details(nama_organisasi.value);
    }
  });
}

var refresh_peserta = document.getElementById("refresh-peserta");
if (refresh_peserta) {
  document.querySelector('#refresh-peserta').addEventListener('click', function(e) {
    e.preventDefault();
      if (!isEmpty(nama_peserta) && nama_peserta.value != "nill") {
        show_participant(email_pengurus.value);
        show_participant_details(nama_peserta.value);
      }
  });
}

function cari_organisasi(keywords) {
  if (!isEmpty(keywords)) {
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText != "500") {
            nama_organisasi.innerHTML = "";
            nama_organisasi.innerHTML = xhttp.responseText;
            msg = feedback("msg","DONE200");
            swal({
              title: msg.title,
              text: msg.text,
              type: "success",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "OK",
              closeOnConfirm: true,
              html:true
            });
          }
        }
        else {
          msg = feedback("msg","FAIL500");
          swal({
            title: msg.title,
            text: msg.text,
            type: "error",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK",
            closeOnConfirm: true,
            html:true
          });
        }
      }
    };

    xhttp.open("POST", home_page + "handler.php?k=FORG", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("cari=" + keywords);
  }
}

function cari_peserta(keywords) {
  if (!isEmpty(keywords)) {
    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText != "500") {
            nama_peserta.innerHTML = "";
            nama_peserta.innerHTML = xhttp.responseText;
            msg = feedback("msg","DONE200");
            swal({
              title: msg.title,
              text: msg.text,
              type: "success",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "OK",
              closeOnConfirm: true,
              html:true
            });
          }
        }
        else {
          msg = feedback("msg","FAIL500");
          swal({
            title: msg.title,
            text: msg.text,
            type: "error",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "OK",
            closeOnConfirm: true,
            html:true
          });
        }
      }
    };

    xhttp.open("POST", home_page + "handler.php?k=FPAR", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("cari=" + keywords);
  }
}

var cari_organisasi_peserta = document.getElementById('cari-organisasi-peserta');
if (cari_organisasi_peserta) {
  document.querySelector('#cari-organisasi-peserta').addEventListener('click', function(e) {
    e.preventDefault();
    var keyword_organisasi_peserta = document.getElementById('keyword-organisasi-peserta');
    if (!isEmpty(keyword_organisasi_peserta.value)) {
      msg = feedback("msg","FIND300");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Cari",
        cancelButtonText: "Kembali",
        closeOnConfirm: false,
        html:true
      },

      function (isConfirm) {
        if (isConfirm) {
          cari_organisasi(keyword_organisasi_peserta.value);
          cari_peserta(keyword_organisasi_peserta.value);
        }
      });
    }
    else {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }
  });
}

/* Transaksi */
var form_transaksi_dispenkasi = document.getElementById("transaksi-dispenkasi");
var email_koordinator = document.getElementById("email-koordinator");
var jenis_transaksi = document.getElementById("jenis-transaksi");
var metode_pembayaran = document.getElementById("metode-pembayaran");
var keterangan_transaksi = document.getElementById("keterangan-transaksi");
var refresh_koordinator = document.getElementById("refresh-koordinator");
var detail_transaksi = document.getElementById("detail-transaksi");
var tambah_transaksi = document.getElementById("tambah-transaksi");
var total_transaksi = document.getElementById("total-transaksi");
var transaksi_lain = document.getElementById("transaksi-lain");
var biaya_lain = document.getElementById("biaya-lain");
var refresh_id_transaksi = document.getElementById("refresh-id-transaksi");
var cari_id_transaksi = document.getElementById("cari-id-transaksi");
var hasil_cari_transaksi_peserta = document.getElementById("hasil-cari-transaksi-peserta");

function show_participants_trx(id) {
  var xhttp = define_xhttp();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        if (xhttp.responseText != "500") {
          detail_transaksi.innerHTML = xhttp.responseText;
          get_ready();
        }
        else if (xhttp.responseText == "500"){
          detail_transaksi.innerHTML = "Terjadi kesalahan, data tidak ditemukan.";
        }
      }
      else {
        msg = feedback("msg","FAIL500");
        swal({
          title: msg.title,
          text: msg.text,
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          closeOnConfirm: true,
          html:true
        });
      }
    }
  };

  xhttp.open("POST", home_page + "handler.php?k=TRXSPAR", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("id=" + id);
}

function show_trx_details(trx) {
  var xhttp = define_xhttp();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        if (xhttp.responseText != "500") {
          hasil_cari_transaksi_peserta.innerHTML = xhttp.responseText;
          get_ready();
        }
        else if (xhttp.responseText == "500"){
          hasil_cari_transaksi_peserta.innerHTML = "Terjadi kesalahan, data tidak ditemukan.";
        }
      }
      else {
        msg = feedback("msg","FAIL500");
        swal({
          title: msg.title,
          text: msg.text,
          type: "error",
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          closeOnConfirm: true,
          html:true
        });
      }
    }
  };

  xhttp.open("POST", home_page + "handler.php?k=TRXSDTL", true);
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhttp.send("id=" + trx);
}

function checkbox_checked(form) {
  var result = false;
  for (var i = 0; i < form.elements.length; i++) {
    if (form.elements[i].type == 'checkbox') {
      if (form.elements[i].checked === true) {
        result = true;
      }
    }
  }
  return result;
}

if (refresh_koordinator) {
  document.querySelector('#refresh-koordinator').addEventListener('click', function(e) {
    e.preventDefault();
    if (email_koordinator && !isEmpty(email_koordinator.value) && detail_transaksi) {
      show_participants_trx(email_koordinator.value);
    }
  });
}

if (email_koordinator) {
  $('#email-koordinator').on('select2:select', function (change) {
    if (!isEmpty(email_koordinator.value)) {
      show_participants_trx(email_koordinator.value);
    }
  });
}

if (refresh_id_transaksi) {
  document.querySelector('#refresh-id-transaksi').addEventListener('click', function(e) {
    e.preventDefault();
    if (cari_id_transaksi && !isEmpty(cari_id_transaksi.value)) {
      show_trx_details(cari_id_transaksi.value);
    }
  });
}

if (cari_id_transaksi) {
  $('#cari-id-transaksi').on('select2:select', function (change) {
    if (!isEmpty(cari_id_transaksi.value)) {
      show_trx_details(cari_id_transaksi.value);
    }
  });
}

if (form_transaksi_dispenkasi) {
  document.querySelector('#transaksi-dispenkasi').addEventListener('submit', function(e) {
    e.preventDefault();
    if (!isEmpty(email_koordinator.value) && !isEmpty(jenis_transaksi.value) && !isEmpty(metode_pembayaran.value) && jenis_transaksi.value == "P") {
      if (transaksi_lain.checked === true) {
        if (isEmpty(biaya_lain.value) || biaya_lain.value == "0" || biaya_lain === 0 || isNaN(biaya_lain.value)) {
          $('#transaksi-lain').iCheck('uncheck');
          $("#biaya-lain").prop('disabled', true);
        }
      }
      if (checkbox_checked(form_transaksi_dispenkasi)) {
        var form = form_transaksi_dispenkasi;
        var participants = Array();
        for (var i = 0; i < form.elements.length; i++) {
          if (form.elements[i].type == 'checkbox') {
            if (form.elements[i].checked === true && form.elements[i].value != "oth" && form.elements[i].value !== null && form.elements[i].value !== "" && form.elements[i].value != " " && !isEmpty(form.elements[i].value)) {
              participants[i] = form.elements[i].value;
            }
          }
        }
        participants = JSON.stringify(participants);
        msg = feedback("msg","CNFR200");
        swal({
          title: msg.title,
          text: msg.text,
          type: "info",
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Tambah",
          cancelButtonText: "Kembali",
          closeOnConfirm: false,
          html:true
        },

        function (isConfirm) {
          if (isConfirm) {
            var xhttp = define_xhttp();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                  if (xhttp.responseText == "200") {
                    msg = feedback("msg","DONE200");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type: "success",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#pengurus");
                      }
                    });
                  }
                  else {
                    msg = feedback("msg","FAIL500");
                    swal({
                      title: msg.title,
                      text: msg.text + ": " + xhttp.responseText,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#pengurus");
                      }
                    });
                  }
                }
              }
            };
            xhttp.open("POST", home_page + "handler.php?k=TRXAPAR", true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            var data = "email=" + email_koordinator.value + "&jenis=" + jenis_transaksi.value + "&metode=" + metode_pembayaran.value + "&peserta=" + participants + "&informasi=" + keterangan_transaksi.value;
            if (transaksi_lain.checked === true) {
              data = "email=" + email_koordinator.value + "&jenis=" + jenis_transaksi.value + "&metode=" + metode_pembayaran.value + "&peserta=" + participants + "&informasi=" + keterangan_transaksi.value + "&lain=" + biaya_lain.value;
            }
            else {
              data = "email=" + email_koordinator.value + "&jenis=" + jenis_transaksi.value + "&metode=" + metode_pembayaran.value + "&peserta=" + participants + "&informasi=" + keterangan_transaksi.value;
            }
            xhttp.send(data);
          }
        });
      }
      else {
        msg = feedback("msg","FAIL500");
        swal({
          title: msg.title,
          text: "Silahkan pilih detail transaksi terlebih dahulu.",
          type: "error",
          showConfirmButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "OK",
          closeOnConfirm: true,
          html:true
        });
      }
    }
    else {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "error",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }
  });
}

var show_hide_transaksi = document.getElementById('show-hide-transaksi');
if (show_hide_transaksi) {
  var q = 0;
  $(document).ready(function(){
    document.querySelector('#show-hide-transaksi').addEventListener('click', function(e) {
      var form = this;
      var informasi_transaksi = document.getElementById('informasi-transaksi');
      var pesan_riwayat_transaksi = document.getElementById('pesan-riwayat-transaksi');
      e.preventDefault();
      if (informasi_transaksi) {
        if (q % 2 === 0) {
          $("#informasi-transaksi").slideUp(1000);
          pesan_riwayat_transaksi.innerHTML = "Gunakan tombol <i>resize</i> untuk melihat dan menyembunyikan riwayat transaksi.";
        }
        else if (q % 2 == 1) {
          $("#informasi-transaksi").slideDown(1000);
          pesan_riwayat_transaksi.innerHTML = "";
        }
        q++;
      }
    });
  });
}

/* Pengumuman */

var form_tambah_pengumuman = document.getElementById('form-tambah-pengumuman');
var judul_pengumuman = document.getElementById('judul-pengumuman');
var konten_pengumuman = document.getElementById('konten-pengumuman');
var tambah_pengumuman = document.getElementById('tambah-pengumuman');
if (form_tambah_pengumuman && judul_pengumuman && konten_pengumuman && tambah_pengumuman) {
  document.querySelector('#form-tambah-pengumuman').addEventListener('submit', function(e) {
    var form = this;
    e.preventDefault();
    if (!isEmpty(judul_pengumuman.value) && !isEmpty(konten_pengumuman)) {
      msg = feedback("msg","CNFR200");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Tambah",
        cancelButtonText: "Kembali",
        closeOnConfirm: false,
        html:true
      },

      function (isConfirm) {
        if (isConfirm) {
          var xhttp = define_xhttp();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if (xhttp.readyState == 4 && xhttp.status == 200) {
                if (xhttp.responseText == "200"){
                  msg = feedback("msg","DONE200");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  },
                  function (isConfirm) {
                    if (isConfirm) {
                      redirect(home_page + "dispenkasi/#pengumuman");
                    }
                  });
                }
                else {
                  msg = feedback("msg","FAIL500");
                  swal({
                    title: msg.title,
                    text: msg.text +  " - " + xhttp.responseText,
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });
                }
              }
              else {
                msg = feedback("msg","FATL500");
                swal({
                  title: msg.title,
                  text: msg.text,
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "OK",
                  closeOnConfirm: true,
                  html:true
                });
              }
            }
          };

          xhttp.open("POST", home_page + "handler.php?k=ADDANCT", true);
          xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xhttp.send("title=" + judul_pengumuman.value + "&content=" + konten_pengumuman.value);
        }
      });
    }
    else {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "info",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }//kosong
  });
}

function hapus_pengumuman(id) {
  if (!isEmpty(id)) {
    msg = feedback("msg","DELT200");
    swal({
      title: msg.title,
      text: msg.text,
      type: "info",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Hapus",
      cancelButtonText: "Kembali",
      closeOnConfirm: false,
      html:true
    },

    function (isConfirm) {
      if (isConfirm) {
        var xhttp = define_xhttp();

        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
              msg = feedback("msg","PROC200");
              swal({
                title: msg.title,
                text: msg.text,
                type: "warning",
                showConfirmButton: false,
                showLoaderOnConfirm: true,
                timer: 1000,
                html:true
              },
              function () {
                setTimeout(function(){
                  if (xhttp.responseText == "200") {
                    msg = feedback("msg","DONE200");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type  : "success",
                      showCancelButton: false,
                      showConfirmButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#pengumuman");
                      }
                    });
                  }
                  else {
                    msg = feedback("msg","FATL500");
                    swal({
                      title: msg.title,
                      text: msg.text,
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "OK",
                      closeOnConfirm: true,
                      html:true
                    },
                    function (isConfirm) {
                      if (isConfirm) {
                        redirect(home_page + "dispenkasi/#pengumuman");
                      }
                    });
                  }
                }, 1000);
              });
            }
            else {
              msg = feedback("msg","FATL500");
              swal({
                title: msg.title,
                text: msg.text,
                type: "error",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                closeOnConfirm: true,
                html:true
              });
            }
          }
        };

        xhttp.open("POST", home_page + "handler.php?k=DELANCT", true);
        xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.send("id=" + id);
      }
    });
  }
  else {
    msg = feedback("msg","FATL500");
    swal({
      title: msg.title,
      text: msg.text,
      type: "error",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      html:true
    });
  }
}

var lihat_status_partisipan = document.getElementById('lihat-status-partisipan');
var keywords_status_partisipan = document.getElementById('keywords-status-partisipan');
var hasil_status_partisipan = document.getElementById('hasil-status-partisipan');
var coordinator = document.getElementById('coordinator');
var parins = document.getElementById('parins');

if (lihat_status_partisipan && keywords_status_partisipan && coordinator && parins) {
  document.querySelector('#form-status-partisipan').addEventListener('submit', function(e) {
    var form = this;
    e.preventDefault();
    if (isEmpty(keywords_status_partisipan.value) || keywords_status_partisipan.value == "@") {
      msg = feedback("msg","INCR404");
      swal({
        title: msg.title,
        text: msg.text,
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true,
        html:true
      });
    }
    else {
      var xhttp = define_xhttp();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            msg = feedback("msg","PROC200");
            swal({
              title: msg.title,
              text: msg.text,
              type: "warning",
              showConfirmButton: false,
              showLoaderOnConfirm: true,
              timer: 1000,
              html:true
            },
            function () {
              setTimeout(function(){
                if (xhttp.responseText != "500") {
                  msg = feedback("msg","DONE200");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type  : "success",
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    html:true
                  });
                  hasil_status_partisipan.innerHTML = xhttp.responseText;
                }
                else {
                  msg = feedback("msg","FATL500");
                  swal({
                    title: msg.title,
                    text: msg.text,
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "OK",
                    closeOnConfirm: true,
                    html:true
                  });/*,
                  function (isConfirm) {
                    if (isConfirm) {
                      redirect(home_page + "dispenkasi/#pengumuman");
                    }
                  });
                  */
                }
              }, 1000);
            });
          }
          else {
            msg = feedback("msg","FATL500");
            swal({
              title: msg.title,
              text: msg.text,
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "OK",
              closeOnConfirm: true,
              html:true
            });
          }
        }
      };

      var query = "cat=PI";

      if (get_radio_value(document.getElementById('form-status-partisipan'), 'iCheck') == "CO") {
        query = "cat=CO";
      }
      else if (get_radio_value(document.getElementById('form-status-partisipan'), 'iCheck') == "PI") {
        query = "cat=PI";
      }
      else {
        //avoid injection
      }

      query += "&key=" + keywords_status_partisipan.value;
      xhttp.open("POST", home_page + "handler.php?k=STREG", true);
      xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      xhttp.send(query);
    }
  });
}


var centang_semua_pengguna = document.getElementById('centang-semua-pengguna');
if (centang_semua_pengguna) {
  document.querySelector('#centang-semua-pengguna').addEventListener('click', function(e) {
    var form = this;
    e.preventDefault();
    $('input').iCheck('check');
  });
}

var jangan_centang_semua_pengguna = document.getElementById('jangan-centang-semua-pengguna');
if (jangan_centang_semua_pengguna) {
  document.querySelector('#jangan-centang-semua-pengguna').addEventListener('click', function(e) {
    var form = this;
    e.preventDefault();
    $('input').iCheck('uncheck');
  });
}

var daftar_asal = document.getElementById("daftar-asal");
var tombol_periksa_asal = document.getElementById('tombol-periksa-asal');
if (tombol_periksa_asal && daftar_asal) {
  document.querySelector('#tombol-periksa-asal').addEventListener('click', function(e) {
    var form = this;
    e.preventDefault();

    var xhttp = define_xhttp();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          if (xhttp.responseText == "500") {
            msg = feedback("msg","FATL500");
            swal({
              title: msg.title,
              text: msg.text,
              type: "error",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "OK",
              closeOnConfirm: true,
              html:true
            });
          }
          else {
            var reg = JSON.parse(xhttp.responseText);
            var text = "";
            if (!isEmpty(reg.region_chariman) || !isEmpty(reg.region_address)) {
              if (!isEmpty(reg.region_chariman)) {
                text = empty_to_strip(reg.region_chariman);
              }
              if (!isEmpty(reg.region_address)) {
                text += "<br />" + empty_to_strip(reg.region_address);
              }
              if (!isEmpty(reg.region_phone) || !isEmpty(reg.region_email)) {
                  text += "<br />Telepon/Email: " + empty_to_strip(reg.region_phone) + "/" + empty_to_strip(reg.region_email);
              }
            }
            swal({
              title: empty_to_strip(reg.region_name),
              text: text,
              type: "success",
              showCancelButton: false,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "OK",
              closeOnConfirm: true,
              html:true
            });
          }
        }
      }
    };
    xhttp.open("POST", home_page + "handler.php?k=REGID", true);
    xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhttp.send("id=" + daftar_asal.value);
  });
}
