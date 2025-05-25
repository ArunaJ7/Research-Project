
<div class="container">
    <div class="row">
      <form action="" method="POST">
        {{csrf_field()}}
        <div class="form-group form-row">
          <div class="row" id="container03">
            <table class="table table-dark" width="100%">
              <tr>
                <th align="center" colspan="6">List of Items that Reached the Re-order Level</th>
              </tr>
              <tr>
                
              </tr>
              <tr>
                <th>Item No:</th>
                <th>Description</th>
                <th>Re-order Level</th>
                <th>Last Purchase Date</th>
                <th>Issued Qty:(For last 06 months)</th>
                <th>Current Balance</th>
              </tr>
              @foreach($data1 as $data1)
              <tr>
                <td>{{$data1->st_ConItem}}</td>
                <td>{{$data1->st_ConIDesc}}</td>
                <td>{{$data1->st_ConROL}}</td>
                <td> 
                  {{$data1->binDate}}
                </td>
                <td>{{$issue[$data1->st_ConItem]}}</td>
                <td>{{$data1->st_ConBalance}}</td>
                @endforeach
              </tr>
            </table>
          </div>
        </div>
    </div>
  </div>
  