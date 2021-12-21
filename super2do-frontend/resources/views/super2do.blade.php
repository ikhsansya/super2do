@include('template.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- MODAL AREA -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div id="lebar" class="modal-dialog modal-md">
            <div class="modal-content">
                <form  method="GET" action="{{route('task.create')}}" enctype="multipart/form-data" id="form-edit" class="form-horizontal">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add To Do List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
                </div>
                <div id="body" class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Title</label>
                                <input type="text" id="title" name="title" class="form-control input-sm" placeholder="" value="">
                        </div>

                         <div class="form-group">
                            <label class="col-sm-12 control-label">Tanggal</label>
                             <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="tanggal" id="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate" value="" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>

                          <div class="bootstrap-timepicker">
                            <div class="form-group">
                              <label>JAM</label>

                              <div class="input-group date" id="timepicker" data-target-input="nearest">
                                <input type="text" name="jam" id="jam" class="form-control datetimepicker-input" data-target="#timepicker"/>
                                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                </div>
                                </div>
                              <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                          </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit" type="submit" value="save" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!---- END OF MODAL AREA -->
  <div class="col-lg-8" style="margin: 0 auto;">
    <!-- TO DO List -->
            <br><br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                @if(!empty($data))
                <?php
                  $identity = 1;
                ?>
                @foreach($data as $item)
                  <li>
                    <div class="row">
                      <div style="margin-top: 15px;">
                        <span class="handle">
                          <i class="fas fa-ellipsis-v"></i>
                          <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <!-- checkbox -->
                        <?php
                          $status = $item->status == 1 ? 'ACTIVE' : 'COMPLETED';
                        ?>
                        <div  class="icheck-primary d-inline ml-2">
                          @if ($status == 'ACTIVE')
                            <input type="checkbox" value="" name="todo1" id="{{$identity}}">
                          @else
                            <input type="checkbox" value="" name="todo1" id="{{$identity}}" checked>
                          @endif
                          <label for="{{$identity}}"></label>
                        </div>
                      </div>
                      <!-- todo text -->
                      <div class="col-sm-10">
                        <span class="text">{{ $item->title }}</span>
                        <!-- Emphasis label -->
                        @if ($status == 'ACTIVE')
                          <small class="badge badge-primary">ACTIVE</small>
                        @else
                          <small class="badge badge-success">COMPLETED</small>
                        @endif
                        <br>
                        <span style="font-size: 12px;"> {{ $item->time }} - {{ $item->date }} </span>
                      </div>
                      <div class="tools" style="margin-top: 15px;">
                        <a href="#" data-title="{{ $item->title }}" data-tanggal="{{ $item->date }}" data-jam="{{ $item->time }}" data-toggle="modal" data-target="#myModal" class="editData"><i class="fas fa-edit"></i></a>
                        <i class="far fa-trash-alt"></i>
                      </div>
                    </div>
                  </li>
                  <?php
                    $identity++;
                  ?>
                @endforeach
                @endif
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right newData" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i> Add item</button>
              </div>
            </div>
  </div>
</div>
<!-- ./wrapper -->

@include('template.script')
<script type="text/javascript">
   $(function () {
      $('#reservationdate').datetimepicker({
          format: 'YYYY-MM-DD'
      });

      //Timepicker
      $('#timepicker').datetimepicker({
        use24hours: true,
        format: 'HH:mm'
      })
    })

    $(document).on("click", ".editData", function () {
       var title = $(this).attr('data-title');
       var tanggal = $(this).attr('data-tanggal');
       var jam = $(this).attr('data-jam');
       $(".modal-body #title").val( title );
       $(".modal-body #tanggal").val( tanggal );
       $(".modal-body #jam").val( jam );
    });

    $(document).on("click", ".newData", function () {
       document.getElementById("form-edit").reset();
    });
</script>
</body>
</html>
