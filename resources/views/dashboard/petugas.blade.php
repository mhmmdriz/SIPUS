@extends('layouts.main')

@section('container')
<h3>Dashboard</h3>
<hr>

<div class="card col-md-12 my-5">
  <div class="card-body row d-flex justify-content-center ">
      <div class="col-md-6">
          <div class="row justify-content-center">
              <div class="col-md-auto">
              <h4>number of books per category</h4>
              </div>
          </div>
          <div class="row">
              <div class="col">
                  <canvas id="bar" width="700" height="400"></canvas>
              </div>
          </div>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  var labels = [];
  var data = [];

  @foreach ($categories as $category)
    labels.push("{{ $category->nama }}");
    data.push("{{ $category->total_buku }}");
  @endforeach

  var ctx = document.getElementById('bar').getContext('2d');
  Chart.defaults.color = '#fff';

  var barData = {
    labels: labels,
    datasets: [{
      label: "",
      data: data,
      backgroundColor: [
        'rgba(255, 205, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(255, 99, 132, 0.7)',
        'rgba(255, 159, 64, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(201, 203, 207, 0.7)'
        // Tambahkan warna lain sesuai kebutuhan
      ]
    }],
  };
  
  // Buat bar
  var bar = new Chart(ctx, {
    type: 'bar',
    data: barData,
    options: {
      maintainAspectRatio: false, // Mengizinkan perubahan aspek ratio
      responsive: true, // Mengizinkan responsif terhadap ukuran layar
      plugins: {
        legend: {
          display: false,
        }
      }
        
    }
  });
</script>
@endsection
