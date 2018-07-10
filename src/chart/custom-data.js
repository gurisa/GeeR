$(document).ready(function() {

	$.ajax({
		url: home_page + "handler.php?k=REGCTPARGEN",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var reg_peserta_kategori_kelamin = document.getElementById("reg-peserta-kategori-kelamin");
			reg_peserta_kategori_kelamin.getContext("2d").canvas.height = 80;
			var reg_peserta_chart_kelamin = new Chart(reg_peserta_kategori_kelamin, {
				type: 'pie',
				animation: {
					animateRotate:true
				},
				data: {
				labels: ["Laki-Laki", "Perempuan"],
				datasets: [{
						data: data,
						backgroundColor: [
								'rgba(14, 91, 241, 0.5)',
								'rgba(222, 119, 119, 0.62)'

						],
						borderColor: [
								'rgba(54, 162, 235, 1)',
								'rgba(255,99,132,1)'
						],
						borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});
	/*
	*/
	$.ajax({
		url: home_page + "handler.php?k=REGCTPARCLS",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var reg_peserta_kategori_daftar = document.getElementById("reg-peserta-kategori-daftar");
			reg_peserta_kategori_daftar.getContext("2d").canvas.height = 80;
			var reg_peserta_chart_kelas = new Chart(reg_peserta_kategori_daftar, {
				type: 'pie',
				animation: {
			    animateRotate:true
			  },
				data: {
				labels: ["PAKIN", "RAKIN", "Peninjau"],
				datasets: [{
				    data: data,
				    backgroundColor: [
				        'rgba(135, 19, 207, 0.5)',
				        'rgba(18, 215, 20, 0.38)',
				        'rgba(255, 206, 86, 0.2)'
				    ],
				    borderColor: [
				        'rgba(135, 19, 207, 1)',
				        'rgba(18, 215, 20, 1)',
				        'rgba(255, 206, 86, 1)'
				    ],
				    borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});

	/*
	$.ajax({
		url: home_page + "handler.php?k=REGCTRMB",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var reg_peserta_minat_bakat_remaja = document.getElementById("reg-peserta-minat-bakat-remaja");
			reg_peserta_minat_bakat_remaja.getContext("2d").canvas.height = 80;
			var reg_peserta_chart_mb_remaja = new Chart(reg_peserta_minat_bakat_remaja, {
				type: 'pie',
				animation: {
			    animateRotate:true
			  },
				data: {
				labels: ["Musik", "Tari", "Bela Diri"],
				datasets: [{
				    data: data,
						backgroundColor: [
				        'rgba(214, 126, 21, 0.5)',
				        'rgba(18, 215, 20, 0.38)',
				        'rgba(222, 119, 119, 0.62)'
				    ],
				    borderColor: [
				        'rgba(228, 134, 23, 1)',
				        'rgba(18, 215, 20, 1)',
				        'rgba(255,99,132,1)'
				    ],
				    borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});

	$.ajax({
		url: home_page + "handler.php?k=REGCTPMB",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var reg_peserta_minat_bakat_dewasa = document.getElementById("reg-peserta-minat-bakat-dewasa");
			reg_peserta_minat_bakat_dewasa.getContext("2d").canvas.height = 80;
			var reg_peserta_chart_mb_dewasa = new Chart(reg_peserta_minat_bakat_dewasa, {
				type: 'pie',
				animation: {
			    animateRotate:true
			  },
				data: {
				labels: ["Musik", "Tari", "Bela Diri"],
				datasets: [{
				    data: data,
						backgroundColor: [
				        'rgba(214, 126, 21, 0.5)',
				        'rgba(18, 215, 20, 0.38)',
				        'rgba(222, 119, 119, 0.62)'
				    ],
				    borderColor: [
				        'rgba(228, 134, 23, 1)',
				        'rgba(18, 215, 20, 1)',
				        'rgba(255,99,132,1)'
				    ],
				    borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});
	*/

	$.ajax({
		url: home_page + "handler.php?k=UNREGCTPARGEN",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var unreg_peserta_kategori_kelamin = document.getElementById("unreg-peserta-kategori-kelamin");
			unreg_peserta_kategori_kelamin.getContext("2d").canvas.height = 80;
			var unreg_peserta_chart_kelamin = new Chart(unreg_peserta_kategori_kelamin, {
				type: 'pie',
				animation: {
					animateRotate:true
				},
				data: {
				labels: ["Laki-Laki", "Perempuan"],
				datasets: [{
						data: data,
						backgroundColor: [
								'rgba(14, 91, 241, 0.5)',
								'rgba(222, 119, 119, 0.62)'

						],
						borderColor: [
								'rgba(54, 162, 235, 1)',
								'rgba(255,99,132,1)'
						],
						borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});
	/*
	*/
	$.ajax({
		url: home_page + "handler.php?k=UNREGCTPARCLS",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var unreg_peserta_kategori_daftar = document.getElementById("unreg-peserta-kategori-daftar");
			unreg_peserta_kategori_daftar.getContext("2d").canvas.height = 80;
			var unreg_peserta_chart_kelas = new Chart(unreg_peserta_kategori_daftar, {
				type: 'pie',
				animation: {
			    animateRotate:true
			  },
				data: {
				labels: ["PAKIN", "RAKIN", "Peninjau"],
				datasets: [{
				    data: data,
				    backgroundColor: [
				        'rgba(135, 19, 207, 0.5)',
				        'rgba(18, 215, 20, 0.38)',
				        'rgba(255, 206, 86, 0.2)'
				    ],
				    borderColor: [
				        'rgba(135, 19, 207, 1)',
				        'rgba(18, 215, 20, 1)',
				        'rgba(255, 206, 86, 1)'
				    ],
				    borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});

	/**/
	$.ajax({
		url: home_page + "handler.php?k=ALLCTPARGEN",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var all_peserta_kategori_kelamin = document.getElementById("all-peserta-kategori-kelamin");
			all_peserta_kategori_kelamin.getContext("2d").canvas.height = 80;
			var all_peserta_chart_kelamin = new Chart(all_peserta_kategori_kelamin, {
				type: 'pie',
				animation: {
					animateRotate:true
				},
				data: {
				labels: ["Laki-Laki", "Perempuan"],
				datasets: [{
						data: data,
						backgroundColor: [
								'rgba(14, 91, 241, 0.5)',
								'rgba(222, 119, 119, 0.62)'

						],
						borderColor: [
								'rgba(54, 162, 235, 1)',
								'rgba(255,99,132,1)'
						],
						borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});
	/*
	*/
	$.ajax({
		url: home_page + "handler.php?k=ALLCTPARCLS",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var all_peserta_kategori_daftar = document.getElementById("all-peserta-kategori-daftar");
			all_peserta_kategori_daftar.getContext("2d").canvas.height = 80;
			var all_peserta_chart_kelas = new Chart(all_peserta_kategori_daftar, {
				type: 'pie',
				animation: {
					animateRotate:true
				},
				data: {
				labels: ["PAKIN", "RAKIN", "Peninjau"],
				datasets: [{
						data: data,
						backgroundColor: [
								'rgba(135, 19, 207, 0.5)',
								'rgba(18, 215, 20, 0.38)',
								'rgba(255, 206, 86, 0.2)'
						],
						borderColor: [
								'rgba(135, 19, 207, 1)',
								'rgba(18, 215, 20, 1)',
								'rgba(255, 206, 86, 1)'
						],
						borderWidth: 1
				}]
			},
				options: {
					scales: {

					}
				}
			});
		}
	});

	/**/
	$.ajax({
		url: home_page + "handler.php?k=REGCTWEBHIT",
		method: "POST",
		success: function(data) {
			data = JSON.parse(data);
			var cur_date = [];
			var cur_val = [];

			for (var i in data) {
				cur_date.push(data[i].hit_ws_date);
				cur_val.push(data[i].hit_ws_count);
			}

			var hit_website_harian = document.getElementById("hit-website-harian");
			hit_website_harian.getContext("2d").canvas.height = 50;
			var hit_chart_harian = new Chart(hit_website_harian, {
				type: 'line',
				animation: {animateRotate:true},
    		data: {
					labels: cur_date,
			    datasets: [{
	            label: "Hit website",
	            fill: false,
	            lineTension: 0.1,
	            backgroundColor: "rgba(193, 128, 75, 0.4)",
	            borderColor: "rgba(214, 135, 70, 0.9)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(176, 77, 14, 1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(176, 63, 14, 1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: cur_val,
	            spanGaps: false,
			      }
			    ]
    		},
		    options: {

		    }
			});
		}
	});


});
