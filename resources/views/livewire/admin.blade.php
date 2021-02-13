<div>
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
          <a href="{{ route('admin_orders') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
          <a href="{{ route('admin_books') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
          <a href="{{ route('admin_users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
          <a href="{{ route('admin_newusers') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
          <div class="card-header ui-sortable-handle">
            <h3 class="card-title">
              <i class="fas fa-chart-pie mr-1"></i>
              Monthly Sales (in Dollars)
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
            @if($toDoList->count() > 0)
            <div class="card-body">
              <ul class="todo-list ui-sortable" data-widget="todo-list">
                @foreach ($toDoList as $item)
                  <li class="{{ $item->completed ? 'done' : '' }}">
                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" wire:model="completed.{{ $item->id }}" wire:click="completed({{ $item->id }})">
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
        @else
          <div class="card-body">
            No items.
          </div>
        @endif
          <div class="card-footer clearfix">
            <h3>Add an Item</h3>
            <hr>
            <!-- Add Item Form -->

            <form wire:submit.prevent.lazy="addToDoItem">
              <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" class="form-control" id="Name" placeholder="Enter To-Do name" wire:model="toDo.name">
                @error('toDo.name') <span style="color: red">{{ $message }}</span> @enderror
              </div>
              <div class="form-group">
                <label for="Period">Period</label>
                <input type="number" class="form-control" id="Period" placeholder="How much did it take to complete ?" wire:model="toDo.period">
                @error('toDo.period') <span style="color: red">{{ $message }}</span> @enderror
              </div>
              <div class="form-grup">
                <label for="Unit">Choose a unit</label>
                <select class="form-control" id="Unit" wire:model="toDo.unit">
                  <option>mins</option>
                  <option>hours</option>
                  <option>days</option>
                  <option>months</option>
                  <option>years</option>
                </select>
                @error('toDo.unit') <span style="color: red">{{ $message }}</span> @enderror
              </div>
              <br>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <!-- /.Add Item Form -->
          </div>
        </div>
        <!-- /.card -->
      </section>
      <!-- /.Left col -->
      <!-- right col -->
      <section class="col-lg-5 connectedSortable ui-sortable">

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
              <!-- Morris chart - Orders -->
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

@section('js')
  <script>
    var months = [];
    var sales  = [];
    @foreach($salesChart as $month => $sales){ months.push( '{{ $month }}' ) } @endforeach;
    @foreach($salesChart as $month => $sales){ sales.push( {{ $sales }} ) } @endforeach;

    var ctx = document.getElementById('sales-chart-canvas').getContext('2d');
    var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: months,
        datasets: [{
            label: 'Sales',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: sales,
        },
        ]
    },

    // Configuration options go here
    options: {}
});

    var orderMonths = [];
    var orders      = [];
    @foreach($ordersChart as $month => $orders){ orderMonths.push( '{{ $month }}' ) } @endforeach;
    @foreach($ordersChart as $month => $orders){ orders.push( {{ $orders }} ) } @endforeach;

new Chart(document.getElementById("orders-chart-canvas"), {
    type: 'pie',
    data: {
      labels: orderMonths,
      datasets: [{
        label: "Orders",
        backgroundColor: ["#0c1bed", "#0cd6ed","#ffff00","#ff0000","#ff4000", '#ff8000', '#ffbf00', "#bfff00","#80ff00","#00ff40", '#00ffbf', '#bf00ff'],
        data: orders
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