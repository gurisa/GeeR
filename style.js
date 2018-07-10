function isEmpty(input) {
  if (input === "" || input === undefined || input === null) {
    return true;
  }
}

function redirect(url) {
  //location.href = url;
  location.reload();
}

function empty_to_strip(str) {
  if (isEmpty(str)) {
    str = "-";
  }
  return str;
}

var home_page = document.getElementById('home-page').value;

var suara_genta = document.getElementById('suara-genta');
if (suara_genta) {
document.querySelector('#suara-genta').addEventListener('submit', function(e) {
    var nama = document.getElementById("nama").value;
    var asal = document.getElementById("asal").value;
    var saran = document.getElementById("saran").value;
    var lagu_1 = $("#lagu_1 :selected").text();
    var lagu_2 = $("#lagu_2 :selected").text();
    var lagu_3 = $("#lagu_3 :selected").text();
    var form = this;
    e.preventDefault();

    if (isEmpty(nama) || isEmpty(asal) || isEmpty(lagu_1) || isEmpty(lagu_2) || isEmpty(lagu_3)) {
      if (isEmpty(nama)) {
        document.getElementById("nama").focus();
      }
      else if (isEmpty(asal)) {
        document.getElementById("asal").focus();
      }
      else if (isEmpty(saran)) {
        document.getElementById("saran").focus();
      }
      swal({
        title: "Suaraku",
        text: "<p style='text-align:left; padding:0px 5% 0px 5%;'>Silahkan isi form dengan benar (^.^)/ <br /><br /><b>*Pastikan kamu mengisi Nama, Asal PAKIN/RAKIN/MAKIN, dan jangan lupa pilih Nyanyian Pujian kesukaanmu.</b></p>",
        type: "info",
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: false,
        html:true
      });
    }
    else {

      swal({
        title: "Suara Genta",
        text: "<p style='text-align:left; padding:0px 5% 0px 5%;'>Nama : " + nama + "<br /> Asal : " + asal + " <br /> Saran : " + saran + "<br /><br /> <b>Pilihan Nyanyian Pujian</b> <br />1. " + lagu_1 + "<br />2. " + lagu_2 + "<br />3. " + lagu_3 +"<br /><br />*Pastikan lagu pilihan kesukaanmu sudah benar ya!<br />*Jika sudah yakin benar, silahkan tekan tombol Kirim.</p>",
        type: "info",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Kirim",
        cancelButtonText: "Kembali",
        closeOnConfirm: false,
        html:true
      },

      function (isConfirm) {
        if (isConfirm) {
          form.submit();
        }
      });//endfunction

    }//endif
  //});

//});
});
}

function success_submit_form_suara() {
  swal({
    title : "Terima Kasih (^_^)/",
    text  : "Suara kamu sudah kami terima, terima kasih atas partisipasinya. <br /><br />Suaramu dapat kamu lihat di <a href='" + home_page + "suaraku.php' title='Suaraku' target='_blank'>Suaraku</a> ",
    type  : "success",
    showCancelButton: true,
    showConfirmButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Lihat Suaraku?",
    cancelButtonText: "Selesai",
    html:true
  },

  function (isConfirm) {
    if (isConfirm) {
      window.location.href = home_page + "suaraku.php";
    }
  });

}

function validate_form_barang() {
  var query = document.getElementById('keywords').value;

  if (isEmpty(query)) {
    document.getElementById("keywords").focus();
    swal({
      title: "Kata kunci yang dimasukan kosong.",
      text: "Silahkan masukan kata kunci pencarian dengan benar.",
      type: "warning",
      showCancelButton: false,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "OK",
      closeOnConfirm: false,
      html:true
    });
    return false;
  }

}

function add_class(id_name, class_name) {
  if (!isEmpty(id_name) && !isEmpty(class_name)) {
    var new_class = document.getElementById(id_name);
    new_class.className += " " + class_name ;
  }
  else {
    return;
  }
}

function go_to_tab(tab) {
  if (!isEmpty(tab)) {
    $('.nav-pills a[href="#' + tab + '"]').tab('show');
    if (tab == "panduan") {
      var panduan_pendaftaran = document.getElementById('tutorial-panduan-pendaftaran');
      if (panduan_pendaftaran) {
        var data = '<iframe src="https://docs.google.com/viewer?srcid=0B6XWD9ziGfx7RGwxdWV4M08wTEU&pid=explorer&efh=false&a=v&chrome=false&embedded=true" width="100%" height="480px"></iframe>';
        panduan_pendaftaran.innerHTML = data;
      }
    }
  }
}

function define_xhttp() {
  var xhttp;
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  }
  else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  return xhttp;
}

function tanggal_sekarang() {
  var new_date = new Date();
  var tanggal = new_date.getDate();
	var bulan = new_date.getMonth() + 1;
	var tahun = new_date.getFullYear();
  var result = tahun + '-' + bulan + '-' + tanggal;
  return result;
}

function num_to_rupiah(num) {
  if (!isEmpty(num)) {
    var rev = parseInt(num, 10).toString().split('').reverse().join('');
    var rev2 = '';
    for (var i = 0; i < rev.length; i++){
      rev2  += rev[i];
      if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
          rev2 += '.';
      }
    }
    return 'Rp' + rev2.split('').reverse().join('') + ',00';
  }
  else {
    return 'Rp0,00';
  }
}

function batas_usia() {
  var sekarang = tanggal_sekarang();
  var tmp = Array();
  tmp = sekarang.split('-');
  tmp[0] = tmp[0] - 15;
  var result = tmp[0] + '-' + tmp[1] + '-' + tmp[2];
  return result;
}

function compare_date(tanggal_lahir, tanggal_batas) {
  tanggal_lahir.split('-');
  tanggal_batas.split('-');
  tanggal_lahir[1] = tanggal_lahir[1] - 1;
  tanggal_batas[1] = tanggal_batas[1] - 1;
  var tanggal_1 = new Date(tanggal_lahir[2],tanggal_lahir[1],tanggal_lahir[0]);
  var tanggal_2 = new Date(tanggal_batas[2],tanggal_batas[1],tanggal_batas[0]);
  var result = false;
  if (tanggal_1.getTime() > tanggal_2.getTime()) {
    result = true;
  }
  return result;
}

$(document).ready(function() {
  if (window.location.hash) {
    if ($(window.location.hash).length) {
      go_to_tab(window.location.hash.replace("#", ""));
    }
  }
});
