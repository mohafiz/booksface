<div>
    @extends('adminlte::page')

    @section('plugins.Chartjs', true)
    
    @section('title', 'Admin Panel')

    @section('content_header')
        <h1>Dashboard</h1>
    @stop

    @section('content')
        
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $orders }}</h3>
  
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $books }}</h3>
  
                  <p>Total Books</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $users }}</h3>
  
                  <p>Total Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $newusers }}</h3>
  
                  <p>New Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable ui-sortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Monthly Sales and Visits
                  </h3>
                  
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px; display: block; width: 768px;" width="768" class="chartjs-render-monitor"></canvas>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              <!-- TO DO List -->
              <div class="card">
                <div class="card-header ui-sortable-handle">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    To Do List
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <ul class="todo-list ui-sortable" data-widget="todo-list">
                    @foreach ($toDoList as $item)
                      <li class="{{ $item->completed ? 'done' : '' }}">
                        <!-- checkbox -->
                        <div class="icheck-primary d-inline ml-2">
                          <input type="checkbox" wire:model="completed.{{ $item->id }}">
                        </div>
                        <!-- todo text -->
                        <span class="text">{{ $item->name }}</span>
                        <!-- Emphasis label -->
                        <small class="badge {{ $item->unit == 'mins' ? 'badge-danger' : 'badge-info' }}"><i class="far fa-clock"></i> {{ $item->period }} {{ $item->unit }}</small>
                      </li>
                    @endforeach
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                </div>
              </div>
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable ui-sortable">
  
              <!-- Map card -->
              <div class="card bg-gradient-primary">
                <div class="card-header border-0 ui-sortable-handle">
                  <h3 class="card-title">
                    <i class="fas fa-book mr-1"></i>
                    Monthly Orders
                  </h3>
                </div>
                </div>
                <!-- /.card-body-->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <canvas id="orders-chart-canvas" height="600" style="height: 500px; display: block; width: 768px;" width="768" class="chartjs-render-monitor"></canvas>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>

    @stop

    @section('js')
        <script>
          var ctx = document.getElementById('sales-chart-canvas').getContext('2d');
          var chart = new Chart(ctx, {
          // The type of chart we want to create
          type: 'line',

          // The data for our dataset
          data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [{
                  label: 'Sales',
                  backgroundColor: 'rgb(255, 99, 132)',
                  borderColor: 'rgb(255, 99, 132)',
                  data: [0, 10, 5, 2, 20, 25, 40]
              },
              {
                  label: 'Visits',
                  backgroundColor: 'rgb(22, 98, 219)',
                  borderColor: 'rgb(22, 98, 219)',
                  data: [0, 20, 10, 8, 40, 50, 55]
              },]
          },

          // Configuration options go here
          options: {}
      });

      new Chart(document.getElementById("orders-chart-canvas"), {
          type: 'pie',
          data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
              label: "Orders",
              backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850", '#e0d2ab', '#abe0d3'],
              data: [24,52,73,78,43,52,48]
            }]
          },
          options: {}
      });
        </script>
    @stop

    @section('footer')
        <p>© All Rights Reserved ©</p>
    @stop

</div>
