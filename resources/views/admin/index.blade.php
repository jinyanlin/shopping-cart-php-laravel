@extends('layouts.admin')

@section('content')
    
<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="me-md-3 me-xl-5">
            <h2>Welcome back,</h2>
            <p class="mb-md-0"></p>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard</p>
          </div>
        </div>
        {{-- <div class="d-flex justify-content-between align-items-end flex-wrap">
          <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
            <i class="mdi mdi-download text-muted"></i>
          </button>
          <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
            <i class="mdi mdi-clock-outline text-muted"></i>
          </button>
          <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
            <i class="mdi mdi-plus text-muted"></i>
          </button>
          <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
        </div> --}}
      </div>
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body dashboard-tabs p-0">
          <ul class="nav nav-tabs px-4" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Purchases</a>
            </li>
          </ul>
          <div class="tab-content py-0 px-0">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
              <div class="d-flex flex-wrap justify-content-xl-between">
                <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Start date</small>
                    <div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h5 class="mb-0 d-inline-block">choose any date</h5>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                        @foreach ($orderdate as $item)
                            @php
                                $newtime = strtotime($item->created_at);
                                $time = date('Y-m-d',$newtime);
                            @endphp
                            <a class="dropdown-item" href="">{{ $time }}</a>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Revenue</small>
                    <h5 class="me-2 mb-0">$577545</h5>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Total views</small>
                    <h5 class="me-2 mb-0">9833550</h5>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Downloads</small>
                    <h5 class="me-2 mb-0">2233783</h5>
                  </div>
                </div>
                <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Flagged</small>
                    <h5 class="me-2 mb-0">3497843</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
              <div class="d-flex flex-wrap justify-content-xl-between">
                <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Start date</small>
                    <div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                        <a class="dropdown-item" href="#">12 Aug 2018</a>
                        <a class="dropdown-item" href="#">22 Sep 2018</a>
                        <a class="dropdown-item" href="#">21 Oct 2018</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Downloads</small>
                    <h5 class="me-2 mb-0">2233783</h5>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Total views</small>
                    <h5 class="me-2 mb-0">9833550</h5>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Revenue</small>
                    <h5 class="me-2 mb-0">$577545</h5>
                  </div>
                </div>
                <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Flagged</small>
                    <h5 class="me-2 mb-0">3497843</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
              <div class="d-flex flex-wrap justify-content-xl-between">
                <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Start date</small>
                    <div class="dropdown">
                      <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                        <a class="dropdown-item" href="#">12 Aug 2018</a>
                        <a class="dropdown-item" href="#">22 Sep 2018</a>
                        <a class="dropdown-item" href="#">21 Oct 2018</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Revenue</small>
                    <h5 class="me-2 mb-0">$577545</h5>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Total views</small>
                    <h5 class="me-2 mb-0">9833550</h5>
                  </div>
                </div>
                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Downloads</small>
                    <h5 class="me-2 mb-0">2233783</h5>
                  </div>
                </div>
                <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                  <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                  <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted">Flagged</small>
                    <h5 class="me-2 mb-0">3497843</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
   
  <div class="row">
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <ul class="box-info">
            <li>
              <i class='bx bx-calendar-heart'></i>
              <span class="text">
                <h3>{{ $ordertotal }}</h3>
                <p>Total Order</p>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <ul class="box-info">
            <li>
              <i class='bx bx-calendar-heart'></i>
              <span class="text">
                <h3>{{ $usertotal}}</h3>
                <p>Total User</p>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <ul class=" box-info">
            <li>
              <i class='bx bx-calendar-heart'></i>
              <span class="text">
                <h3>0.0</h3>
                <p>New Order</p>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div> 
  

  <div class="row">
    <div class="col-md-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Recent Purchases</p>
          <div class="table-responsive">
            <table id="recent-purchases-listing" class="table">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>Status report</th>
                    <th>Tracking number</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>paid for</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $sum = 0;
                @endphp
                @foreach ($lastorders as $item)
               
                <tr>
                    <td> {{ $item->firstname }} {{$item->lastname}}</td>
                    <td>
                      @php
                    if($item->status==1){
                      echo '<button type="button" class="btn btn-success btn-rounded btn-fw">已完成</button>';        
                    }
                    elseif ($item->status==0) {
                      # code...
                      echo '<button type="button" class="btn btn-warning btn-rounded btn-fw">未完成</button>';
                    }
                @endphp    
                    </td>
                    <td> {{ $item->tracking_no }} </td>
                    <td><b>NTD $ {{ number_format($item->total_price) }} </b></td>
                    <td> {{ $item->created_at }} </td>
                    <td> {{ $item->payment_mode }} </td>
                </tr>
                @php
                    $sum += $item->total_price;
                @endphp
            @endforeach 
              </tbody>
              
            </table>
          </div>
        </div>
        <div class="link">
          {{$lastorders->links() }}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-7 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Cash deposits</p>
          <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to write details</p>
          <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
          <canvas id="cash-deposits-chart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-5 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Total sales</p>
          <h1>$ {{ number_format($sum) }}
            
          </h1>
          <h4>Gross sales over the years</h4>
          <p class="text-muted">Today, many people rely on computers to do homework, work, and create or store useful information. Therefore, it is important </p>
          <div id="total-sales-chart-legend"></div>                  
        </div>
        <canvas id="total-sales-chart"></canvas>
      </div>
    </div>
  </div>
@endsection

